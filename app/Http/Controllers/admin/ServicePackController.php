<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Service;
use App\ServicePack;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ServicePackController extends Controller
{

    function __construct(){
        $this->middleware(function($request, $next){
            session(['module_active'=>'user']);
            return $next($request);
        });
    }
    function list(Request $request){
        $servicePacks = ServicePack::select('*')->with('service:id,name')->orderBy('id', 'desc')->get();
        foreach ($servicePacks as $key => $value) {
            $value->unitName = $value->time_to_use_unit ? ServicePack::getPackName($value->time_to_use_unit) : null;
        }
        return view('backend.services-pack.view-services',compact('servicePacks'));
    }
    function create(){
        $services = Service::get();
        return view('backend.services-pack.add-service',compact('services'));
    }
    function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'unit' => ['required'],
            'service' => ['required'],
        ],
        [
            'required'=>':attribute không được để trống',
            'min'=>':attribute có độ dại ít nhất :min ký tự',
            'max'=>':attribute có độ dài tối đa :max ký tự',
        ]);
        $data = $request->all();
        if($data['price']){
            $data['price'] = str_replace(',', '', $data['price']);
        }
        $unitName = $data['unit']
                    ? ($data['unit'] == ServicePack::PACK_WEEK_VALUE
                        ? ServicePack::PACK_WEEK
                        : ($data['unit'] == ServicePack::PACK_MONTH_VALUE
                            ? ServicePack::PACK_MONTH
                            : ($data['unit'] == ServicePack::PACK_YEAR_VALUE ? ServicePack::PACK_YEAR : null)
                        )
                    )
                    : null;
        ServicePack::create([
            'name' => $data['name'],
            'time_to_use_value' => $data['unit'],
            'time_to_use_unit' => $unitName,
            'service_id' => $data['service'],
            'price' => $data['price'],
        ]);
        return redirect('admin/services-pack/list-services-pack')->with('status','Thêm gói dịch vụ thành công');

    }

    function delete(Request $request){
        try {
            DB::beginTransaction();
                $data = $request->all();
                $checkCanDelete = User::where('service_pack_id', $data['id'])->count();
                if($checkCanDelete){
                    echo json_encode(["code" => 422, "message" => "Không thể xóa! Vì đã có tài khoản sử dụng dịch vụ này"]);
                    return;
                }
                $service = ServicePack::find($data['id']);
                $service->delete();
                echo json_encode(["code" => 200]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            echo json_encode(["code" => 500, "message" => $th->getMessage()]);
        }
    }

    function edit($id){
        $pack = ServicePack::find($id);
        $services = Service::get();
        return view('backend.services-pack.edit-service',compact('pack', 'services'));
    }
    function update(Request $request, $id){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'unit' => ['required'],
            'service' => ['required'],
        ],
        [
            'required'=>':attribute không được để trống',
            'min'=>':attribute có độ dại ít nhất :min ký tự',
            'max'=>':attribute có độ dài tối đa :max ký tự',
        ]);
        $data = $request->all();
        if($data['price']){
            $data['price'] = str_replace(',', '', $data['price']);
        }
        $unitName = $data['unit']
                    ? ($data['unit'] == ServicePack::PACK_WEEK_VALUE
                        ? ServicePack::PACK_WEEK
                        : ($data['unit'] == ServicePack::PACK_MONTH_VALUE
                            ? ServicePack::PACK_MONTH
                            : ($data['unit'] == ServicePack::PACK_YEAR_VALUE ? ServicePack::PACK_YEAR : null)
                        )
                    )
                    : null;
        ServicePack::where('id',$id)->update([
            'name' => $data['name'],
            'time_to_use_value' => $data['unit'],
            'time_to_use_unit' => $unitName,
            'service_id' => $data['service'],
            'price' => $data['price'],
        ]);
        return redirect('admin/services-pack/list-services-pack')->with('status','Cập nhật dịch vụ thành công');
    }
}
