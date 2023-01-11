<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shows;
use App\Models\Categories;
use App\Models\AudioFiles;

class ShowManage extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()):
            $validated = $request->validate([
              "title" => "required",
            ]);
            $categoryRecord=Categories::find($request->input('categoryId'));
            if($validated):
                if(empty($request->input('updateId'))):
                    if(Shows::whereRaw("LOWER(`title`) = '".strtolower($request->input('title'))."'")->where('status','!=',3)->exists()):
                        return response()->json([
                            'status'=>FALSE,
                            'message'=>'Show already exists!',
                            'redirect'=>'',
                        ]);
                    endif;
                    $image = NULL;
                    if($request->hasFile('image')):
                        $image = (time()+10).'.'.$request->file('image')->extension();
                        $request->file('image')->move(public_path('uploads/categories/'.($categoryRecord->slug)), $image);
                    endif;
                    $sampleFile = NULL;
                    $sampleFileOriginalName = NULL;
                    if($request->hasFile('sample_file')):
                        $sampleFile = (time()+15).'.'.$request->file('sample_file')->extension();
                        $sampleFileOriginalName = $request->file('sample_file')->getClientOriginalName();
                        $request->file('sample_file')->move(public_path('uploads/categories/'.($categoryRecord->slug)), $sampleFile);
                    endif;
                    $showInserted = Shows::create([
                        'category_id'                       => $request->input('categoryId'),
                        "title"                             => $request->input('title'),
                        "image"                             => $image,
                        "description"                       => $request->input('description'),
                        "no_of_episodes"                    => $request->input('no_of_episodes'),
                        "no_of_mp3_cds"                     => $request->input('no_of_mp3_cds'),
                        "instant_download_price"            => $request->input('instant_download_price'),
                        "mp3_cd_price"                      => $request->input('mp3_cd_price'),
                        "sample_file"                       => $sampleFile,
                        "sample_file_original_name"         => $sampleFileOriginalName
                    ]);
                    $audioFiles = [];
                    if($request->hasfile('audio_files')):
                        foreach($request->file('audio_files') as $file):
                            $name = time().rand(1,100).'.'.$file->extension();
                            $originalFileName = $file->getClientOriginalName();
                            $file->move(public_path('uploads/categories/'.($categoryRecord->slug)), $name);  
                            $audioFiles[] = [
                                'shows_id'=>$showInserted->id,
                                'file_original_name'=>$originalFileName,
                                'file_name'=>$name,
                            ];
                        endforeach;
                    endif;
                    AudioFiles::insert($audioFiles);
                    return response()->json([
                            'status'=>TRUE,
                            'message'=>'Show created successfully!',
                            'redirect'=>'category/show-list?categoryId='.$request->input('categoryId'),
                        ]);
                else:
                   if(Shows::whereRaw("LOWER(`title`) = '".strtolower($request->input('title'))."'")->where('status','!=',3)->where('id','<>',$request->input('updateId'))->exists()):
                        return response()->json([
                            'status'=>FALSE,
                            'message'=>'Category already exists!',
                            'redirect'=>'',
                        ]);
                    endif;
                    $updateData = [
                        "title"                             => $request->input('title'),
                        "description"                       => $request->input('description'),
                        "no_of_episodes"                    => $request->input('no_of_episodes'),
                        "no_of_mp3_cds"                     => $request->input('no_of_mp3_cds'),
                        "instant_download_price"            => $request->input('instant_download_price'),
                        "mp3_cd_price"                      => $request->input('mp3_cd_price'),
                        
                    ];
                    $image = NULL;
                    if($request->hasFile('image')):
                        $updateData['image'] = (time()+10).'.'.$request->file('image')->extension();
                        $request->file('image')->move(public_path('uploads/categories/'.($categoryRecord->slug)), $image);
                    endif;
                    $sampleFile = NULL;
                    $sampleFileOriginalName = NULL;
                    if($request->hasFile('sample_file')):
                        $updateData['sample_file'] = (time()+15).'.'.$request->file('sample_file')->extension();
                        $updateData['sample_file_original_name'] = $request->file('sample_file')->getClientOriginalName();
                        $request->file('sample_file')->move(public_path('uploads/categories/'.($categoryRecord->slug)), $sampleFile);
                    endif;
                    // dd($updateData);
                    Shows::find($request->input('updateId'))->update($updateData);
                    $audioFiles = [];
                    if($request->hasfile('audio_files')):
                        foreach($request->file('audio_files') as $file):
                            $name = time().rand(1,100).'.'.$file->extension();
                            $originalFileName = $file->getClientOriginalName();
                            $file->move(public_path('uploads/categories/'.($categoryRecord->slug)), $name);  
                            $audioFiles[] = [
                                'shows_id'=>$request->input('updateId'),
                                'file_original_name'=>$originalFileName,
                                'file_name'=>$name,
                            ];
                        endforeach;
                    endif;
                    AudioFiles::insert($audioFiles);
                    return response()->json([
                            'status'=>TRUE,
                            'message'=>'Show Updated successfully!',
                            'redirect'=>'category/show-list?categoryId='.$request->input('categoryId'),
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
        $title="Categories/Shows";
        return view('pages.show.list',compact('title'));
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
            $totalRecords = Shows::select('count(*) as allcount')->where('category_id',$request->input('categoryId'))->where('status','!=','3')->count();
            $totalRecordswithFilter = Shows::select('count(*) as allcount')->where('category_id',$request->input('categoryId'))->where('status','!=','3')->count();
            // ->when($published, function ($q) use ($published) {
            //     return $q->where('published', 1);
            // })
            $categoryRecord=Categories::find($request->input('categoryId'));
            // Fetch records
            $records = Shows::selectRaw('shows.*')
                        ->where('category_id',$request->input('categoryId'))
                        ->where('status','!=','3')
                        ->orderBy($columnName,$columnSortOrder)
                        ->skip($start)
                        ->take($rowperpage)
                        ->get();
            $tempArr = [];
            foreach ($records as $key => $value):
                if($value->status=='1'):
                    $status='<a href="javascript:void(0)" id="'.($value->id).'" data-table="shows" data-status="0" data-key="id" data-id="'.($value->id).'" class="badge badge-primary change-status">Active</a>';
                else:
                    $status='<a href="javascript:void(0)" id="'.($value->id).'" data-table="shows" data-status="1" data-key="id" data-id="'.($value->id).'" class="badge badge-danger change-status">InActive</a>';
                endif;
                $action = '<a href="'.(url("category/show-edit/".$value->id."?categoryId=".$request->input('categoryId'))).'" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a href="javascript:void(0)" id="'.($value->id).'" data-table="shows" data-status="3" data-key="id" data-id="'.($value->id).'" class="btn btn-danger change-status"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                $image='';
                if($value->image && $value->image !=''):
                    $image = '<img src="'.asset('uploads/categories/'.$categoryRecord->slug.'/'.$value->image).'" width="180" height="150">';
                endif;
                $tempArr[]=[
                    'id'=>($key+1),
                    'title'=>$value->title,
                    'image'=>$image,
                    'description'=>substr(strip_tags($value->description),0,100),
                    'no_of_episodes'=>$value->no_of_episodes,
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
    public function add($id='',Request $request)
    {
        if(!empty($id)):
            $title="Show Edit";
            $oldData = Shows::find($id);
        else:
            $title="Show Add";
            $oldData = NULL;
        endif;
        $categoryRecord=Categories::find($request->input('categoryId'));
        return view('pages.show.add',compact('oldData','title','categoryRecord'));
    }
}
