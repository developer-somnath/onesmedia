<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Str;

class Category extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()):
            $validated = $request->validate([
              "name" => "required",
            ]);
            if($validated):
                if(empty($request->input('updateId'))):
                    if(Categories::whereRaw("LOWER(`name`) = '".strtolower($request->input('name'))."'")->where('status','!=',3)->exists()):
                        return response()->json([
                            'status'=>FALSE,
                            'message'=>'Category already exists!',
                            'redirect'=>'',
                        ]);
                    endif;
                    $image = NULL;
                    if($request->hasFile('image')):
                        $image = (time()+10).'.'.$request->file('image')->extension();
                        $request->file('image')->move(public_path('uploads/categories/'.(Str::slug($request->input('name')))), $image);
                    endif;
                    // if($request->hasFile('file')):
                    //     $file = (time()+20).'.'.$request->file('file')->extension();
                    //     $originalFileName = $request->file('file')->getClientOriginalName();
                    //     $request->file('file')->move(public_path('uploads/categories/'.(Str::slug($request->input('name')))), $file);
                    // endif;
                    Categories::create([
                        "name"              => $request->input('name'),
                        'slug'              => Str::slug($request->input('name')),
                        "image"             => $image
                    ]);
                    return response()->json([
                            'status'=>TRUE,
                            'message'=>'Category created successfully!',
                            'redirect'=>'category/list',
                        ]);
                else:
                   if(Categories::whereRaw("LOWER(`name`) = '".strtolower($request->input('name'))."'")->where('status','!=',3)->where('id','<>',$request->input('updateId'))->exists()):
                        return response()->json([
                            'status'=>FALSE,
                            'message'=>'Category already exists!',
                            'redirect'=>'',
                        ]);
                    endif;
                    $updateData = [
                        "name"              => $request->input('name'),
                        'slug'              => Str::slug($request->input('name')),
                        "image"             => $image
                    ];
                    if($request->hasFile('image')):
                        $updateData['image'] = $image= (time()+10).'.'.$request->file('image')->extension();
                        $request->file('image')->move(public_path('uploads/categories/'.(Str::slug($request->input('name')))), $image);
                    endif;
                    // if($request->hasFile('file')):
                    //     $updateData['file'] =$file= (time()+20).'.'.$request->file('file')->extension();
                    //     $updateData['orginal_file_name'] =$originalFileName = $request->file('file')->getClientOriginalName();
                    //     $request->file('file')->move(public_path('uploads/categories/'.(Str::slug($request->input('name')))), $file);
                    // endif;
                    Categories::find($request->input('updateId'))->update($updateData);
                    return response()->json([
                            'status'=>TRUE,
                            'message'=>'Category Updated successfully!',
                            'redirect'=>'category/list',
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
        $title="Categories/Products";
        return view('pages.category.list',compact('title'));
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
            $totalRecords = Categories::select('count(*) as allcount')->where('status','!=','3')->count();
            $totalRecordswithFilter = Categories::select('count(*) as allcount')->where('status','!=','3')->count();
            // ->when($published, function ($q) use ($published) {
            //     return $q->where('published', 1);
            // })

            // Fetch records
            $records = Categories::selectRaw('categories.*,(select count(`id`) from `shows` where `category_id`= `categories`.`id` and `status`!="3") as total_shows')
                          ->where('status','!=','3')
                          ->orderBy($columnName,$columnSortOrder)
                          ->skip($start)
                          ->take($rowperpage)
                          ->get();
            $tempArr = [];
            foreach ($records as $key => $value):
                if($value->status=='1'):
                    $status='<a href="javascript:void(0)" id="'.($value->id).'" data-table="categories" data-status="0" data-key="id" data-id="'.($value->id).'" class="badge badge-primary change-status">Active</a>';
                else:
                    $status='<a href="javascript:void(0)" id="'.($value->id).'" data-table="categories" data-status="1" data-key="id" data-id="'.($value->id).'" class="badge badge-danger change-status">InActive</a>';
                endif;
                $action = '<a href="'.(url("category/edit/".$value->id)).'" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a href="javascript:void(0)" id="'.($value->id).'" data-table="categories" data-status="3" data-key="id" data-id="'.($value->id).'" class="btn btn-danger change-status"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                $image='';
                if($value->image && $value->image !=''):
                    $image = '<img src="'.asset('uploads/categories/'.$value->slug.'/'.$value->image).'" width="180" height="150">';
                endif;
                $tempArr[]=[
                    'id'=>($key+1),
                    'name'=>'<a href="'.(route('show-list')).'?categoryId='.($value->id).'"><img src="'.(asset('assets/images/folder.png')).'"> '.($value->name).'</a>',
                    'image'=>$image,
                    'total_shows'=>$value->total_shows,
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
    public function add($id='')
    {
        if(!empty($id)):
            $title="Category Edit";
            $oldData = Categories::find($id);
        else:
         $title="Category Add";
            $oldData = NULL;

        endif;
        
        return view('pages.category.add',compact('oldData','title'));
    }

    
}
