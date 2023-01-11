
@extends('layouts.master')
@section('content')
<div class="app-main__inner">
   <div class="row">
      <div class="col-md-12">
         <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 text-right"><a href="{{route('show-list')}}?categoryId={{ Request::get('categoryId') }}" class="btn btn-info">Show List</a></div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="main-card  p-3 card">
            <div class="card-header mb-3">
               Category/Product Add                                   
            </div>
            <form class="adminFrm" data-action="category/show-list" method="post">
               @csrf
               <input type="hidden" name="updateId" value="{{!is_null($oldData)?$oldData->id:''}}">
               <input type="hidden" name="categoryId" value="{{ Request::get('categoryId') }}">
               <div class="form-row">

                  <div class="col-md-6">
                     <div class="position-relative form-group">
                        <label style="">Show Title</label>
                        <input name="title" id="title" placeholder="Enter Show Title" type="text" class="form-control requiredCheck" data-check="Show Title" value="{{!is_null($oldData)?$oldData->title:''}}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="position-relative form-group">
                        <label style="">Show Image</label>
                        
                        <input name="image" id="image" type="file" class="form-control" data-check="Show Image" accept="image/*">
                        @if(!is_null($oldData) && $oldData->image!='')
                        <img src="{{ asset('uploads/categories/'.$categoryRecord->slug.'/'.$oldData->image) }}" width="180" height="150">
                        @endif
                     </div>
                  </div> 
                  <div class="col-md-12">
                     <div class="position-relative form-group">
                        <label style="">Show Description</label>
                        <textarea name="description" id="description" class="form-control requiredCheck ckeditor" data-check="Show Description">{{!is_null($oldData)?$oldData->description:''}}</textarea>
                     </div>
                  </div>
                  
                  <div class="col-md-3">
                     <div class="position-relative form-group">
                        <label style="">No. Of Episodes</label>
                        <input name="no_of_episodes" id="no_of_episodes" type="text" class="form-control requiredCheck" placeholder="Enter No. of Episodes" data-check="No. of Episodes" onkeypress="return isNumber()" value="{{!is_null($oldData)?$oldData->no_of_episodes:''}}">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="position-relative form-group">
                        <label style="">No. Of MP3 CDs</label>
                        <input name="no_of_mp3_cds" id="no_of_mp3_cds" type="text" class="form-control requiredCheck" placeholder="Enter No. Of MP3 CDs" data-check="No. Of MP3 CDs" onkeypress="return isNumber()" value="{{!is_null($oldData)?$oldData->no_of_mp3_cds:''}}">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="position-relative form-group">
                        <label style="">Instant Download Price</label>
                        <input name="instant_download_price" id="instant_download_price" type="text" class="form-control requiredCheck checkDecimal" placeholder="Enter Instant Download Price" data-check="Instant Download Price"  value="{{!is_null($oldData)?$oldData->instant_download_price:''}}">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="position-relative form-group">
                        <label style="">MP3 CD Price</label>
                        <input name="mp3_cd_price" id="mp3_cd_price" type="text" class="form-control requiredCheck checkDecimal" placeholder="Enter MP3 CD Price" data-check="MP3 CD Price"  value="{{!is_null($oldData)?$oldData->mp3_cd_price:''}}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="position-relative form-group">
                        <label class="m">Sample File</label>
                        <input name="sample_file" id="sample_file" type="file" class="form-control {{(!is_null($oldData) && $oldData->sample_file!='' )?'':'requiredCheck'}}" data-check="Sample File" accept="audio/*">
                        @if(!is_null($oldData))
                           <audio controls >
                              <source src="{{ asset('uploads/categories/'.$categoryRecord->slug.'/'.$oldData->sample_file) }}" type="audio/ogg">
                              <source src="{{ asset('uploads/categories/'.$categoryRecord->slug.'/'.$oldData->sample_file) }}" type="audio/mpeg">
                           Your browser does not support the audio element.
                           </audio>
                        @endif
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="position-relative form-group">
                        <label class="m">Upload File</label>
                        <input name="audio_files[]" multiple id="audio_files" type="file" class="form-control " data-check="Upload File" accept="audio/*">
                        {{-- @if(!is_null($oldData))
                           <audio controls >
                              <source src="{{ asset('uploads/categories/'.$oldData->slug.'/'.$oldData->file) }}" type="audio/ogg">
                              <source src="{{ asset('uploads/categories/'.$oldData->slug.'/'.$oldData->file) }}" type="audio/mpeg">
                           Your browser does not support the audio element.
                           </audio>
                        @endif --}}
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