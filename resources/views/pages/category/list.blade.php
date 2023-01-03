
@extends('layouts.master')
@section('content')
<div class="app-main__inner">
   <div class="row">
      <div class="col-md-12">
         <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 text-right">
               @if($parentId==0)
                  <a href="{{route('category-add',['type'=>'C','parentId'=>$parentId])}}" class="btn btn-info">Add Category</a>
               @elseif($parentId>0)
                  <a href="{{route('category-add',['type'=>'C','parentId'=>$parentId])}}" class="btn btn-info">Add Category</a>
                  <a href="{{route('category-add',['type'=>'F','parentId'=>$parentId])}}" class="btn btn-info">Add Product</a>
               @endif
            </div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="main-card mb-3 card p-3">
            <div class="card-header">
               User List                                   
            </div>
            <div class="table-responsive">
            <table class="table table-bordered" id="categoryTable" width="100%" >
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Category/Product</th>
                     <th>Image</th>
                     <th>File</th>
                     <th>Price</th>
                     <th>Quantity</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>

                  @forelse($categoryProductList as $key => $value)
                  @php
                     if($value->status=='1'):
                         $status='<a href="javascript:void(0)" id="'.($value->id).'" data-table="category_and_products" data-status="0" data-key="id" data-id="'.($value->id).'" class="badge badge-primary change-status">Active</a>';
                     else:
                         $status='<a href="javascript:void(0)" id="'.($value->id).'" data-table="category_and_products" data-status="1" data-key="id" data-id="'.($value->id).'" class="badge badge-danger change-status">InActive</a>';
                     endif;
                     $action = '<a href="'.(url("category-products/edit/".$value->type."/".$value->parent."/".$value->id)).'" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                         <a href="javascript:void(0)" id="'.($value->id).'" data-table="category_and_products" data-status="3" data-key="id" data-id="'.($value->id).'" class="btn btn-danger change-status"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                  @endphp
                  <tr>
                     <td>{{ $key+1 }}</td>
                     <td>
                        @if($value->type==='C')
                        <a href="{{ route('category-list') }}?parentId={{$value->id}}"><img src="{{ asset('assets/images/folder.png') }}"> {{ $value->name }}</a>
                        @else
                        {{ $value->name }}
                        @endif
                     </td>
                     <td>
                        @if($value->image)
                        <img src="{{ asset('uploads/categories/'.$value->slug.'/'.$value->image) }}" width="180" height="150">
                        @else
                        -
                        @endif
                     </td>
                     <td>
                        @if($value->type==='F')
                           <audio controls >
                             <source src="{{ asset('uploads/categories/'.$value->slug.'/'.$value->file) }}" type="audio/ogg">
                             <source src="{{ asset('uploads/categories/'.$value->slug.'/'.$value->file) }}" type="audio/mpeg">
                           Your browser does not support the audio element.
                           </audio>
                        @else
                        -
                        @endif
                     </td>
                     <td>
                        @if($value->type==='F')
                           {{$value->price}}
                        @else
                        -
                        @endif
                     </td>
                     <td>
                        @if($value->type==='F')
                           {{$value->quantity}}
                        @else
                        -
                        @endif
                     </td>
                     <td>
                       {!!$status!!} 
                     </td>
                     <td>
                        {!!$action!!}
                     </td>
                  </tr>
                  @empty
                  <tr>
                     <td colspan="8" align="center">No Data Found!</td>
                  </tr>
                  @endforelse

               </tbody>
            </table>
            </div>
         </div>
      </div>
   </div>
</div>
@stop
