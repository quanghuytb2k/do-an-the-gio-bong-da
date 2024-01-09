<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    function __construct(){
        $this->middleware(function($request, $next){
            session(['module_active'=>'user']);
            return $next($request);
        });
    }
    function list(Request $request){
    //     $list_act=['delete'=>'xóa tạm thời'];
    //     $status = $request->input('status');
    //     if($status == 'trash'){
    //         $list_act=['restore'=>'khôi phục',
    //         'forceDelete'=>'xóa vĩnh viễn'];
    //         $users =User::paginate(2);
    //     }
    //     else{
    //     $keyword ="";
    //     if($request->input('keyword')){
    //         $keyword =$request->input('keyword');
    //     }

    //     //lấy thông tin điều kiện
    //     $users=User::where('name','LIKE',"%{$keyword}%")->paginate(2);
    // }
    // $count_active = User::count();
    // $count_trash = User::count();
    // $count =[$count_active,$count_trash];


    //     return view('backend.admin.list-user',compact('users','count','list_act'));

        $users = User::select('*')->orderBy('id', 'desc')->get();
        return view('backend.admin.list-user',compact('users'));
    }
    function add(){
        return view('backend.admin.add-user');
    }
    function store(Request $request){
        $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            [
                'required'=>':attribute không được để trống',
                'min'=>':attribute có độ dại ít nhất :min ký tự',
                'max'=>':attribute có độ dài tối đa :max ký tự' ,
                'confirmed'=>'xác nhận mật khẩu không thành công',
            ]);

            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role' => $request->input('role') ? $request->input('role') : User::USER_CUSTOMER_ROLE,
                'service_pack_id' => 0,
                'service_id' => 0,
            ]);
            return redirect('admin/user/list-user')->with('status','Đã thêm người dùng thành công');

    }

    function delete(Request $request){
        try {
            DB::beginTransaction();
                $dataRequest = $request->all();
                $id = $dataRequest['id'];
                $user = User::find($id);
                $user->delete();
                echo json_encode(200);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            echo json_encode(500);
        }
    }
    function action(Request $request){
        $list_check = $request->input('list_check');

        if($list_check){
            foreach($list_check as $k=>$id){
                if (Auth::id()==$id){
                    unset($list_check[$k]);
                }
            }
            if(!empty($list_check)){
                $act = $request->input('act');
                    if($act =='delete'){
                        User::destroy($list_check);
                        return redirect('admin/user/list-user')->with('status','Bạn xóa thành công ');
                    }
                    if($act =='restore'){
                        User::withTrashed()
                        ->whereIn('id',$list_check)
                        ->restore();
                        return redirect('admin/user/list-user')->with('status','Bạn đã khôi phục thành công ');
                    }
                    if($act == 'forceDelete'){
                        User::withTrashed()
                        ->whereIn('id',$list_check)
                        ->forceDelete();
                        return redirect('admin/user/list-user')->with('status','bạn đã xõa vĩnh viễn tài khoản thành công');
                    }
                }
                return redirect('admin/user/list-user')->with('status','bạn không thể thao tác trên tài khoản của bạn');
            }
            else{
                return redirect('admin/user/list-user')->with('status','bạn cần chọn phần tử để thucwcj hiện');
            }

    }

    function edit($id){
        $user = User::find($id);
        return view('backend.admin.edit',compact('user'));
    }
    function update(Request $request, $id){
        $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            ],
            [
                'required'=>':attribute không được để trống',
                'min'=>':attribute có độ dại ít nhất :min ký tự',
                'max'=>':attribute có độ dài tối đa :max ký tự' ,
                'confirmed'=>'Xác nhận mật khẩu không thành công',
            ]);

            $user = User::where('id',$id)->first();
            $user->update([
                'name'=>$request->input('name'),
                'password'=> $request->input('password') ? Hash::make($request->input('password')) : $user->password,
                'role'=> $request->input('role') ? $request->input('role') : $user->role,
            ]);
            return redirect('admin/user/list-user')->with('status','Đã cập nhật người dùng thành công');

    }
}
