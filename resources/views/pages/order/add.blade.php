
@extends('layouts.master')
@section('content')
<div class="app-main__inner">
   <div class="row">
      <div class="col-md-12">
         <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 text-right"><a href="{{route('user-list')}}" class="btn btn-info">User List</a></div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="main-card  p-3 card">
            <div class="card-header mb-3">
               User List                                   
            </div>
            <form class="adminFrm" data-action="user/list" method="post">
               @csrf
               <input type="hidden" name="updateId" value="{{!is_null($oldData)?$oldData->id:''}}">
               <div class="form-row">
                  <div class="col-md-6">
                     <div class="position-relative form-group">
                        <label style="">First Name</label>
                        <input name="first_name" id="first_name" placeholder="Enter First Name" type="text" class="form-control requiredCheck allowOnlyLetter" data-check="First Name" value="{{!is_null($oldData)?$oldData->first_name:''}}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="position-relative form-group">
                        <label style="">Last Name</label>
                        <input name="last_name" id="last_name" placeholder="Enter Last Name" type="text" class="form-control requiredCheck allowOnlyLetter" data-check="Last Name" value="{{!is_null($oldData)?$oldData->last_name:''}}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="position-relative form-group">
                        <label style="">Email</label>
                        <input name="email" id="email" placeholder="Enter Email" type="text" class="form-control requiredCheck" data-check="Email" value="{{!is_null($oldData)?$oldData->email:''}}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="position-relative form-group">
                        <label style="">Phone</label>
                        <input name="phone" id="phone" placeholder="Enter Phone" type="text" class="form-control requiredCheck" data-check="Phone" value="{{!is_null($oldData)?$oldData->phone:''}}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="position-relative form-group">
                        <label style="">Street Address</label>
                        <input name="street_address" id="street_address" placeholder="Enter Street Address" type="text" class="form-control requiredCheck" data-check="Street Address" value="{{!is_null($oldData)?$oldData->street_address:''}}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="position-relative form-group">
                        <label style="">Adrress Line 2</label>
                        <input name="address_line2" id="address_line2" placeholder="Enter Address Line 2" type="text" class="form-control " data-check="Address Line 2" value="{{!is_null($oldData)?$oldData->address_line2:''}}">
                     </div>
                  </div>
                  
                  <div class="col-md-3">
                     <div class="position-relative form-group">
                        <label style="">Country</label>
                        <select class="form-control requiredCheck" id="country_id" name="country_id" data-check="Country">
                           <option value="">-Select Country-</option>
                           @if(count($countryList)>0):
                              @foreach($countryList as $value)
                                 <option value="{{$value->id}}" {{(!is_null($oldData) && ($oldData->country_id == $value->id))?'selected':''}}>{{$value->name}}</option>
                              @endforeach;
                           @endif
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="position-relative form-group">
                        <label style="">State</label>
                        <select class="form-control requiredCheck" id="state_id" name="state_id" data-check="State">
                           <option value="">-Select State-</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="position-relative form-group">
                        <label style="">City</label>
                        <input name="city" id="city" placeholder="Enter City" type="text" class="form-control requiredCheck" data-check="City" value="{{!is_null($oldData)?$oldData->city:''}}">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="position-relative form-group">
                        <label style="">Post/Zip Code</label>
                        <input name="zip_code" id="zip_code" placeholder="Enter Zip Code" type="text" class="form-control requiredCheck" data-check="Zip Code" value="{{!is_null($oldData)?$oldData->zip_code:''}}">
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
<script type="text/javascript">
      var stateId = "{{!is_null($oldData)?$oldData->state_id:''}}"

   $(document).ready(function(){
      $('#country_id').val("{{!is_null($oldData)?$oldData->country_id:''}}").change()
   })
   $(document).on('change','#country_id',function(){
      if($(this).val()!=""){
         $.ajax({
         type:"post",
         url:"{{route('state-list-by-country-id')}}",
         data:{_token:_token,countryId:$(this).val()},
         dataType:"JSON",
         beforeSend:function(){
            $('#state_id').html('<option value="">Processing...</option>')
         },
         success:function(response){
            let html=''
            if(response.status){
               response.data.forEach(val=>{
                  if(stateId==val.id){
                     var selected = "selected"
                  }else{
                     var selected = ""

                  }
                  html+='<option value="'+val.id+'"'+selected+'>'+val.name+'</option>'
               })
               $('#state_id').html(html)
            }
         }
      })
      }
   })
</script>
@endpush