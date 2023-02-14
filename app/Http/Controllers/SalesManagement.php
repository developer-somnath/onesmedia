<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Sale;
use App\Models\Shows;

class SalesManagement extends Controller
{
    public function index(Request $request)
    { 
        if($request->ajax()):
        // dd($_REQUEST);

            // $validated = $request->validate([
            //   "name" => "required",
            // ]);
            // if($validated):
                if(empty($request->input('updateId'))):
                    
                    
                    Sale::create([
                        "title"       => $request->input('title'),
                        "min_price_range"              => $request->input('min_price_range'),
                        "max_price_range"   => $request->input('max_price_range'),
                        "applicable_categories"   => implode(',',$request->input('applicable_categories')),
                        "discount_type"        => $request->input('discount_type'),
                        "discount_amount"        => $request->input('discount_amount'),
                        "type"        => $request->input('type'),
                        "start_date"        => $request->input('start_date'),
                        "end_date"        => $request->input('end_date'),
                        
                    ]);
                    return response()->json([
                            'status'=>TRUE,
                            'message'=>' Category Sale created successfully!',
                            'redirect'=>'category-sale/list',
                        ]);
                else:
                   
                    $updateData = [
                        "title"       => $request->input('title'),
                        "min_price_range"              => $request->input('min_price_range'),
                        "max_price_range"   => $request->input('max_price_range'),
                        "applicable_categories"   => implode(',',$request->input('applicable_categories')),
                        "discount_type"        => $request->input('discount_type'),
                        "discount_amount"        => $request->input('discount_amount'),
                        "type"        => $request->input('type'),
                        "start_date"        => $request->input('start_date'),
                        "end_date"        => $request->input('end_date'),
                    ];

                    Sale::find($request->input('updateId'))->update($updateData);
                    return response()->json([
                            'status'=>TRUE,
                            'message'=>'Category Sale Updated successfully!',
                            'redirect'=>'category-sale/list',
                        ]); 
                endif;
            // else:
            //     return response()->json([
            //         'status'=>FALSE,
            //         'message'=>'All data are not present in the request!',
            //         'redirect'=>'',
            //     ]);
            // endif;
        endif;
        $saleList=Sale::where('status','!=','3')->where('type','2')->get();
        $title="Category Sale List";
        return view('pages.sale.list',compact('title','saleList'));
    }
    
    public function add($id='')
    {
        if(!empty($id)):
            $title="Category Sale Edit";
            $oldData = Sale::find($id);
        else:
            $title="Category Sale Add";
            $oldData = NULL;
        endif;
        $CategoriyList = Categories::select('id','name')->where('status','!=','3')->get();
        return view('pages.sale.add',compact('oldData','title','CategoriyList'));
    }

    public function todaySales(Request $request)
    { 
        if($request->ajax()):
        // dd($_REQUEST);

            // $validated = $request->validate([
            //   "name" => "required",
            // ]);
            // if($validated):
                if(empty($request->input('updateId'))):
                    
                    
                    Sale::create([
                        "title"       => $request->input('title'),
                        "applicable_shows"   => implode(',',$request->input('applicable_shows')),
                        "discount_type"        => $request->input('discount_type'),
                        "discount_amount"        => $request->input('discount_amount'),
                        "type"                  => $request->input('type'),
                        "sale_date"        => $request->input('sale_date')
                        
                    ]);
                    return response()->json([
                            'status'=>TRUE,
                            'message'=>' Today Sale created successfully!',
                            'redirect'=>'today-sale/list',
                        ]);
                else:
                   
                    $updateData = [
                        "title"       => $request->input('title'),
                        "applicable_shows"   => implode(',',$request->input('applicable_shows')),
                        "discount_type"        => $request->input('discount_type'),
                        "discount_amount"        => $request->input('discount_amount'),
                        "type"        => $request->input('type'),
                        "sale_date"        => $request->input('sale_date')
                    ];

                    Sale::find($request->input('updateId'))->update($updateData);
                    return response()->json([
                            'status'=>TRUE,
                            'message'=>'Today Sale Updated successfully!',
                            'redirect'=>'today-sale/list',
                        ]); 
                endif;
            // else:
            //     return response()->json([
            //         'status'=>FALSE,
            //         'message'=>'All data are not present in the request!',
            //         'redirect'=>'',
            //     ]);
            // endif;
        endif;
        $saleList=Sale::where('status','!=','3')->where('type','1')->get();
        $title="Today Sale List";
        return view('pages.sale..today.list',compact('title','saleList'));
    }
    
    public function todaySaleAdd($id='')
    {
        if(!empty($id)):
            $title="Today Sale Edit";
            $oldData = Sale::find($id);
        else:
            $title="Today  Sale Add";
            $oldData = NULL;
        endif;
        $showList = Shows::select('id','title')->where('status','!=','3')->get();
        return view('pages.sale.today.add',compact('oldData','title','showList'));
    }
}
