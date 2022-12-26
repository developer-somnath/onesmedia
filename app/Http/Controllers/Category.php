<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Category extends Controller
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
}
