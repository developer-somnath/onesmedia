<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FreeDownload;

class FreeDownloadManage extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()):
            $validated = $request->validate([
              "title" => "required",
              "description" => "required",
              "download_date" => "required",
            ]);
            if($validated):
                if(empty($request->input('updateId'))):
                    if(FreeDownload::whereRaw("LOWER(`title`) = '".strtolower($request->input('title'))."'")->where('status','!=',3)->exists()):
                        return response()->json([
                            'status'=>FALSE,
                            'message'=>'Free Download File already exists!',
                            'redirect'=>'',
                        ]);
                    endif;
                    $image = NULL;
                    if($request->hasFile('image')):
                        $image = (time()+10).'.'.$request->file('image')->extension();
                        $request->file('image')->move(public_path('uploads/free-downloads'), $image);
                    endif;
                    $sampleFile = NULL;
                    $sampleFileOriginalName = NULL;
                    if($request->hasFile('sample_file')):
                        $sampleFile = (time()+15).'.'.$request->file('sample_file')->extension();
                        $sampleFileOriginalName = $request->file('sample_file')->getClientOriginalName();
                        $request->file('sample_file')->move(public_path('uploads/free-downloads'), $sampleFile);
                    endif;
                    FreeDownload::create([
                        "title"                             => $request->input('title'),
                        "image"                             => $image,
                        "description"                       => $request->input('description'),
                        "download_date"                     => date('Y-m-d',$request->input('download_date')),
                        "file_name"                         => $sampleFile,
                        "file_original_name"                => $sampleFileOriginalName,
                    ]);
                    return response()->json([
                            'status'=>TRUE,
                            'message'=>'Free Download File created successfully!',
                            'redirect'=>'free-downloads/list',
                        ]);
                else:
                   if(FreeDownload::whereRaw("LOWER(`title`) = '".strtolower($request->input('title'))."'")->where('status','!=',3)->where('id','<>',$request->input('updateId'))->exists()):
                        return response()->json([
                            'status'=>FALSE,
                            'message'=>'Free Download File already exists!',
                            'redirect'=>'',
                        ]);
                    endif;
                    $updateData = [
                        "title"                             => $request->input('title'),
                        "description"                       => $request->input('description'),
                        "download_date"                     => date('Y-m-d',strtotime($request->input('download_date'))),
                    ];
                    $image = NULL;
                    if($request->hasFile('image')):
                        $updateData['image'] = (time()+10).'.'.$request->file('image')->extension();
                        $request->file('image')->move(public_path('uploads/free-downloads'), $updateData['image']);
                    endif;
                    $sampleFile = NULL;
                    $sampleFileOriginalName = NULL;
                    if($request->hasFile('sample_file')):
                        $updateData['file_name'] = (time()+15).'.'.$request->file('sample_file')->extension();
                        $updateData['file_original_name'] = $request->file('sample_file')->getClientOriginalName();
                        $request->file('sample_file')->move(public_path('uploads/free-downloads'), $updateData['file_name']);
                    endif;
                    FreeDownload::find($request->input('updateId'))->update($updateData);
                    return response()->json([
                            'status'=>TRUE,
                            'message'=>'Free Download File Updated successfully!',
                            'redirect'=>'free-downloads/list',
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
        $title="Free Download Files";
        return view('pages.free-download.list',compact('title'));
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
            $totalRecords = FreeDownload::select('count(*) as allcount')->where('status','!=','3')->count();
            $totalRecordswithFilter = FreeDownload::select('count(*) as allcount')->where('status','!=','3')->count();
            // ->when($published, function ($q) use ($published) {
            //     return $q->where('published', 1);
            // })
            // Fetch records
            $records = FreeDownload::selectRaw('free_downloads.*')
                        
                        ->where('status','!=','3')
                        ->orderBy($columnName,$columnSortOrder)
                        ->skip($start)
                        ->take($rowperpage)
                        ->get();
            $tempArr = [];
            foreach ($records as $key => $value):
                if($value->status=='1'):
                    $status='<a href="javascript:void(0)" id="'.($value->id).'" data-table="free_downloads" data-status="0" data-key="id" data-id="'.($value->id).'" class="badge badge-primary change-status">Active</a>';
                else:
                    $status='<a href="javascript:void(0)" id="'.($value->id).'" data-table="free_downloads" data-status="1" data-key="id" data-id="'.($value->id).'" class="badge badge-danger change-status">InActive</a>';
                endif;
                $action = '<a href="'.(url("free-downloads/edit/".$value->id)).'" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a href="javascript:void(0)" id="'.($value->id).'" data-table="free_downloads" data-status="3" data-key="id" data-id="'.($value->id).'" class="btn btn-danger change-status"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                $image='';
                if($value->image && $value->image !=''):
                    $image = '<img src="'.asset('uploads/free-downloads/'.$value->image).'" width="180" height="150">';
                endif;
                $tempArr[]=[
                    'id'=>($key+1),
                    'title'=>$value->title,
                    'image'=>$image,
                    'description'=>substr(strip_tags($value->description),0,100),
                    'download_date'=>date('d-m-Y',strtotime($value->download_date)),
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
            $title="Free Download File Edit";
            $oldData = FreeDownload::find($id);
        else:
            $title="Free Download File Add";
            $oldData = NULL;
        endif;
        return view('pages.free-download.add',compact('oldData','title'));
    }
}
