<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class Category extends Controller
{
    public function index($id='')
    {
        $categoryList = Categories::where('status',1)->where('parent',0)->get();
        $title="Categories";
        return view('pages.category.list',compact('title','categoryList'));
    }
}
