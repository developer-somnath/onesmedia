<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
class Authenticate extends Controller
{
    public function login()
    {
        if(Auth::check()):
            return redirect('dashboard');
        endif;
        return view('pages.login');
    }

    public function userCheck(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if($validated):
            if(Auth::attempt($request->only('email','password'))):
                if(Auth::user()->user_type==1):
                    return response()->json([
                        'status'=>TRUE,
                        'message'=>'Logged In suceessfully!',
                        'redirect'=>'dashboard',
                    ]);
                else:
                    Session::flush();
                    Auth::logout();
                    return response()->json([
                            'status'=>FALSE,
                            'message'=>'Unauthorized Access!',
                            'redirect'=>'login',
                        ]);
                endif;
            endif;
            return response()->json([
                    'status'=>FALSE,
                    'message'=>'Invalid Email or Password!',
                    'redirect'=>'',
                ]);
        else:
            return response()->json([
                    'status'=>FALSE,
                    'message'=>'All data are not present in the request!',
                    'redirect'=>'',
                ]);
        endif;
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }

    public function genericStatusChange(Request $request)
    {
        if($request->ajax()):
            $dbTransaction = \DB::table($request->input('table'))->where($request->input('keyId'),$request->input('id'))->update(['status'=>$request->input("status")]);
            if($dbTransaction):
                return response()->json([
                    'status'=>TRUE,
                    'message'=>'Request processed successfully!',
                    'redirect'=>'',
                    'postStatus'=>$request->input("status")
                ]);
            endif;
            return response()->json([
                    'status'=>FALSE,
                    'message'=>'Something went wrong!',
                    'redirect'=>'',
                    'postStatus'=>$request->input("status")
                ]);
        endif;
    }
    public function stateListByCountryId(Request $request)
    {
        if($request->ajax()):
            $stateList = \DB::table('states')->where('country_id',$request->input('countryId'))->get();
            if(count($stateList)>0):
                return response()->json([
                    'status'=>TRUE,
                    'message'=>'Data available!',
                    'data'=>$stateList
                ]);
            endif;
            return response()->json([
                    'status'=>FALSE,
                    'message'=>'No Data found!',
                    'redirect'=>'',
                ]);
        endif;
    }

}
