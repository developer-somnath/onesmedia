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
            <div class="col-md-6 text-right">
                  <a href="{{route('category-sale-add')}}" class="btn btn-info">Add Sale</a>
            </div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="main-card mb-3 card p-3">
            <div class="card-header">
             Category  Sale List                                   
            </div>
            <div class="table-responsive">
            <table class="table table-bordered" id="saleTable" width="100%" >
               <thead>
                  <tr>
                     <th>SL. No.</th>
                     <th>Title</th>
                     <th>Start Date</th>
                     <th>End Date</th>
                     <th>Minimum Price Range</th>
                     <th>Maximum Price Range</th>
                     <th>Discount</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                @forelse ($saleList as $key=> $sale)
                @php
                    if($sale->status=='1'):
                        $status='<a href="javascript:void(0)" id="'.($sale->id).'" data-table="sales" data-status="0" data-key="id" data-id="'.($sale->id).'" class="badge badge-primary change-status">Active</a>';
                    else:
                        $status='<a href="javascript:void(0)" id="'.($sale->id).'" data-table="sales" data-status="1" data-key="id" data-id="'.($sale->id).'" class="badge badge-danger change-status">InActive</a>';
                    endif;
                @endphp
                    <tr>
                        <td>{{ ($key+1) }}</td>
                        <td>{{ $sale->title }}</td>
                        <td>{{ date('d-m-Y',strtotime($sale->start_date)) }}</td>
                        <td>{{ date('d-m-Y',strtotime($sale->end_date)) }}</td>
                        <td>{{ $sale->min_price_range }}</td>
                        <td>{{ $sale->max_price_range }}</td>
                        <td>{{ $sale->discount_amount }} {{ ($sale->discount_type ==='P')?'Parcentage(%)':'Fixed' }}</td>
                        <td>{!! $status !!}</td>
                        <td>{!! '<a href="'.(url("category-sale/edit/".$sale->id)).'" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a href="javascript:void(0)" id="'.($sale->id).'" data-table="sales" data-status="3" data-key="id" data-id="'.($sale->id).'" class="btn btn-danger change-status"><i class="fa fa-trash" aria-hidden="true"></i></a>'; !!}</td>
                    </tr>
                @empty
                @endforelse
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
    //   $('#bannerTable').DataTable().destroy();
      var dataTable = $('#saleTable').DataTable({
            dom: 'Bfrtip',
            processing: true,
            serverSide: false,
            searching:  false,
          
        });


   }
</script>
@endpush