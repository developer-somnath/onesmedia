@push('css')
  <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
      <link href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush
@extends('layouts.master')
@section('content')
   <div class="app-main__inner">
      <div class="app-page-title">
         <div class="page-title-wrapper">
            <div class="page-title-heading">
               <div class="page-title-icon">
                  <i class="pe-7s-airplay icon-gradient bg-mean-fruit">
                  </i>
               </div>
               <div>
                  Ones Media Dashboard
                  <div class="page-title-subheading">View analytical Dashboard
                  </div>
               </div>
            </div>
            <div class="page-title-actions">
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-4">
            <div class="card mb-3 widget-content bg-midnight-bloom">
               <div class="widget-content-wrapper">
                  <div class="widget-content-left">
                     <div class="widget-heading">Total Users</div>
                     <div class="widget-subheading">Lifetime data</div>
                  </div>
                  <div class="widget-content-right">
                     <div class="widget-numbers"><span>1031</span></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="card mb-3 widget-content bg-arielle-smile">
               <div class="widget-content-wrapper">
                  <div class="widget-content-left">
                     <div class="widget-heading">Total Orders</div>
                     <div class="widget-subheading">This Year</div>
                  </div>
                  <div class="widget-content-right">
                     <div class="widget-numbers"><span>$5,00</span></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="card mb-3 widget-content bg-midnight-bloom">
               <div class="widget-content-wrapper">
                  <div class="widget-content-left">
                     <div class="widget-heading">Total Revenue</div>
                     <div class="widget-subheading">Lifetime data</div>
                  </div>
                  <div class="widget-content-right">
                     <div class="widget-numbers"><span>$1000</span></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12 col-lg-12">
            <div class="mb-3 card">
               <div class="card-header-tab card-header-tab-animation card-header">
                  <div class="card-header-title">
                     <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                     Purchased History
                  </div>
                  <ul class="nav">
                     <li class="nav-item"><a href="javascript:void(0);" class="active nav-link">Current Year</a></li>
                     <!--<li class="nav-item"><a href="javascript:void(0);" class="nav-link second-tab-toggle">Last Year</a></li>-->
                  </ul>
               </div>
               <div class="card-body">
                  <div class="tab-content">
                     <div class="tab-pane fade show active" id="tabs-eg-77">
                        <div class="card mb-3 widget-chart widget-chart2 text-left w-100">
                           <div class="widget-chat-wrapper-outer">
                              <div class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0">
                                 <canvas id="booking-chart"></canvas>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="main-card mb-3 card">
               <div class="card-header">New Orders                                        
               </div>
               <table class="display responsive nowrap datatable" style="width:100%">
                  <thead>
                     <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Orders ID</th>
                        <th>Date</th>
                        <th class="text-center">User</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Status</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <th class="text-center" scope="row">1</th>
                        <td class="text-center text-muted">#394651</td>
                        <td>
                           Aug 12, 2022                                                           
                        </td>
                        <td class="text-center">John Smiller</td>
                        <td class="text-center">
                           $5.00
                        </td>
                        <td class="text-center">
                           <div class="badge badge-success">Completed</div>
                        </td>
                     </tr>
                     <tr>
                        <th class="text-center" scope="row">2</th>
                        <td class="text-center text-muted">#394651</td>
                        <td>
                           Aug 12, 2022                                                           
                        </td>
                        <td class="text-center">John Smiller</td>
                        <td class="text-center">
                           $8.00
                        </td>
                        <td class="text-center">
                           <div class="badge badge-warning">Pending</div>
                        </td>
                     </tr>
                     <tr>
                        <th class="text-center" scope="row">3</th>
                        <td class="text-center text-muted">#394651</td>
                        <td>
                           Aug 12, 2022                                                           
                        </td>
                        <td class="text-center">John Smiller</td>
                        <td class="text-center">
                           $10.00
                        </td>
                        <td class="text-center">
                           <div class="badge badge-danger">In Progress</div>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      
   </div>
@stop
@push('scripts')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="{{asset('assets/scripts/charts.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
   
</script>
@endpush