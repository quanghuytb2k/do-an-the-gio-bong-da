<?php

namespace App\Http\Controllers\admin;

use App\Commune;
use App\District;
use App\Http\Controllers\Controller;
use App\Http\Requests\PitchesRequest;
use App\Mail\MailPitches;
use App\OrderPitches;
use App\PitchBookingTime;
use App\Pitches;
use App\PriceSetup;
use App\Province;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mail;

class PitchesController extends Controller
{
    function listPitches(){
        $pitches = Pitches::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        $priceSetup = PriceSetup::find(1);
//        $times = Pitches::find($id)->pitchBookingTimes;
//        foreach ($times as $item) {
//            $day_year = $item->day_year;
//        }
        //        dd($pitches);
        return view('backend.admin.list-pitches', compact('pitches','priceSetup'));
    }

    function addSchedule()
    {
        return view('backend.pitches.add-schedule');
    }

    function getScheduleForPitches($id)
    {
        $pitches = Pitches::where('id', $id)->with(['pitchBookingTimes'])->first();
        $data = null;
        if (!empty($pitches)) {
            $data['id'] = $pitches->id;
            $data['name'] = $pitches->name;
            $data['address'] = $pitches->address;
            $data['status_normal'] = 0;
            $data['status_ordered'] = 0;
            $data['status_booking'] = 0;
            $schedules = [];
            if ($pitches->pitchBookingTimes) {
                foreach ($pitches->pitchBookingTimes as $key => $value) {
                    $color = $value->status == 1 ? 'gray' : ($value->status == 2 ? 'green' : ($value->status == 3 ? 'orange' : 'gray'));
                    $data['status_normal'] += $value->status == 1 ? 1 : 0;
                    $data['status_booking'] += $value->status == 2 ? 1 : 0;
                    $data['status_ordered'] += $value->status == 3 ? 1 : 0;
                    $type = $value->type ? PitchBookingTime::getTypeName($value->type) : null;
                    $schedules[] = [
                        "id" => $value->id,
                        "title" => $value->time_start . ' - ' . $value->time_end . ' (' . $type . ')',
                        "start" => $value->day_year . ' ' . $value->time_start,
                        "end" => $value->day_year . ' ' . $value->time_end,
                        "backgroundColor" => $color,
                        "borderColor" => $color,
                        "extendedProps" => [
                            "type" => $value->type,
                            "status" => $value->status,
                            "day" => $value->day_year,
                            "price" => $value->price,
                            "start" => $value->time_start,
                            "end" => $value->time_end,
                        ],
                    ];
                }
            }
            $data['schedules'] = $schedules;
        }
        echo json_encode($data);
    }

    function setUpPrice(Request $req){
        try {
            DB::beginTransaction();
            $data = $req->all();
            
            $price_peak = $data['price_peak'];
            $price_weekend = $data['price_weekend'];
            
            $priceSetup = PriceSetup::find(1);
            $priceSetup->price_peak = $price_peak;
            $priceSetup->price_weekend = $price_weekend;

            $priceSetup->save();
            DB::commit();
            echo json_encode(200);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            echo json_encode(500);
        }
    }

    private function getWeekday($date) {
        return date('w', strtotime($date));
    }

