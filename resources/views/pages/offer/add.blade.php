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
                  <div class="col-md-3">
                     <div class="position-relative form-group">
                        <label style="">Discount Type</label>
                        <select class="form-control requiredCheck" id="type" name="type" data-check="Discount Type">
                           <option value="1" {{!is_null($oldData) && ($oldData->type==1)?'selected':''}}>Percentage</option>
                           <option value="2" {{!is_null($oldData) && ($oldData->type==2)?'selected':''}}>Fixed</option>
                        </select>                        
                     </div>
                  </div> 
                  <div class="col-md-3">
                     <div class="position-relative form-group">
                        <label style="">Discount Amount</label>
                        <input name="discount_amount" id="discount_amount" type="text" class="form-control requiredCheck checkDecimal" data-check="Discount Amount" value="{{!is_null($oldData)?$oldData->discount_amount:''}}">
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
                        <label style="">Apply On Shows</label>
                        @php
                           $existingShows= [];
                           if(!is_null($oldData) && !empty($oldData->applicable_shows)):
                              $existingShows = explode(',',$oldData->applicable_shows);
                           endif;
                        @endphp
                        <select name="applicable_shows[]" id="applicable_shows" class="form-control" data-check="Apply On Shows" multiple>
                           <option value="">-Select Year-</option>
                           @forelse ($showList as $show)
                              <option value="{{ $show->id }}" {{ in_array($show->id,$existingShows)?'selected':'' }}>{{ $show->title }}</option>
                           @empty
                              <option value="">No show found!</option>
                           @endforelse
                        </select>
                     </div>
                  </div>  
                  <div class="col-md-3">
                     <div class="position-relative form-group">
                        <label style="">Start Date</label>
                        <input name="start_date" id="start_date" type="Date" class="form-control " data-check="Start Date" value="{{!is_null($oldData)?$oldData->start_date:''}}">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="position-relative form-group">
                        <label style="">End date</label>
                        <input name="end_date" id="end_date" type="date" class="form-control" data-check="End date" value="{{!is_null($oldData)?$oldData->end_date:''}}">
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