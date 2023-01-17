<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
class BannerManage extends Controller
{
   public function index(Request $request)
   {
    if($request->ajax()):
        $validated = $request->validate([
          "image" => "required",
        ]);
        if($validated):
            if(empty($request->input('updateId'))):
                
                $image = NULL;
                if($request->hasFile('image')):
                    $image = (time()+10).'.'.$request->file('image')->extension();
                    $request->file('image')->move(public_path('uploads/banners'), $image);
                endif;
                
                Banner::create([
                    "short_description"              => $request->input('short_description'),
                    "image"             => $image
                ]);
                return response()->json([
                        'status'=>TRUE,
                        'message'=>'Banner created successfully!',
                        'redirect'=>'banner/list',
                    ]);
            else:
               
                $updateData = [
                    "short_description"              => $request->input('short_description'),
                ];
                if($request->hasFile('image')):
                    $updateData['image'] = $image= (time()+10).'.'.$request->file('image')->extension();
                    $request->file('image')->move(public_path('uploads/banners'), $image);
                endif;
                
                Banner::find($request->input('updateId'))->update($updateData);
                return response()->json([
                        'status'=>TRUE,
                        'message'=>'Banner Updated successfully!',
                        'redirect'=>'banner/list',
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
    $title="Banner Management";
    $bannerList=Banner::where('status','1')->get();
    return view('pages.banner.list',compact('title','bannerList'));
   }
   public function add($id='')
    {
        if(!empty($id)):
            $title="Category Edit";
            $oldData = Banner::find($id);
        else:
         $title="Category Add";
            $oldData = NULL;

        endif;
        
        return view('pages.banner.add',compact('oldData','title'));
    }
}
