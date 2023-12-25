<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\ServicePack;
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
       $services = ServicePack::where('service_id',$id)->with(['service'])->get();
       return view('service.choose_service_pack' , compact('services'));
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
        return view('auth.register' , compact('servicePackId'));
    }
}
