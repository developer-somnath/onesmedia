@push('css')
@endpush
@extends('layouts.master')
@section('content')
<div class="app-main__inner">
   <div class="row">
      <div class="col-md-12">
         <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 text-right"><a href="{{route('sample-file-list')}}" class="btn btn-info">Free Download File List</a></div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="main-card  p-3 card">
            <div class="card-header mb-3">                                  
                Free Download  File                                
            </div>
            <form class="adminFrm" data-action="free-downloads/list" method="post">
               @csrf
               <input type="hidden" name="updateId" value="{{!is_null($oldData)?$oldData->id:''}}">
               <div class="form-row">

                  <div class="col-md-6">
                     <div class="position-relative form-group">
                        <label style="">Title</label>
                        <input name="title" id="title" placeholder="Enter Title" type="text" class="form-control requiredCheck" data-check="Title" value="{{!is_null($oldData)?$oldData->title:''}}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="position-relative form-group">
                        <label style="">Image</label>
                        
                        <input name="image" id="image" type="file" class="form-control" data-check="Image" accept="image/*">
                        @if(!is_null($oldData) && $oldData->image!='')
                        <img src="{{ asset('uploads/free-downloads/'.$oldData->image) }}" width="180" height="150">
                        @endif
                     </div>
                  </div> 
                  <div class="col-md-12">
                     <div class="position-relative form-group">
                        <label style="">Description</label>
                        <textarea name="description" id="description" class="form-control requiredCheck ckeditor" data-check="Description">{{!is_null($oldData)?$oldData->description:''}}</textarea>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="position-relative form-group">
                        <label class="m">Sample File</label>
                        <input name="sample_file" id="sample_file" type="file" class="form-control {{(!is_null($oldData) && $oldData->file_name!='' )?'':'requiredCheck'}}" data-check="Sample File" accept="audio/*">
                        @if(!is_null($oldData))
                           <audio controls >
                              <source src="{{ asset('uploads/free-downloads/'.$oldData->file_name) }}" type="audio/ogg">
                              <source src="{{ asset('uploads/free-downloads/'.$oldData->file_name) }}" type="audio/mpeg">
                           Your browser does not support the audio element.
                           </audio>
                        @endif
                     </div>
                  </div>
                  <div class="col-md-6">
                    <div class="position-relative form-group">
                       <label style="">Downloadable Date</label>
                       <input name="download_date" id="download_date" placeholder="Enter Date" type="date" class="form-control requiredCheck" data-check="Downloadable Date" value="{{!is_null($oldData)?$oldData->download_date:''}}">
                    </div>
                 </div>
                  
               </div>
               <div class="d-flex align-items-left">
                  <div class="mx-auto">
                     <div class="clearfix mb-4"></div>
                     <button class="btn btn-warning btn-lg" type="submit">{{!is_null($oldData)?'Update':'Save'}}</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@stop
@push('scripts')
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script type="text/javascript">
CKEDITOR.replaceClass='ckeditor';
CKEDITOR.config.allowedContent=true;
     
</script>
@endpush