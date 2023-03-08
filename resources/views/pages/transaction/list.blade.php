@push('css')
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush
@extends('layouts.master')
@section('content')
<div class="app-main__inner">
   <div class="row">
      <div class="col-md-12">
         <div class="row">
            <div class="col-md-6"></div>
            {{-- <div class="col-md-6 text-right"><a href="{{route('user-add')}}" class="btn btn-info">Add User</a></div> --}}
         </div>
      </div>
      <div class="col-md-12">
         <div class="main-card mb-3 card p-3">
            <div class="card-header">
               Transaction List                                   
            </div>
            <div class="table-responsive">
            <table class="table table-bordered" id="transactionTable" width="100%" >
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Order ID</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Phone</th>
                     <th>Payment Intent ID</th>
                     <th>Payment Intent Client Secret ID</th>
                     <th>Amount</th>
                     <th>Payment Status</th>
                     <th>Payment Method</th>
                     <th>Date & Time</th>
                  </tr>
               </thead>
               <tbody>
                  
               </tbody>
            </table>
            </div>
         </div>
      </div>
   </div>
</div>
@stop
@push('scripts')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script>
   $(document).ready(function(){
      loadData()
   })
   const loadData=()=>{
      $('#transactionTable').DataTable().destroy();
      var dataTable = $('#transactionTable').DataTable({
            dom: 'Bfrtip',
            processing: true,
            serverSide: true,
            searching:  false,
            ajax: {
              url: "{{route('ajax-transaction-list')}}",
              type:'POST',
              data: function(data){
               // if($('#searchEmail').val()!=""){
               //    searchEmail = $('#searchEmail').val();
               // }
               // if($('#searchName').val()!=""){
               //    searchName = $('#searchName').val();
               // }
               // if($('#searchFormDate').val()!=""){
               //    searchFormDate = $('#searchFormDate').val();
               // }
               // if($('#searchToDate').val()!=""){
               //    searchToDate = $('#searchToDate').val();
               // }
               data._token       = _token
               // data.searchEmail  = searchEmail,
               // data.searchName      = searchName,
               // data.searchFormDate  = searchFormDate,
               // data.searchToDate = searchToDate
              }
          },
            columns: [
                 { data: 'id' },
                 { data: 'order_alt_id' },
                 { data: 'name' },
                 { data: 'email'},
                 { data: 'phone'},
                 { data: 'payment_intend_id' },
                 { data: 'payment_intent_client_secret' },
                 { data: 'amount' },
                 { data: 'payment_status' },
                 { data: 'payment_method' },
                 { data: 'created_at' }
             ],
            columnDefs: [
            { orderable: false, targets: [2,3,4,5] }
         ]
          // buttons: [
          //    {
          //         extend: 'excelHtml5',
          //         text: 'Export Excel ',
          //         filename: function () { return 'Customer List ' + new Date(); },
          //         exportOptions: {
          //             columns: [0, 1, 2, 3, 4, 5],
          //             modifier: {
          //                 order: 'current',                       
          //                 page:  'all',
          //             }                    
          //         }
          //     },
          //     {
          //      text: 'Export Full Data In Excel',
          //      action: function ( e, dt, button, config ) {
          //        window.location = baseUrl+'customer-management/export-customer-list';
          //      }        
          //    }
          //  ]
        });


   }
</script>
@endpush