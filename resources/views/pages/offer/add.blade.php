
@extends('layouts.master')
@section('content')
<div class="app-main__inner">
   <div class="row">
      <div class="col-md-12">
         <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 text-right"><a href="{{route('offer-list')}}" class="btn btn-info">Offer List</a></div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="main-card  p-3 card">
            <div class="card-header mb-3">
               Offer Add                                   
            </div>
            <form class="adminFrm" data-action="offer/list" method="post">
               @csrf
               <input type="hidden" name="updateId" value="{{!is_null($oldData)?$oldData->id:''}}">
               <div class="form-row">
                  
                  <div class="col-md-6">
                     <div class="position-relative form-group">
                        <label style="">Background Image</label>
                        
                        <input name="image" id="image" type="file" class="form-control" data-check="Banner Image" accept="image/*">
                        @if(!is_null($oldData) && $oldData->image!='')
                        <img src="{{ asset('uploads/offer/'.$oldData->image) }}" width="180" height="150">
                        @endif
                     </div>
                  </div>    
                  <div class="col-md-12">
                     <div class="position-relative form-group">
                        <label style="">Description</label>
                        <textarea name="description" id="description" class="form-control requiredCheck ckeditor" data-check="Description">{{!is_null($oldData)?$oldData->description:''}}</textarea>

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