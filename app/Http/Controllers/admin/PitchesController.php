<?php

namespace App\Http\Controllers\admin;

use App\Commune;
use App\District;
use App\Http\Controllers\Controller;
use App\OrderPitches;
use App\PitchBookingTime;
use App\Pitches;
use App\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PitchesController extends Controller
{
    function create(){
        $provinces = Province::all();
        $district = District::all();
        $commune = Commune::all();
        return view('backend.pitches.pitches',compact('provinces','commune', 'district'));
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

    function create_oder(Request  $request)
    {
        $pich_id = $request->get('pich_id');
        $name = $request->get('name');
        $email = $request->get('email');
        $address = $request->get('address');
        $phone = $request->get('phone');
        $time = $request->get('time');
        $total_price = $request->get('total_price');
        $order_pitch = OrderPitches::create([
            'pitch_id'=>$pich_id,
           'name_customer' => $name,
           'email' => $email,
           'phone' => $phone,
            'address' =>  $address,
            'price' => $total_price,
        ]);
        foreach ($time as $value){
            $pitch_time_order = DB::table('pitch_time_order')->insert([
                'order_id' => $order_pitch->id,
                'time_id'=>$value
            ]);
            $booking_time = PitchBookingTime::where('id', $value)->update([
                'status'=>'0'
            ]);
        }
        $data = 'Đặt sân thành công';
        return response()->json($data);
    }

    function district(Request $request){
        $province = $request->get('province');
        $select_district = '<option value="">-- Chọn Quận/Huyện --</option>';
        $matp = Province::where('name', $province)->get();
        $matp = $matp['0']->matp;
        if($matp){
            $list_district = District::where('matp', $matp)->get();
            foreach($list_district as $district){
                $select_district .= '
                <option value="'.$district->name.'">'.$district->name.'</option>';
            }
        }
        $data = $select_district;
        return response()->json($data);
    }

    function commune(Request $request){
        $commune = $request->get('commune');
        $select_commune = "<option value=''>-- chọn Xã/phường --</option>";
        $maqh = District::where('name',$commune)->get();
        $maqh = $maqh['0']->maqh;
        if($maqh){
            $list_commune = Commune::where('maqh',$maqh)->get();
            foreach($list_commune as $commune){
                $select_commune .=' <option value="'.$commune->name.'">'.$commune->name.'</option>
                ';
            }
        }$data = $select_commune;
        return response()->json($data);
    }

    // admin

    function admin_pitches(){
        return view('backend.admin.admin-pitches');
    }
}
