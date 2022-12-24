<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Dashboard extends Controller
{
    public function index()
    {
        $title="Dashboard";
        return view('pages.dashboard',compact('title'));
    }
}
