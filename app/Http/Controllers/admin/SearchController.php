<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    //
    function getSearch(){
        return view('admin.list-user');
    }
    function getSearchAjax(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('users')
            ->where('name', 'LIKE', "%{$query}%")
            ->get();
            $stt = 1;
            $output = '';
            foreach($data as $row)
            {
                $output .= '

                    <tr>helo
                    <td>
                        <input name="list_check[]" value="'.$row->id.' " type="checkbox">
                    </td>
                    <th scope="row"> '. $stt++.' </th>

                    <td>'.$row->name .'</td>
                    <td>'.$row->email.' </td>
                    <td>Admintrator</td>
                    <td>'.$row->created_at.' </td>
                    <td>
                            <a href="'.route('admin/edit',$row->id).' " class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>

                            <a href="'.route ('admin/user/delete', $row->id) .'" onclick="return confirm("bạn có chắc chắc xóa bản ghi này ?") " class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>

                        </td>
                        </tr>
               ';
           }
           $data['data'] = $output;
           return response( $data );
       }
    }
    function getSearchProductAjax(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('products')
            ->where('name', 'LIKE', "%{$query}%")
            ->get();
            $stt = 1;
            $output = '';
            foreach($data as $row)
            {
                $output .= '

                    <tr>
                    <td>
                        <input name="list_check[]" value="'.$row->id.' " type="checkbox">
                    </td>
                    <th scope="row"> '. $stt++.' </th>

                    <td>'.$row->name .'</td>
                    <td>'.$row->content.' </td>
                    <td>'.$row->thumbnail.' </td>
                    <td>'.$row->price.' </td>
                    <td>'.$row->created_at.' </td>
                    <td>
                            <a href="'.route('admin/edit',$row->id).' " class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>

                            <a href="'.route ('admin/user/delete', $row->id) .'" onclick="return confirm("bạn có chắc chắc xóa bản ghi này ?") " class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>

                        </td>
                        </tr>
               ';
           }
           $data['data'] = $output;
           return response( $data );
       }
    }
}