    function generateSchedulePitches(Request $req){
        try {
            DB::beginTransaction();
            $data = $req->all();
            $generate_time_from = $data['generate_time_from'];
            $generate_time_to = $data['generate_time_to'];
            $generate_date_from = $data['generate_date_from'];
            $generate_date_to = $data['generate_date_to'];
            $pitch_id = $data['id'];
            $type = $data['type'];
            $priceOrigin = $data['price'];

            $time_from = strtotime($generate_time_from);
            $time_to = strtotime($generate_time_to);
            $time_difference = round(round(abs($time_to - $time_from) / 3600,2) / 1.5);

            $date_difference = strtotime($generate_date_to) - strtotime($generate_date_from);
            $date_difference = round($date_difference / (60 * 60 * 24));

            $priceSetup = PriceSetup::find(1);

            for($j = 0; $j <= $date_difference; $j ++){
                for($i = 1; $i <= $time_difference; $i ++){
                    if($i == 1){
                        $start = $generate_time_from;
                    }else{
                        $start = strtotime($generate_time_from) + 90*60;
                        $start = $start * $i;
                        $start = date('H:i', $start);
                    }
                    $end = strtotime($start) + 90*60;
                    $end = date('H:i', $end);

                    $price = $priceOrigin;
                    if(strtotime($start) >= strtotime(PitchBookingTime::PEAK_START) || strtotime($start) < strtotime(PitchBookingTime::PEAK_END)){
                        $price = $price + ($priceOrigin * $priceSetup->price_peak / 100);
                    }

                    $day_year = date('Y-m-d',strtotime('+'.$j.' day',strtotime($generate_date_from)));

                    if(in_array((string) $this->getWeekday($day_year),PitchBookingTime::WEEKEND)){
                        $price = $price + ($priceOrigin * $priceSetup->price_weekend / 100);
                    }

                    $time = PitchBookingTime::create([
                        'time_start' => $start,
                        'time_end' => $end,
                        'price' => intval($price),
                        'day_year'=> $day_year,
                        'pitch_id'=> $pitch_id,
                        'type'=> $type,
                    ]);
                    DB::table('pitches_time')->insert([
                        'pitches_id' => $pitch_id,
                        'time_id' => $time->id
                    ]);
                }
            }
            
            DB::commit();
            echo json_encode(200);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            echo json_encode(500);
        }
    }

    function addScheduleForPitches(PitchesRequest $req){
        try {
            DB::beginTransaction();
            $data = $req->all();
            $pitch_id = $data['id'];
            $day_year = $data['day_year'];
            $type = $data['type'];
            $data_time = $data['data'];
            $repeat = $data['repeat'];
            $repeat_info = $data['repeat_info'];
            $priceSetup = PriceSetup::find(1);
            if($repeat == 'true'){
                if(isset($data_time) && count($data_time)){
                    foreach ($data_time as $key => $value) {
                        $priceOrigin = $value['price'];
                        $price = $priceOrigin;
                        if(strtotime($value['time_from']) >= strtotime(PitchBookingTime::PEAK_START) || strtotime($value['time_from']) < strtotime(PitchBookingTime::PEAK_END)){
                            $price = $price + ($priceOrigin * $priceSetup->price_peak / 100);
                        }
                        
                        if(in_array((string) $this->getWeekday($day_year),PitchBookingTime::WEEKEND)){
                            $price = $price + ($priceOrigin * $priceSetup->price_weekend / 100);
                        }
                        
                        $time = PitchBookingTime::create([
                            'time_start' => $value['time_from'],
                            'time_end' => $value['time_to'],
                            'price' => $price,
                            'day_year'=> $day_year,
                            'pitch_id'=> $pitch_id,
                            'type'=> $type,
                        ]);

                        DB::table('pitches_time')->insert([
                            'pitches_id' => $pitch_id,
                            'time_id' => $time->id
                        ]);
                        $week = $repeat_info['week'];
                        foreach($week as $week_day){
                            $day = strtotime($week_day.' this week');
                            do {
                                if($day > strtotime($day_year)){
                                    $time = PitchBookingTime::create([
                                        'time_start' => $value['time_from'],
                                        'time_end' => $value['time_to'],
                                        'price' => $price,
                                        'day_year'=> date('Y-m-d',$day),
                                        'pitch_id'=> $pitch_id,
                                        'type'=> $type,
                                    ]);
                                    DB::table('pitches_time')->insert([
                                        'pitches_id' => $pitch_id,
                                        'time_id' => $time->id
                                    ]);
                                }
                                $day = strtotime('+1 week',$day);
                              } while ($day < strtotime($repeat_info['time_to']));
                        }
                    }
                }
            }else{
                if(isset($data_time) && count($data_time)){
                    foreach ($data_time as $key => $value) {
                        $priceOrigin = $value['price'];
                        $price = $priceOrigin;
                        if(strtotime($value['time_from']) >= strtotime(PitchBookingTime::PEAK_START) || strtotime($value['time_from']) < strtotime(PitchBookingTime::PEAK_END)){
                            $price = $price + ($priceOrigin * $priceSetup->price_peak / 100);
                        }
                        
                        if(in_array((string) $this->getWeekday($day_year),PitchBookingTime::WEEKEND)){
                            $price = $price + ($priceOrigin * $priceSetup->price_weekend / 100);
                        }
                        $time = PitchBookingTime::create([
                            'time_start' => $value['time_from'],
                            'time_end' => $value['time_to'],
                            'price' => $price,
                            'day_year'=> $day_year,
                            'pitch_id'=> $pitch_id,
                            'type'=> $type,
                        ]);
                        DB::table('pitches_time')->insert([
                            'pitches_id' => $pitch_id,
                            'time_id' => $time->id
                        ]);
                    }
                }
            }
            DB::commit();
            echo json_encode(200);
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
            echo json_encode(500);
        }
    }

