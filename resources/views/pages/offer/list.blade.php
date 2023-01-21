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
                  <a href="{{route('offer-add')}}" class="btn btn-info">Add Offer</a>
            </div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="main-card mb-3 card p-3">
            <div class="card-header">
               Offer List                                   
            </div>
            <div class="table-responsive">
            <table class="table table-bordered" id="offerTable" width="100%" >
               <thead>
                  <tr>
                     <th>SL. No.</th>
                     <th>Image</th>
                     <th>Description</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                @forelse ($offerList as $key=> $offer)
                @php
                    if($offer->status=='1'):
                        $status='<a href="javascript:void(0)" id="'.($offer->id).'" data-table="offer_management" data-status="0" data-key="id" data-id="'.($offer->id).'" class="badge badge-primary change-status">Active</a>';
                    else:
                        $status='<a href="javascript:void(0)" id="'.($offer->id).'" data-table="offer_management" data-status="1" data-key="id" data-id="'.($offer->id).'" class="badge badge-danger change-status">InActive</a>';
                    endif;
                @endphp
                    <tr>
                        <td>{{ ($key+1) }}</td>
                        <td>{!! '<img src="'.asset('uploads/offer/'.$offer->image).'" width="250" height="100">' !!}</td>
                        <td>{!! $offer->description !!}</td>

                        <td>{!! $status !!}</td>
                        <td>{!! '<a href="'.(url("offer/edit/".$offer->id)).'" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a href="javascript:void(0)" id="'.($offer->id).'" data-table="offer_management" data-status="3" data-key="id" data-id="'.($offer->id).'" class="btn btn-danger change-status"><i class="fa fa-trash" aria-hidden="true"></i></a>'; !!}</td>
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
      var dataTable = $('#offerTable').DataTable({
            dom: 'Bfrtip',
            processing: true,
            serverSide: false,
            searching:  false,
          
        });


   }
</script>
@endpush