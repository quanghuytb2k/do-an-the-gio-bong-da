<?php

namespace App\Http\Requests;

use App\Rules\PitchesRules;
use Illuminate\Foundation\Http\FormRequest;

class PitchesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules['data'] = [new PitchesRules($this->data, $this->id, isset($this->schedule_id) ? $this->schedule_id : null, isset($this->is_update) ? true : false)];
        return $rules;
    }
}
