<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SampleFiles;

class SampleFileManage extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()):
            $validated = $request->validate([
              "title" => "required",
              "description" => "required",
            ]);
            if($validated):
                if(empty($request->input('updateId'))):
                    if(SampleFiles::whereRaw("LOWER(`title`) = '".strtolower($request->input('title'))."'")->where('status','!=',3)->exists()):
                        return response()->json([
                            'status'=>FALSE,
                            'message'=>'Sample File already exists!',
                            'redirect'=>'',
                        ]);
                    endif;
                    $image = NULL;
                    if($request->hasFile('image')):
                        $image = (time()+10).'.'.$request->file('image')->extension();
                        $request->file('image')->move(public_path('uploads/sample-files'), $image);
                    endif;
                    $sampleFile = NULL;
                    $sampleFileOriginalName = NULL;
                    if($request->hasFile('sample_file')):
                        $sampleFile = (time()+15).'.'.$request->file('sample_file')->extension();
                        $sampleFileOriginalName = $request->file('sample_file')->getClientOriginalName();
                        $request->file('sample_file')->move(public_path('uploads/sample-files'), $sampleFile);
                    endif;
                    SampleFiles::create([
                        "title"                             => $request->input('title'),
                        "image"                             => $image,
                        "description"                       => $request->input('description'),
                        "file_name"                         => $sampleFile,
                        "file_original_name"                => $sampleFileOriginalName
                    ]);
                    return response()->json([
                            'status'=>TRUE,
                            'message'=>'Sample File created successfully!',
                            'redirect'=>'sample-file/list',
                        ]);
                else:
                   if(SampleFiles::whereRaw("LOWER(`title`) = '".strtolower($request->input('title'))."'")->where('status','!=',3)->where('id','<>',$request->input('updateId'))->exists()):
                        return response()->json([
                            'status'=>FALSE,
                            'message'=>'Sample File already exists!',
                            'redirect'=>'',
                        ]);
                    endif;
                    $updateData = [
                        "title"                             => $request->input('title'),
                        "description"                       => $request->input('description'),
                    ];
                    $image = NULL;
                    if($request->hasFile('image')):
                        $updateData['image'] = (time()+10).'.'.$request->file('image')->extension();
                        $request->file('image')->move(public_path('uploads/sample-files'), $updateData['image']);
                    endif;
                    $sampleFile = NULL;
                    $sampleFileOriginalName = NULL;
                    if($request->hasFile('sample_file')):
                        $updateData['file_name'] = (time()+15).'.'.$request->file('sample_file')->extension();
                        $updateData['file_original_name'] = $request->file('sample_file')->getClientOriginalName();
                        $request->file('sample_file')->move(public_path('uploads/sample-files'), $updateData['file_name']);
                    endif;
                    SampleFiles::find($request->input('updateId'))->update($updateData);
                    return response()->json([
                            'status'=>TRUE,
                            'message'=>'Sample File Updated successfully!',
                            'redirect'=>'sample-file/list',
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
        $title="Sample Files";
        return view('pages.sample-files.list',compact('title'));
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
            $totalRecords = SampleFiles::select('count(*) as allcount')->where('status','!=','3')->count();
            $totalRecordswithFilter = SampleFiles::select('count(*) as allcount')->where('status','!=','3')->count();
            // ->when($published, function ($q) use ($published) {
            //     return $q->where('published', 1);
            // })
            // Fetch records
            $records = SampleFiles::selectRaw('sample_files.*')
                        
                        ->where('status','!=','3')
                        ->orderBy($columnName,$columnSortOrder)
                        ->skip($start)
                        ->take($rowperpage)
                        ->get();
            $tempArr = [];
            foreach ($records as $key => $value):
                if($value->status=='1'):
                    $status='<a href="javascript:void(0)" id="'.($value->id).'" data-table="sample_files" data-status="0" data-key="id" data-id="'.($value->id).'" class="badge badge-primary change-status">Active</a>';
                else:
                    $status='<a href="javascript:void(0)" id="'.($value->id).'" data-table="sample_files" data-status="1" data-key="id" data-id="'.($value->id).'" class="badge badge-danger change-status">InActive</a>';
                endif;
                $action = '<a href="'.(url("sample-file/edit/".$value->id)).'" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a href="javascript:void(0)" id="'.($value->id).'" data-table="sample_files" data-status="3" data-key="id" data-id="'.($value->id).'" class="btn btn-danger change-status"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                $image='';
                if($value->image && $value->image !=''):
                    $image = '<img src="'.asset('uploads/sample-files/'.$value->image).'" width="180" height="150">';
                endif;
                $tempArr[]=[
                    'id'=>($key+1),
                    'title'=>$value->title,
                    'image'=>$image,
                    'description'=>substr(strip_tags($value->description),0,100),
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
            $title="Sample File Edit";
            $oldData = SampleFiles::find($id);
        else:
            $title="Sample File Add";
            $oldData = NULL;
        endif;
        return view('pages.sample-files.add',compact('oldData','title'));
    }
}
