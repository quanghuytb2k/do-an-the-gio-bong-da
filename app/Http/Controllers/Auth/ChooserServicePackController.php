<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\ServicePack;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChooserServicePackController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    use RegistersUsers;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function index($id)
    {
        $services = ServicePack::where('service_id', $id)->with(['service'])->get();
        return view('service.choose_service_pack', compact('services'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function next($id)
    {
        $servicePackId = $id;
        $service = ServicePack::find($id);

        return view('service.payment', compact('service'));
    }

    function payment(Request $request)
    {
        $serviceId =  $request->get('service_id');
        $name = $request->get('name');
        $email = $request->get('email');
        $password = $request->get('password');
        $pay = $request->get('payment');
        $code = rand(1, 50);
        $order = rand(1, 50);
        $servicePack = ServicePack::find($serviceId);
        $validUntil = strtotime('+' . $servicePack->time_to_use_value . ' ' . $servicePack->time_to_use_unit);

        $user = User::where('email', $email)->first();

        if ($servicePack->price) {
            $price = $servicePack->price;

            if(!$user){
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'valid_until' => date('Y-m-d H:m:s', $validUntil),
                    'role' => User::USER_CUSTOMER_ROLE,
                    'service_pack_id' => $servicePack->id,
                    'service_id' => $servicePack->service_id,
                    'status' => 0
                ]);
            }
            
            $userId = $user->id;

            if ($pay == 2) {
                $response = \MoMoAIO::purchase([
                    // 'amount' => $input['amount'],
                    'amount' => 10000,
                    'returnUrl' => "http://localhost/choose-service-pack/check/$userId/",
                    'notifyUrl' => 'http://localhost/the-gioi-bong-da/ipn/',
                    'orderId' =>  $order,
                    'requestId' => $code,
                ])->send();
                if ($response->isRedirect()) {
                    $redirectUrl = $response->getRedirectUrl();
                    return redirect($redirectUrl);
                }
            }
            if ($pay == 3) {
                $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                $vnp_Returnurl = "http://localhost/choose-service-pack/check/$userId/";
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
            } else {
                return redirect('/admin/dashboard')->with('status', 'Đăng ký thành công!');
            }
        } else {
            if($user){
                $user->update(['status' =>1]);

                $this->guard()->login($user);
                return redirect('/admin/dashboard');
            }else{
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'valid_until' => date('Y-m-d H:m:s', $validUntil),
                    'role' => User::USER_CUSTOMER_ROLE,
                    'service_pack_id' => $servicePack->id,
                    'service_id' => $servicePack->service_id,
                    'status' => 1
                ]);
    
                $this->guard()->login($user);
                return redirect('/admin/dashboard')->with('status', 'Đăng ký thành công!');
            }
        }
    }

    function checked($id)
    {
        User::find($id)->update(['status' => 1]);
        return redirect('/admin/dashboard')->with('status', 'Đăng ký thành công!');
    }
}