    function editScheduleForPitches(PitchesRequest $req){
        try {
            DB::beginTransaction();
            $data = $req->all();
            $id = $data['schedule_id'];
            $type = $data['type'];
            $status = $data['status'];
            $data_time = $data['data'];

            $getSchedule = PitchBookingTime::where('id', $id)->first();
            if(empty($getSchedule)){
                echo json_encode(404);
                return;
            }

            if(isset($data_time) && count($data_time)){
                foreach ($data_time as $key => $value) {
                    $getSchedule->update([
                        'time_start' => $value['time_from'],
                        'time_end' => $value['time_to'],
                        'price' => $value['price'],
                        'status' => $status,
                        'type'=> $type,
                    ]);
                }
            }
            DB::commit();
            echo json_encode(200);
        } catch (\Throwable $th) {
            DB::rollBack();
            echo json_encode(500);
        }
    }

    function adminDetailPitches(Request $request, $id){
        $pitches = Pitches::where('id', $id)->get();
        $times = Pitches::find($id)->pitchBookingTimes;
        $day_year = null;
        foreach ($times as $item) {
            $day_year = $item->day_year;
        }
        //        dd($pitches);
        return view('backend.admin.admin-detail-pitches', compact('pitches', 'times', 'day_year'));
    }

    function editPitches(Request $request, $id){
        $pitches = Pitches::where('id', $id)->first();
        $times = Pitches::find($id)->pitchBookingTimes;
        $day_year = null;
        // foreach ($times as $item) {
        //     $day_year = $item->day_year;
        // }
        $provinces = Province::all();
        $district = District::all();
        $commune = Commune::all();
        return view('backend.admin.edit-pitches', compact('pitches', 'times', 'day_year', 'provinces','commune', 'district'));
    }

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
            $file->move('uploads/', $file->getClientOriginalName());

        }else{
            $thumbnail = '';
        }
        // $request->validate(
        //     [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|max:255',
        //     'description' => 'required|string|max:255',
        //     'phone_number'=> 'required|string|max:11',
        //     'description' => 'required|string|max:255',
        //     'name_pitches' => 'required|string|max:255',
        //     'province' => 'required|string|max:255',
        //     'district' => 'required|string|max:255',
        //     'commune'=> 'required|string|max:255',
        // ],
        //     [
        //     'required'=>':attribute không được để trống',
        //     'min' => ':attribute có độ dài ít nhất :min',
        //     'max' => ':attribute có độ dài lớn nhất :max',
        //     'confirmed' => 'Xác nhận mật khẩu không thành công',
        //     'unique' => ':attribute đã tồn tại trong hệ thống!'
        // ],
        //     [
        //     'email' => 'Email',
        //     'phone_number' => 'Số điện thoại',
        //     'description'=> 'Miêu tả',
        //     'name'=> 'Tên chủ sân',
        //     'name_pitches' => 'Tên chủ sân',
        //     'province'=> 'Tỉnh',
        //     'district'=> 'Huyện',
        //     'commune' => 'Xã',
        // ]
        // );
        // dd(777);
        $PitchesCreate = Pitches::create([
            'name' => $request->input('name'),
            'images' => $thumbnail ,
            'description' => $request->input('description'),
            'address' => $request->input('province').','.$request->input('district').','.$request->input('commune'),
            'phone_number' => $request->input('telephone'),
            'name_pitch' => $request->input('name_pitches'),
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'province' => $request->input('province'),
            'district' => $request->input('district'),
            'commune' => $request->input('commune'),
        ]);
        // $time_start = $request->time_start;
        // $time_end = $request->time_end;
        // $price = $request->price;
        // $c = count($time_end);
        // if (isset($time_start) && isset($time_end)) {
        //     for($i=0; $i<$c; $i ++) {
        //             $timeCreate = PitchBookingTime::create([
        //                 'time_start' => $time_start[$i],
        //                 'time_end' => $time_end[$i],
        //                 'price' => $price[$i],
        //                 'day_year'=>$request->date,
        //                 'pitch_id'=>$PitchesCreate->id,
        //         ]);
        //         $Pitches_time = DB::table('pitches_time')->insert([
        //             'pitches_id' => $PitchesCreate->id,
        //             'time_id' => $timeCreate->id
        //         ]);
        //     }
        // }
        // dd(123);
        return redirect('create-pitches')->with('status','thêm sân thành công');
    }

    function create_oder(Request  $request)
    {
        $data = $request->all();
        $pich_id = $data['pich_id'];
        $time = $data['time'];
        $total_price = $data['total_price'];
        if($time == null){
            $data = 'Vui lòng chọn giờ đặt sân';
            return response()->json($data);
        }
        $order_pitch = OrderPitches::create([
            'pitch_id'=>$pich_id,
            'price' => $total_price,
        ]);
        foreach ($time as $value){
            $pitch_time_order = DB::table('pitch_time_order')->insert([
                'order_id' => $order_pitch->id,
                'time_id'=>$value
            ]);
        }
        $pitches = OrderPitches::where('id', $order_pitch->id)->first();
        $data = "";
        return response()->json($data);
    }

    function checkout(){
        $pitchesMax = OrderPitches::where('status', 0)->max('id');
        $pitches = OrderPitches::where('id',$pitchesMax)->first();
        $time = OrderPitches::find($pitchesMax)->pitchTimes;
        $pitch = OrderPitches::find($pitchesMax)->pitches;
        // dd($pitch);
        return view('frontend.order-pitches',compact('pitches', 'time', 'pitch','pitchesMax'));
    }

    function orderPitches(Request $request){
        $name = $request->get('name');
        $email = $request->get('email');
        $phone_number = $request->get('phone_number');
        $note = $request->get('note');
        $pay = $request->get('payment');
        $id = $request->get('id');
        $updatePitches = OrderPitches::where('id',$id)->update([
            'name_customer' => $name,
            'phone' => $phone_number,
            'email' => $email,
            'note' => $note,
            'type_payment' => $pay,
        ]);
        $price = OrderPitches::where('id',$id)->value('price');
        $code = rand(1,50);
        $order = rand(1,50);
        if($pay == 2){
            $response = \MoMoAIO::purchase([
                // 'amount' => $input['amount'],
                'amount' => 10000,
                'returnUrl' => "http://localhost/the-gioi-bong-da/checked/$id/",
                'notifyUrl' => 'http://localhost/the-gioi-bong-da/ipn/',
                    'orderId' =>  $order,
                    'requestId' => $code,
            ])->send();
            if ($response->isRedirect()) {
                $redirectUrl = $response->getRedirectUrl();
                return redirect($redirectUrl);

            }
        }
        if($pay == 3){
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://localhost/the-gioi-bong-da/checked/$id/";
            $vnp_TmnCode = "V6BP0S5P"; //Mã website tại VNPAY
            $vnp_HashSecret = "MYOCNMNQPLFAVFAWWNVZAZCTPXWQAOWE"; //Chuỗi bí mật

            $vnp_TxnRef = $code; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 13223;
            $vnp_OrderType = 'billpayment';
            // $vnp_Amount = $_POST['amount'] * 100;
            $vnp_Amount = $price * 100;
            $vnp_Locale = 'vn';
            // $vnp_BankCode = 'VNPAYQR';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }

            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array(
                'code' => '00', 'message' => 'success', 'data' => $vnp_Url
            );
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                return redirect($vnp_Url);
            }
        }else{
            $time = DB::table('pitch_time_order')->where('order_id', $id)->pluck('time_id')->toArray();
            if($time && count($time)){
                DB::table('pitch_booking_time')->whereIn('id', $time)->update([
                    'status' => PitchBookingTime::STATUS_ORDERED
                ]);
            }

            $pitch = OrderPitches::find($id);
            //send mail to customer
            if($email){
                Mail::to($email)->send(new MailPitches($pitch,$pitch->pitches));
            }
            //send mail to admin
            $pitchId = $pitch->pitch_id;
            $adminId = Pitches::find($pitchId)->user_id;
            $adminMail = User::find($adminId)->email;
            if($adminMail){
                Mail::to($adminMail)->send(new MailPitches($pitch,$pitch->pitches));
            }

            return redirect('/home')->with('status', 'Đặt sân thành công!');
        }

    }

    function checked($id){
        // $time = OrderPitches::find($id)->pitchTimes;
        $pitch = OrderPitches::find($id)->pitches;
        $pitches = OrderPitches::where('id',$id)->first();
        // foreach ($time as $value){
        // $booking_time = PitchBookingTime::where('id', $value['id'])->update([
        //     'status'=>'0'
        // ]);
        // }
        $times = DB::table('pitch_time_order')->where('order_id', $id)->pluck('time_id')->toArray();
        if($times && count($times)){
            DB::table('pitch_booking_time')->whereIn('id', $times)->update([
                'status' => PitchBookingTime::STATUS_ORDERED
            ]);
        }
        $pitche = OrderPitches::where('id',$id)->update([
            'status' => OrderPitches::STATUS_SUCCESS,
        ]);
        $message = "Khách hàng $pitches->name_customer đã đặt sân bóng";
        if($pitches->email){
            Mail::to($pitches->email)->send(new MailPitches($pitches,$pitch));
        }

        $pitchId = $pitches->pitch_id;
        $adminId = Pitches::find($pitchId)->user_id;
        $adminMail = User::find($adminId)->email;
        if($adminMail){
            Mail::to($adminMail)->send(new MailPitches($pitches,$pitch));
        }
        $a = $this->sendMessage($message);
        return redirect('/home')->with('status', 'Đặt sân và thanh toán thành công!');
    }

    public function sendMessage($message){

        $client = new Client();

        $webhook = 'https://chat.googleapis.com/v1/spaces/AAAA35k72G4/messages?key=AIzaSyDdI0hCZtE6vySjMm-WEfRq3CPzqKqqsHI&token=eSn3RIkXcJHwXVHo-iEoKkqmlFsL-1JnDYld3pKX0GM%3D';

        $request = new \GuzzleHttp\Psr7\Request('POST', $webhook);

        $res = $client->send($request,[

                'headers' => [
                    'Content-Type' => 'application/json'
                ],

                'json' => [
                    "text" => (string)$message,
                ],

            ]

        );
        return $res->getBody();

    }

    function detail_order($id){
        $order_pitches = OrderPitches::where('id', $id)->first();
        $time = OrderPitches::find($id)->pitchTimes;
        $pitch = OrderPitches::find($id)->pitches;
        // dd($pitch);
        return view('backend.admin.admin-detail-order',compact('order_pitches', 'time', 'pitch'));
    }

    function pay(Request $request, $id){
        $pitches = DB::table('order_pitch')->where('id',$id)->update([
            'status' => $request->input('status'),
        ]);
        return redirect('/admin/detail/order/'.$id)->with('status', 'Cập nhật trạng thái thành công!');
    }

    public function edit($id)
    {
        $order = OrderPitches::find($id);
        return view('backend.admin.edit-order', compact('order'));
    }

    public function store_pitches(Request $request, $id)
    {
        // return $request->input();
        $request->validate(
            [
            'email' => 'required|string|max:255',
            'name_customer' => 'required|string|max:255',
            'phone'=> 'required|string|max:11',
            'note'=> 'required|string|max:255',
        ],
            [
            'required'=>':attribute không được để trống',
            'min' => ':attribute có độ dài ít nhất :min',
            'max' => ':attribute có độ dài lớn nhất :max',
            'confirmed' => 'Xác nhận mật khẩu không thành công',
            'unique' => ':attribute đã tồn tại trong hệ thống!'
        ],
            [
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'note'=> 'Chú ý',
            'name_customer'=> 'Tên khách hàng',
        ]
        );
        OrderPitches::where('id', $id)->update([
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'name_customer' => $request->input('name_customer'),
            'note' => $request->input('note'),
        ]);

        return redirect('/admin/dashboard')->with('status', 'Đã cập nhật thành công!');
    }

    function search(Request $request){
        $province1 = $request->get('province');
        $district1 = $request->get('district');
        $commune1 = $request->get('commune');
        $name = $request->get('name_search');
            $stadiums = Pitches::all();
            // dd($district1);
        if(isset($province1)){
            $stadiums = Pitches::where('province','like','%'. $province1 .'%')->get();
            // dd(($stadiums));
        }
        if(isset($district1)){
            // dd(1);
            $stadiums = Pitches::where('district', 'like','%'. $district1 .'%')->get();
        }
        if(isset($commune1)){
            $stadiums = Pitches::where('commune', 'like','%'. $commune1 .'%')->get();
        }
        if(isset($name)){
            // dd($name);
            $stadiums = Pitches::where('name_pitch', 'like','%'. $name .'%')->get();
            // dd($stadiums);
        }

        // dd($stadiums);

        $provinces = Province::all();
        $district = District::all();
        $commune = Commune::all();
        return view('frontend.service', compact('stadiums','provinces', 'district'));
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

    // remove pitches
    public function removePitches(Request $req){
        $data = $req->all();
        if(!isset($data['id'])){
            echo json_encode(["code" => 422, "message" => 'Không có sân bóng cần xóa']);
            return;
        }
        try {
            DB::beginTransaction();
            $getPitches = Pitches::where('id', $data['id'])->withCount(['orders', 'pitchBookingTimes' => function ($q) {
                $q->where('status',  '<>', PitchBookingTime::STATUS_NORMAL);
            }])->first();
            if($getPitches->orders_count || $getPitches->pitch_booking_times_count){
                echo json_encode(["code" => 422, "message" => "Không thể xóa sân bóng đã phát sinh đặt sân"]);
                return;
            }
            $getPitches->delete();
            DB::commit();
            echo json_encode(["code" => 200]);
            return;
        } catch (\Throwable $th) {
            DB::rollBack();
            echo json_encode(["code" => 500, "message" => $th->getMessage()]);
            return;
        }
    }

    // update pitches
    public function updatePitches(Request $req){
        $data = $req->all();
        if(!isset($data['id_pitches'])){
            return redirect()->back()->with('status-error','Không có sân bóng cần cập nhật');
        }
        try {
            DB::beginTransaction();
            if($req->hasFile('file')){
                $file= $req->file;
                $filename= $file->getClientOriginalName();
                $thumbnail = "uploads/".$filename;
                $file->move('uploads/', $file->getClientOriginalName());

            }else{
                $thumbnail = '';
            }
            $updatePitches = Pitches::where('id', $data['id_pitches'])->update([
                'name' => $data['name'],
                'images' => $thumbnail ,
                'description' => $data['description'],
                'address' => $data['province'].','.$data['district'].','.$data['commune'],
                'phone_number' => $data['telephone'],
                'name_pitch' => $data['name_pitches'],
                'province' => $data['province'],
                'district' => $data['district'],
                'commune' => $data['commune'],
            ]);
            DB::commit();
            return redirect()->back()->with('status','Cập nhật sân bóng thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('status-error','Cập nhật sân bóng thất bại');
        }
    }

    // cancel order
    public function cancelOrder(Request $req){
        $data = $req->all();
        if(!isset($data['id'])){
            echo json_encode(["code" => 422, "message" => 'Không có đơn hàng cần hủy']);
            return;
        }
        try {
            DB::beginTransaction();
            $getOrder = OrderPitches::where('id', $data['id'])->first();
            if($getOrder){
                $getOrder->update([
                    'status' => OrderPitches::STATUS_CANCEL
                ]);
                $times = DB::table('pitch_time_order')->where('order_id', $data['id'])->pluck('time_id')->toArray();
                if($times && count($times)){
                    DB::table('pitch_booking_time')->whereIn('id', $times)->update([
                        'status' => PitchBookingTime::STATUS_NORMAL
                    ]);
                }
                DB::commit();
                echo json_encode(["code" => 200]);
            }
            return;
        } catch (\Throwable $th) {
            DB::rollBack();
            echo json_encode(["code" => 500, "message" => $th->getMessage()]);
            return;
        }
    }
}
