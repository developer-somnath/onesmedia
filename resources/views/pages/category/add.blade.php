
@extends('layouts.master')
@section('content')
<div class="app-main__inner">
   <div class="row">
      <div class="col-md-12">
         <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 text-right"><a href="{{route('category-list')}}" class="btn btn-info">Category/Product List</a></div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="main-card  p-3 card">
            <div class="card-header mb-3">
               Category/Product Add                                   
            </div>
            <form class="adminFrm" data-action="category-products/create" method="post">
               @csrf
               <input type="hidden" name="updateId" value="{{!is_null($oldData)?$oldData->id:''}}">
               <input type="hidden" name="type" value="{{ $type }}">
               <input type="hidden" name="parent" value="{{ $parentId }}">
               <div class="form-row">
                  <div class="col-md-6">
                     <div class="position-relative form-group">
                        <label style="">{{ ($type==='C')?'Category':'Product' }} Name</label>
                        <input name="name" id="name" placeholder="Enter {{ ($type==='C')?'Category':'Product' }} Name" type="text" class="form-control requiredCheck allowOnlyLetterSpace" data-check="{{ ($type==='C')?'Category':'Product' }} Name" value="{{!is_null($oldData)?$oldData->name:''}}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="position-relative form-group">
                        <label style="">{{ ($type==='C')?'Category':'Product' }} Image</label>
                        
                        <input name="image" id="image" type="file" class="form-control {{(!is_null($oldData) && $oldData->image!='' )?'':'requiredCheck'}} " data-check="{{ ($type==='C')?'Category':'Product' }} Image" accept="image/*">
                        @if(!is_null($oldData))
                        <img src="{{ asset('uploads/categories/'.$oldData->slug.'/'.$oldData->image) }}" width="180" height="150">
                        @endif
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="position-relative form-group">
                        <label style="">{{ ($type==='C')?'Category':'Product' }} Description</label>
                        <textarea name="description" id="description" class="form-control requiredCheck ckeditor" data-check="{{ ($type==='C')?'Category':'Product' }} Description">{{!is_null($oldData)?$oldData->description:''}}</textarea>
                     </div>
                  </div>
                  
                  @if($type==='F')
                     <div class="col-md-6">
                        <div class="position-relative form-group">
                           <label class="m">Product File</label>
                           
                           <input name="file" id="file" type="file" class="form-control {{(!is_null($oldData) && $oldData->file!='' )?'':'requiredCheck'}}" data-check="Product File" accept="audio/*">
                           @if(!is_null($oldData))
                              <audio controls >
                                <source src="{{ asset('uploads/categories/'.$oldData->slug.'/'.$oldData->file) }}" type="audio/ogg">
                                <source src="{{ asset('uploads/categories/'.$oldData->slug.'/'.$oldData->file) }}" type="audio/mpeg">
                              Your browser does not support the audio element.
                              </audio>
                           @endif
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="position-relative form-group">
                           <label style="">Product Quantity</label>
                           <input name="quantity" id="quantity" type="text" class="form-control requiredCheck" data-check="Product Quantity" accept="audio/*" onkeypress="return isNumber()" value="{{!is_null($oldData)?$oldData->quantity:''}}">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="position-relative form-group">
                           <label style="">Product Price</label>
                           <input name="price" id="price" type="text" class="form-control requiredCheck checkDecimal" data-check="Product Price"  onkeypress="isNumber()" value="{{!is_null($oldData)?$oldData->price:''}}">
                        </div>
                     </div>
                  @endif
                  
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