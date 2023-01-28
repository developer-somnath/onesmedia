<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfferManagement;
use Illuminate\Support\Str;
use App\Models\Shows;

class Offer extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()):
            // $validated = $request->validate([
            //   "name" => "required",
            // ]);
            // if($validated):
                if(empty($request->input('updateId'))):
                    $image = NULL;
                    if($request->hasFile('image')):
                        $image = (time()+10).'.'.$request->file('image')->extension();
                        $request->file('image')->move(public_path('uploads/offer/'), $image);
                    endif;
                    
                    OfferManagement::create([
                        "description"       => $request->input('description'),
                        "type"              => $request->input('type'),
                        "discount_amount"   => $request->input('discount_amount'),
                        "applicable_shows"   => implode(',',$request->input('applicable_shows')),
                        "start_date"        => $request->input('start_date'),
                        "end_date"          => $request->input('end_date'),
                        "discount_amount"   => $request->input('discount_amount'),
                        "image"             => $image
                    ]);
                    return response()->json([
                            'status'=>TRUE,
                            'message'=>'Offer created successfully!',
                            'redirect'=>'offer/list',
                        ]);
                else:
                   
                    $updateData = [
                        "description" => $request->input('description'),
                        "type"              => $request->input('type'),
                        "discount_amount"   => $request->input('discount_amount'),
                        "start_date"        => $request->input('start_date'),
                        "end_date"          => $request->input('end_date'),
                        "applicable_shows"   => implode(',',$request->input('applicable_shows')),
                        // "image"             => $image
                    ];
                    if($request->hasFile('image')):
                        $updateData['image'] = $image= (time()+10).'.'.$request->file('image')->extension();
                        $request->file('image')->move(public_path('uploads/offer/'), $image);
                    endif;
                    
                    OfferManagement::find($request->input('updateId'))->update($updateData);
                    return response()->json([
                            'status'=>TRUE,
                            'message'=>'Offer Updated successfully!',
                            'redirect'=>'offer/list',
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
        $offerList=OfferManagement::where('status','!=','3')->get();
        $title="Offer List";
        return view('pages.offer.list',compact('title','offerList'));
    }
    
    public function add($id='')
    {
        if(!empty($id)):
            $title="Offer Edit";
            $oldData = OfferManagement::find($id);
        else:
            $title="Offer Add";
            $oldData = NULL;
        endif;
        $showList = Shows::select('id','title')->where('status','!=','3')->get();
        return view('pages.offer.add',compact('oldData','title','showList'));
    }

    
}
