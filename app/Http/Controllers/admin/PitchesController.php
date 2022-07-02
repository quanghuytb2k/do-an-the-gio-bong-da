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
            'price' => $request->input('price')
        ]);
        $time = $request->time;

        if (isset($time)) {
            foreach ($time as $timeId) {
                $timeCreate = PitchBookingTime::create([
                    'time'=>$timeId,
                    'day_year'=>$request->date
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
