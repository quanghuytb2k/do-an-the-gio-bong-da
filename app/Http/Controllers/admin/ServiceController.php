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

class ServiceController extends Controller
{

    function __construct(){
        $this->middleware(function($request, $next){
            session(['module_active'=>'user']);
            return $next($request);
        });
    }
    function list(Request $request){
        $services = Service::select('*')->orderBy('id', 'desc')->get();
        return view('backend.services.view-services',compact('services'));
    }
    function create(){
        return view('backend.services.add-service');
    }
    function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ],
        [
            'required'=>':attribute không được để trống',
            'min'=>':attribute có độ dại ít nhất :min ký tự',
            'max'=>':attribute có độ dài tối đa :max ký tự',
        ]);
        Service::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
        return redirect('admin/services/list-services')->with('status','Thêm dịch vụ thành công');

    }

    function delete(Request $request){
        try {
            DB::beginTransaction();
                $data = $request->all();
                $checkCanDelete = ServiceUser::where('service_id', $data['id'])->count();
                if($checkCanDelete){
                    echo json_encode(["code" => 422, "message" => "Không thể xóa! Vì đã có tài khoản sử dụng dịch vụ này"]);
                    return;
                }
                $service = Service::find($data['id']);
                $service->delete();
                echo json_encode(["code" => 200]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            echo json_encode(["code" => 500, "message" => $th->getMessage()]);
        }
    }

    function edit($id){
        $service = Service::find($id);
        return view('backend.services.edit-service',compact('service'));
    }
    function update(Request $request, $id){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ],
        [
            'required'=>':attribute không được để trống',
            'min'=>':attribute có độ dại ít nhất :min ký tự',
            'max'=>':attribute có độ dài tối đa :max ký tự' ,
        ]);
        Service::where('id',$id)->update([
            'name'=>$request->input('name'),
            'description'=> $request->input('description'),
        ]);
        return redirect('admin/services/list-services')->with('status','Cập nhật dịch vụ thành công');
    }
}
