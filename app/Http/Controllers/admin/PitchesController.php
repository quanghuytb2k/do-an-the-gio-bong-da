<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\PitchBookingTime;
use App\Pitches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PitchesController extends Controller
{
    function create(){
        return view('backend.pitches.pitches');
    }
    function store(Request $request){
        if($request->hasFile('file')){
            $file= $request->file;
            $filename= $file->getClientOriginalName();
            $thumbnail = "uploads/".$filename;
            $file->move('public/uploads/', $file->getClientOriginalName());

        }else{
            $thumbnail = '';
        }
        $PitchesCreate = Pitches::create([
            'name' => $request->input('name'),
            'images' => $thumbnail ,
            'description' => $request->input('description'),
            'address' => $request->input('address'),
            'phone_number' => $request->input('telephone'),
            'name_pitch' => $request->input('name_pitches'),
        ]);
        $time_start = $request->time_start;
        $time_end = $request->time_end;
        $price = $request->price;
        $c = count($time_end);
//        dd($time_start[0]);
        if (isset($time_start) && isset($time_end)) {
            for($i=0; $i<$c; $i ++) {
                    $timeCreate = PitchBookingTime::create([
                        'time_start' => $time_start[$i],
                        'time_end' => $time_end[$i],
                        'price' => $price[$i],
                        'day_year'=>$request->date,
                        'pitch_id'=>$PitchesCreate->id,
                ]);
                $Pitches_time = DB::table('pitches_time')->insert([
                    'pitches_id' => $PitchesCreate->id,
                    'time_id' => $timeCreate->id
                ]);
            }
        }
        return redirect('create-pitches')->with('status','thêm bài viết thành công');
    }
}
