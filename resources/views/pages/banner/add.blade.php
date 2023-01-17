
@extends('layouts.master')
@section('content')
<div class="app-main__inner">
   <div class="row">
      <div class="col-md-12">
         <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 text-right"><a href="{{route('banner-list')}}" class="btn btn-info">Banner List</a></div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="main-card  p-3 card">
            <div class="card-header mb-3">
               Banner Add                                   
            </div>
            <form class="adminFrm" data-action="banner/list" method="post">
               @csrf
               <input type="hidden" name="updateId" value="{{!is_null($oldData)?$oldData->id:''}}">
               <div class="form-row">
                  
                  <div class="col-md-6">
                     <div class="position-relative form-group">
                        <label style="">Banner Image</label>
                        
                        <input name="image" id="image" type="file" class="form-control" data-check="Banner Image" accept="image/*">
                        @if(!is_null($oldData) && $oldData->image!='')
                        <img src="{{ asset('uploads/banners/'.$oldData->image) }}" width="180" height="150">
                        @endif
                     </div>
                  </div>    
                  <div class="col-md-6">
                     <div class="position-relative form-group">
                        <label style="">Short Description</label>
                        <input name="short_description" id="short_description" placeholder="Enter Short Description" type="text" class="form-control requiredCheck" data-check="Category Name" value="{{!is_null($oldData)?$oldData->short_description:''}}">
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
