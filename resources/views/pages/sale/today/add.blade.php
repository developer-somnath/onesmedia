@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@extends('layouts.master')
@section('content')
<div class="app-main__inner">
   <div class="row">
      <div class="col-md-12">
         <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 text-right"><a href="{{route('today-sale-list')}}" class="btn btn-info">Sale List</a></div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="main-card  p-3 card">
            <div class="card-header mb-3">
             Today  Sale Add                                   
            </div>
            <form class="adminFrm" data-action="today-sale/list" method="post">
               @csrf
               <input type="hidden" name="updateId" value="{{!is_null($oldData)?$oldData->id:''}}">
               <input type="hidden" name="type" value="1">
               <div class="form-row">
                <div class="col-md-12">
                    <div class="position-relative form-group">
                       <label style="">Title</label>
                       <input name="title" id="title" type="text" class="form-control requiredCheck" data-check="Title" value="{{!is_null($oldData)?$oldData->title:''}}">
                    </div>
                 </div> 
                  
                 <div class="col-md-3">
                    <div class="position-relative form-group">
                       <label style="">Discount Type</label>
                       <select class="form-control requiredCheck" name="discount_type">
                        <option value="F" {{ !is_null($oldData) && ($oldData->discount_type == 'F')?'selected':'' }}>Fixed</option>
                        <option value="P" {{!is_null($oldData) && ($oldData->discount_type == 'P')?'selected':''}}>Percentage</option>
                       </select>
                    </div>
                 </div>
                 <div class="col-md-3">
                    <div class="position-relative form-group">
                       <label style="">Discount Amount</label>
                       <input name="discount_amount" id="discount_amount" type="text" class="form-control requiredCheck checkDecimal" data-check="Discount Amount" value="{{!is_null($oldData)?$oldData->discount_amount:''}}">

                    </div>
                 </div>
                 
                 <div class="col-md-3">
                    <div class="position-relative form-group">
                       <label style="">Sale Date</label>
                       <input name="sale_date" id="sale_date" type="Date" class="form-control requiredCheck" data-check="Sale Date" value="{{!is_null($oldData)?$oldData->sale_date:''}}">
                    </div>
                 </div>
                 
                  <div class="col-md-12">
                     <div class="position-relative form-group">
                        <label style="">Apply On Shows</label>
                        @php
                           $existingShows= [];
                           if(!is_null($oldData) && !empty($oldData->applicable_shows)):
                              $existingShows = explode(',',$oldData->applicable_shows);
                           endif;
                        @endphp
                        <select name="applicable_shows[]" id="applicable_shows" class="form-control requiredCheck" data-check="Apply On Shows" multiple>
                           <option value="">-Select Shows-</option>
                           @forelse ($showList as $show)
                              <option value="{{ $show->id }}" {{ in_array($show->id,$existingShows)?'selected':'' }}>{{ $show->title }}</option>
                           @empty
                              <option value="">No show found!</option>
                           @endforelse
                        </select>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
CKEDITOR.replaceClass='ckeditor';
CKEDITOR.config.allowedContent=true;
$(document).ready(function() {
    $('#applicable_shows').select2();
});

</script>
@endpush