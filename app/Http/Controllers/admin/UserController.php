<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function create(){
        return view('backend.users.create');
    }
    function store(Request $request)
    {
        // DB::table('test')->insert([
        //                 'name'=>$request->input('name'),
        //                 'price'=>$request->input('price')
        //             ]);
        $input = $request->all();
                $code = rand(1,50);;
                $amount =$request->input('price');
                $response = \MoMoAIO::purchase([
                    // 'amount' => $input['amount'],
                    'amount' => $amount,
                    'returnUrl' => 'http://localhost/do-an-bao-ve/do-an/test',
                    'notifyUrl' => 'http://localhost/do-an-bao-ve/do-an/ipn/',
                    'orderId' =>  $code,
                    'requestId' => $code,
                ])->send();
                // dd($response);
                if ($response->isRedirect()) {
                    DB::table('test')->insert([
                        'name'=>$request->input('name'),
                        'price'=>$request->input('price')
                    ]);

                    $redirectUrl = $response->getRedirectUrl();
                    return redirect($redirectUrl);
                    // TODO: chuyển khách sang trang MoMo để thanh toán
                    
                }
    }
}
