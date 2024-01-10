<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Service;
use App\ServiceUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{

    function __construct(){
    }
    function getInfo(Request $request){
        $user = User::where('id', auth()->user()->id)->first();
        return view('backend.account.info-account',compact('user'));
    }
    function changeInfo(Request $request){
        try {
            DB::beginTransaction();

            $data = $request->all();
            $existEmail = User::where('id', '<>', $data['id'])->where('email', $data['email'])->count();
            if($existEmail){
                echo json_encode(['code' => 422, 'message' => 'Email đã tồn tại']);
                return;
            }
            $user = User::where('id', $data['id'])->first();
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);
            DB::commit();
            echo json_encode(['code' => 200]);
        } catch (\Throwable $th) {
            DB::rollBack();
            echo json_encode(['code' => 500, 'message' => '']);
        }
    }

    function changePassword(Request $request){
        $validator = \Validator::make($request->all(), [
            'old_pass' => [
                'required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        return $fail(__('Mật khẩu không đúng'));
                    }
                },
                'min:7',
                'max:30'
            ],
            'new_pass' => 'required|min:7|max:30',
            're_new_pass' => 'required|same:new_pass'
        ], [
            'old_pass.required' => 'Nhập mật khẩu hiện tại',
            'old_pass.min' => 'Mật khẩu yêu cầu 8 ký tự trở lên',
            'new_pass.required' => 'Nhập mật khẩu mới',
            'new_pass.min' => 'Mật khẩu yêu cầu 8 ký tự trở lên',
            're_new_pass.required' => 'Xác nhận mật khẩu mới',
            're_new_pass.same' => 'Mật khẩu không khớp với mật khẩu mới'
        ]);
        if (!$validator->passes()) {

            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $update = User::find(Auth::user()->id)->update(['password' => \Hash::make($request->new_pass)]);

            if (!$update) {
                return response()->json(['status' => 0, 'msg' => 'Đổi mật khẩu thất bại']);
            } else {
                return response()->json(['status' => 1, 'msg' => 'Đổi mật khẩu thành công']);
            }
        }
    }
}
