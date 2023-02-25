@extends('layouts.master')
@section('content')
<div class="app-main__inner">
   <div class="row">
      <div class="col-md-12">
         <div class="row">
            <div class="col-md-6"></div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="main-card  p-3 card">
            <div class="card-header mb-3">
               Shipping Cost                                   
            </div>
            <form class="adminFrm" data-action="shipping-cost/save" method="post">
               @csrf
               <input type="hidden" name="updateId" value="{{!is_null($oldData)?$oldData->id:''}}">
               <div class="form-row">
                  <div class="col-md-3">
                     <div class="position-relative form-group">
                        <label style="">Cost For 1 Quantity</label>
                        <input name="price_for_single_qty" id="image" type="text" class="form-control requiredCheck checkDecimal" data-check="Cost For 1 Quantity" value="{{!is_null($oldData)?$oldData->price_for_single_qty:''}}">
                     </div>
                  </div>    
               
                    <div class="col-md-3">
                    <div class="position-relative form-group">
                        <label style="">Cost For 2 Quantity</label>
                        <input name="price_for_double_qty" id="image" type="text" class="form-control requiredCheck checkDecimal" data-check="Cost For 2 Quantity" value="{{!is_null($oldData)?$oldData->price_for_double_qty:''}}">
                    </div>
                    </div>    
                
                    <div class="col-md-3">
                    <div class="position-relative form-group">
                        <label style="">Cost For 3 or >3 Quantity</label>
                        <input name="price_for_more_than_three_or_equal" id="image" type="text" class="form-control requiredCheck checkDecimal" data-check="Cost For 3 or >3 Quantity" value="{{!is_null($oldData)?$oldData->price_for_more_than_three_or_equal:''}}">
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
