<?php

namespace App\Rules;

use App\PitchBookingTime;
use Illuminate\Contracts\Validation\Rule;

class PitchesRules implements Rule
{

    protected $data;
    protected $pitch_id;
    protected $schedule_id;
    protected $isUpdate;
    protected $messages;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($data, $pitch_id, $schedule_id, $isUpdate)
    {
        $this->data = $data;
        $this->pitch_id = $pitch_id;
        $this->schedule_id = $schedule_id;
        $this->isUpdate = $isUpdate;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($this->data as $key => $value) {
            if($value['time_from'] > $value['time_to']){
                $this->messages = 'Thời gian bắt đầu không được lớn hơn thời gian kết thúc';
                return false;
            }
            $schedule = PitchBookingTime::where('pitch_id', $this->pitch_id)
                        ->where(function ($q) use ($value){
                            $q->where([
                                ['time_start', '<', $value['time_from']],
                                ['time_end', '>', $value['time_from']],
                            ])->orWhere([
                                ['time_start', '<', $value['time_to']],
                                ['time_end', '>', $value['time_to']],
                            ])->orWhere([
                                ['time_start', '>', $value['time_from']],
                                ['time_end', '<', $value['time_to']],
                            ]);
                        })
                        ->where('day_year', $value['date_start']);
            if($this->isUpdate && $this->schedule_id){
                $schedule = $schedule->where('id', '<>', $this->schedule_id)->get();
                if(count($schedule)){
                    $this->messages = 'Thời gian từ ' . $value['time_from'] . ' đến ' . $value['time_to'] .' đang không trống';
                    return false;
                }
            }else{
                $schedule = $schedule->get();
                if(count($schedule)){
                    $this->messages = 'Thời gian từ ' . $value['time_from'] . ' đến ' . $value['time_to'] .' đang không trống';
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->messages;
    }
}
