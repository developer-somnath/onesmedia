@extends('layouts.master')
@section('content')
<div class="app-main__inner">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6 text-right"><a href="{{route('order-list')}}" class="btn btn-info">Order List</a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="main-card  p-3 card">
                <div class="card-header mb-3">
                    Order Details
                </div>
                <div class="order-details">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Order #{{ @$details->order_alt_id }}</h5>
                                </div>
                            
                                <div class="card-body">
                                    <table class="details-t">
                                        <tr>
                                            <th>Show Image</th>
                                            <th>Show Name</th>
                                            <th>Unit Price</th>
                                            <th>Purchase Type</th>
                                            <th>Qunatity</th>
                                            <th>Total</th>
                                        </tr>
                                        @forelse ($details->items as $value)
                                        
                                        <tr>
                                            <td width="40">
                                                <img src="{{ asset('/uploads/categories/'.$value->show->category->slug.'/'.$value->show->image) }}"
                                                    width="30">
                                            </td>
                                            <td>
                                                <h4>{{ $value->show->title }}</h4>
                                            </td>
                                            <td>
                                                {{ $value->item_amount }}
                                            </td>
                                            <td>
                                                {!! $value->type==1?'<span class="badge badge-primary">Instant Download</span>':'<span class="badge badge-secondary">CD</span>' !!}
                                            </td>
                                            <td>
                                                {{ $value->quantity }}
                                            </td>
                                            <td>
                                                $ {{ $value->quantity*$value->item_amount }}
                                            </td>
                                        </tr>
                                        @empty
                                            
                                        @endforelse
                                        
                                        
                                    </table>
                                </div>
                            </div>
                            <div class="card mb-4 mt-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h3 class="h6">Payment Method</h3>
                                            <p>Visa -1234 <br> Total: $169,98 <span
                                                    class="badge bg-success rounded-pill">PAID</span></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <h3 class="h6">Billing address</h3>
                                            <address> <strong>{{ $details->user->first_name.' '.$details->user->last_name }}</strong><br> {{ $details->user->street_address }}<br>{{ $details->user->address_line_2 }}<br>{{ $details->user->city }}, {{ $details->user->state->name }}, {{ $details->user->country->name }}, {{ $details->user->zip_code }} <br><abbr title="Phone">Phone:</abbr> {{ $details->user->phone }}
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3 class="h6">Shipping Information</h3>

                                    <hr>
                                    <h3 class="h6">Address</h3>
                                    <address> <strong>{{ $details->address->first_name.' '.$details->address->last_name }}</strong><br> {{ $details->address->street_address }}<br>{{ $details->address->address_line_2 }}<br>{{ $details->address->city }}, {{ $details->address->state->name }}, {{ $details->address->country->name }}, {{ $details->address->zip_code }} <br><abbr title="Phone">Phone:</abbr> {{ $details->user->phone }}
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@stop
@push('scripts')

@endpush