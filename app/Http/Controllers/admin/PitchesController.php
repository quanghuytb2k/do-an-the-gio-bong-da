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
        $pay = $request->get('pay');
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
        dd($request->all());
        $code = rand(1,50);
        if($pay == 3){
            $response = \MoMoAIO::purchase([
                // 'amount' => $input['amount'],
                'amount' => 10000,
                'returnUrl' => 'http://localhost/the-gioi-bong-da',
                'notifyUrl' => 'http://localhost/the-gioi-bong-da/ipn/',
                'orderId' =>  $code,
                'requestId' => $code,
            ])->send();
            // dd($response);
            if ($response->isRedirect()) {
                $redirectUrl = $response->getRedirectUrl();
                return redirect($redirectUrl);
                
            }
            dd(34);
    
            $data = 'Đặt sân thành công';
            return response()->json($data);
        }
        if($pay == 2){
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://localhost/the-gioi-bong-da";
            $vnp_TmnCode = "V6BP0S5P"; //Mã website tại VNPAY 
            $vnp_HashSecret = "MYOCNMNQPLFAVFAWWNVZAZCTPXWQAOWE"; //Chuỗi bí mật
    
            $vnp_TxnRef = 12346781; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 13223;
            $vnp_OrderType = 'billpayment';
            // $vnp_Amount = $_POST['amount'] * 100;
            $vnp_Amount = 10000 * 100; 
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
                echo json_encode($returnData);
            }
        }else{
            $data = 'Đặt sân thành công';
            return response()->json($data);
        }
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
