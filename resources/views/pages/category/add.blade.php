
@extends('layouts.master')
@section('content')
<div class="app-main__inner">
   <div class="row">
      <div class="col-md-12">
         <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 text-right"><a href="{{route('category-list')}}" class="btn btn-info">Category List</a></div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="main-card  p-3 card">
            <div class="card-header mb-3">
               Category Add                                   
            </div>
            <form class="adminFrm" data-action="category/list" method="post">
               @csrf
               <input type="hidden" name="updateId" value="{{!is_null($oldData)?$oldData->id:''}}">
               <div class="form-row">
                  <div class="col-md-6">
                     <div class="position-relative form-group">
                        <label style="">Category Name</label>
                        <input name="name" id="name" placeholder="Enter Category Name" type="text" class="form-control requiredCheck" data-check="Category Name" value="{{!is_null($oldData)?$oldData->name:''}}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="position-relative form-group">
                        <label style="">Category Image</label>
                        
                        <input name="image" id="image" type="file" class="form-control" data-check="Category Image" accept="image/*">
                        @if(!is_null($oldData) && $oldData->image!='')
                        <img src="{{ asset('uploads/categories/'.$oldData->slug.'/'.$oldData->image) }}" width="180" height="150">
                        @endif
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
