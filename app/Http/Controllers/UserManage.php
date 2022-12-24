<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use App\Models\Countries;
class UserManage extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()):
            $validated = $request->validate([
              "first_name" => "required",
              "last_name" => "required",
              "email" => "required",
              "phone" => "required",
              "street_address" => "required",
              "country_id" => "required",
              "state_id" => "required",
              "city" => "required",
              "zip_code" => "required"
            ]);
            if($validated):
                if(empty($request->input('updateId'))):
                    if(User::where('email', '=', $request->input('email'))->where('status','!=',3)->exists()):
                        return response()->json([
                            'status'=>FALSE,
                            'message'=>'Email already exists!',
                            'redirect'=>'',
                        ]);
                    endif;
                    if(User::where('phone', '=', $request->input('phone'))->where('status','!=',3)->exists()):
                        return response()->json([
                            'status'=>FALSE,
                            'message'=>'Phone already exists!',
                            'redirect'=>'',
                        ]);
                    endif;
                    User::create([
                        "first_name" => $request->input('first_name'),
                        "last_name" => $request->input('last_name'),
                        "email" => $request->input('email'),
                        "phone" => $request->input('phone'),
                        "street_address" => $request->input('street_address'),
                        "address_line_2" => $request->input('address_line2'),
                        "country_id" => $request->input('country_id'),
                        "state_id" => $request->input('state_id'),
                        "city" => $request->input('city'),
                        "zip_code" => $request->input('zip_code'),
                        "password" => Hash::make('secret'),
                        "user_type" => '2'
                    ]);
                    return response()->json([
                            'status'=>TRUE,
                            'message'=>'User created successfully!',
                            'redirect'=>'user/list',
                        ]);
                else:
                   if(User::where('email', '=', $request->input('email'))->where('status','!=',3)->where('id','<>',$request->input('updateId'))->exists()):
                        return response()->json([
                            'status'=>FALSE,
                            'message'=>'Email already exists!',
                            'redirect'=>'',
                        ]);
                    endif;
                    if(User::where('phone', '=', $request->input('phone'))->where('status','!=',3)->where('id','<>',$request->input('updateId'))->exists()):
                        return response()->json([
                            'status'=>FALSE,
                            'message'=>'Phone already exists!',
                            'redirect'=>'',
                        ]);
                    endif;
                    User::find($request->input('updateId'))->update([
                        "first_name" => $request->input('first_name'),
                        "last_name" => $request->input('last_name'),
                        "email" => $request->input('email'),
                        "phone" => $request->input('phone'),
                        "street_address" => $request->input('street_address'),
                        "address_line_2" => $request->input('address_line2'),
                        "country_id" => $request->input('country_id'),
                        "state_id" => $request->input('state_id'),
                        "city" => $request->input('city'),
                        "zip_code" => $request->input('zip_code'),
                        // "password" => Hash::make('secret'),
                        // "user_type" => '2'
                    ]);
                    return response()->json([
                            'status'=>TRUE,
                            'message'=>'User Updated successfully!',
                            'redirect'=>'user/list',
                        ]); 
                endif;
            else:
                return response()->json([
                    'status'=>FALSE,
                    'message'=>'All data are not present in the request!',
                    'redirect'=>'',
                ]);
            endif;
        endif;
        $title="User List";
        return view('pages.user-management.list',compact('title'));
    }
    public function add($id=''){
        if(!empty($id)):
            $oldData = User::find($id);
            $title="User Edit";
        else:
            $title="User Add";
            $oldData = NULL;
        endif;
        $countryList = Countries::whereIn('id',['231','4','89','177','232','240'])->get();
        return view('pages.user-management.add',compact('title','oldData','countryList'));
    }

    public function ajaxDataTable(Request $request)
    {
        if($request->ajax()):
            $draw           = $request->input('draw');
            $start          = $request->input("start");
            $rowperpage     = $request->input("length"); // Rows display per page
            $columnIndexArr = $request->input('order');
            $columnNameArr  = $request->input('columns');
            $orderArr       = $request->input('order');
            $searchArr      = $request->input('search');
            $columnIndex    = $columnIndexArr[0]['column']; // Column index
            $columnName     = $columnNameArr[$columnIndex]['data']; // Column name
            $columnSortOrder= $orderArr[0]['dir']; // asc or desc
            $searchValue    = $searchArr['value']; // Search value
            $totalRecords = User::select('count(*) as allcount')->where('status','!=','3')->where('user_type','!=','1')->count();
            $totalRecordswithFilter = User::select('count(*) as allcount')->where('status','!=','3')->where('user_type','!=','1')->count();
            // ->when($published, function ($q) use ($published) {
            //     return $q->where('published', 1);
            // })

            // Fetch records
            $records = User::selectRaw('users.*,c.name as country_name,s.name as state_name')
                        ->leftJoin('countries as c', function($join) {
                          $join->on('c.id', '=', 'users.country_id');
                        })
                        ->leftJoin('states as s', function($join) {
                          $join->on('s.id', '=', 'users.state_id');
                        })
                          ->where('status','!=','3')
                          ->where('user_type','!=','1')
                          ->orderBy($columnName,$columnSortOrder)
                          ->skip($start)
                          ->take($rowperpage)
                          ->get();
            $tempArr = [];
            foreach ($records as $key => $value):
                if($value->status=='1'):
                    $status='<a href="javascript:void(0)" id="'.($value->id).'" data-table="users" data-status="0" data-key="id" data-id="'.($value->id).'" class="badge badge-primary change-status">Active</a>';
                else:
                    $status='<a href="javascript:void(0)" id="'.($value->id).'" data-table="users" data-status="1" data-key="id" data-id="'.($value->id).'" class="badge badge-danger change-status">InActive</a>';
                endif;
                $action = '<a href="'.(url("user/edit/".$value->id)).'" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a href="javascript:void(0)" id="'.($value->id).'" data-table="users" data-status="3" data-key="id" data-id="'.($value->id).'" class="btn btn-danger change-status"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                $tempArr[]=[
                    'id'=>($key+1),
                    'first_name'=>$value->first_name.' '.$value->last_name,
                    'email'=>$value->email,
                    'phone'=>$value->phone,
                    'street_address'=>$value->street_address,
                    'address_line_2'=>$value->address_line_2,
                    'zip_code'=>$value->zip_code,
                    'city'=>$value->city,
                    'state'=>$value->state_name,
                    'country'=>$value->country_name,
                    'status'=>$status,
                    'action'=>$action
                 ];
            endforeach;
            return response()->json([
                    'draw'=>$draw,
                    'recordsTotal'=>$totalRecords,
                    'recordsFiltered'=>$totalRecordswithFilter,
                    'data'=>$tempArr,
                 ]);
        endif;
    }
}
