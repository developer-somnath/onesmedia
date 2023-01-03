<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryAndProduct;
use Illuminate\Support\Str;

class Category extends Controller
{
    public function index(Request $request)
    {

        $parentId = 0;
        if($request->get('parentId')):
            $parentId=$request->get('parentId') ;
        endif;
        $categoryProductList = CategoryAndProduct::where('status','!=','3')->where('parent',$parentId)->get();
        $title="Categories/Products";
        return view('pages.category.list',compact('title','categoryProductList','parentId'));
    }

    public function add($type='',$parentId='',$id='')
    {
        if(!empty($id)):
            if($type==='C'):
                $title="Category Edit";
            else:
                $title="Product Edit";
            endif;
            $oldData = CategoryAndProduct::find($id);
        else:
            if($type==='C'):
                $title="Category Add";
            else:
                $title="Product Add";
            endif;
            $oldData = NULL;

        endif;
        
        return view('pages.category.add',compact('type','oldData','title','parentId'));
    }

    public function create(Request $request)
    {
        if($request->ajax()):
            $validated = $request->validate([
              "name" => "required",
            ]);
            if($validated):
                if(empty($request->input('updateId'))):
                    if(CategoryAndProduct::whereRaw("LOWER(`name`) = '".strtolower($request->input('name'))."'")->where('status','!=',3)->where('type',$request->input('type'))->exists()):
                        return response()->json([
                            'status'=>FALSE,
                            'message'=>(($request->input('type')==='C')?'Category':'Product').' already exists!',
                            'redirect'=>'',
                        ]);
                    endif;
                    $originalFileName = NULL;
                    $file = NULL;
                    $image = NULL;
                    if($request->hasFile('image')):
                        $image = (time()+10).'.'.$request->file('image')->extension();
                        $request->file('image')->move(public_path('uploads/categories/'.(Str::slug($request->input('name')))), $image);
                    endif;
                    if($request->hasFile('file')):
                        $file = (time()+20).'.'.$request->file('file')->extension();
                        $originalFileName = $request->file('file')->getClientOriginalName();
                        $request->file('file')->move(public_path('uploads/categories/'.(Str::slug($request->input('name')))), $file);
                    endif;
                    CategoryAndProduct::create([
                        "name"              => $request->input('name'),
                        'slug'              => Str::slug($request->input('name')),
                        "orginal_file_name" => $originalFileName,
                        "file"              => $file,
                        "image"             => $image,
                        "price"             => $request->input('price')?$request->input('price'):NULL,
                        "quantity"          => $request->input('quantity')?$request->input('quantity'):NULL,
                        "description"       => $request->input('description'),
                        "parent"            => $request->input('parent'),
                        "type"              => $request->input('type'),
                    ]);
                    return response()->json([
                            'status'=>TRUE,
                            'message'=>(($request->input('type')==='C')?'Category':'Product').' created successfully!',
                            'redirect'=>'category-products/list?parentId='.$request->input('parent'),
                        ]);
                else:
                   if(CategoryAndProduct::whereRaw("LOWER(`name`) = '".strtolower($request->input('name'))."'")->where('status','!=',3)->where('type',$request->input('type'))->where('id','<>',$request->input('updateId'))->exists()):
                        return response()->json([
                            'status'=>FALSE,
                            'message'=>(($request->input('type')==='C')?'Category':'Product').' already exists!',
                            'redirect'=>'',
                        ]);
                    endif;
                    $updateData = [
                        "name"              => $request->input('name'),
                        'slug'              => Str::slug($request->input('name')),
                        "price"             => $request->input('price')?$request->input('price'):NULL,
                        "quantity"          => $request->input('quantity')?$request->input('quantity'):NULL,
                        "description"       => $request->input('description'),
                        "parent"            => $request->input('parent'),
                        "type"              => $request->input('type'),
                    ];
                    if($request->hasFile('image')):
                        $updateData['image'] = $image= (time()+10).'.'.$request->file('image')->extension();
                        $request->file('image')->move(public_path('uploads/categories/'.(Str::slug($request->input('name')))), $image);
                    endif;
                    if($request->hasFile('file')):
                        $updateData['file'] =$file= (time()+20).'.'.$request->file('file')->extension();
                        $updateData['orginal_file_name'] =$originalFileName = $request->file('file')->getClientOriginalName();
                        $request->file('file')->move(public_path('uploads/categories/'.(Str::slug($request->input('name')))), $file);
                    endif;
                    CategoryAndProduct::find($request->input('updateId'))->update($updateData);
                    return response()->json([
                            'status'=>TRUE,
                            'message'=>(($request->input('type')==='C')?'Category':'Product').' Updated successfully!',
                            'redirect'=>'category-products/list?parentId='.$request->input('parent'),
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
    }
}
