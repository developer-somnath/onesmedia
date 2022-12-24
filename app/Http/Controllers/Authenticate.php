<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                return response()->json([
                    'status'=>TRUE,
                    'message'=>'Logged In suceessfully!',
                    'redirect'=>'dashboard',
                ]);
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
}
