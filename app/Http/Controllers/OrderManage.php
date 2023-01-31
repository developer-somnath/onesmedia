<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderHasItem;
use App\Models\OrderHasStatus;
use App\Models\OrderHasAddress;
use Illuminate\Http\Request;

class OrderManage extends Controller
{
    public function index(Request $request)
    {
        

        $title="Orders";
        return view('pages.order.list',compact('title'));
    }
    public function ajaxDataTable(Request $request)
    {
        if($request->ajax()):
            $draw           = $request->input('draw');
            $start          = $request->input("start");
            $rowperpage     = $request->input("length"); // Rows display per page
            $columnIndexArr = $request->input('order');
            $columnNameArr  = $request->input('columns');
            $orderArr       = $request->input('order');
            $searchArr      = $request->input('search');
            $columnIndex    = $columnIndexArr[0]['column']; // Column index
            $columnName     = $columnNameArr[$columnIndex]['data']; // Column name
            $columnSortOrder= $orderArr[0]['dir']; // asc or desc
            $searchValue    = $searchArr['value']; // Search value
            $totalRecords = Order::select('count(*) as allcount')->where('status','!=','3')->count();
            $totalRecordswithFilter = Order::select('count(*) as allcount')->where('status','!=','3')->count();
            // ->when($published, function ($q) use ($published) {
            //     return $q->where('published', 1);
            // })
            // Fetch records
            $records = Order::where('status','!=','3')
                        ->orderBy($columnName,$columnSortOrder)
                        ->skip($start)
                        ->take($rowperpage)
                        ->get();
            $tempArr = [];
            
            foreach ($records as $key => $value):
                if($value->payment_status==='P'):
                    $paymentStatus='<span class="badge badge-primary">Paid</span>';
                else:
                    $paymentStatus='<span class="badge badge-danger">Unpaid</a>';
                endif;
                if($value->shipment_status==='C'):
                    $shippingStatus='<span class="badge badge-primary">Complete</span>';
                else:
                    $shippingStatus='<span class="badge badge-danger">Pending</a>';
                endif;
                $action = '<a href="'.(url("category/show-edit/".$value->id."?categoryId=".$request->input('categoryId'))).'" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                <a href="javascript:void(0)" id="'.($value->id).'" data-table="orders" data-status="3" data-key="id" data-id="'.($value->id).'" class="btn btn-danger change-status"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                $image='';
                
                $tempArr[]=[
                    'id'=>($key+1),
                    'order_alt_id'=>$value->order_alt_id,
                    'name'=>$value->user->first_name.' '.$value->user->last_name,
                    'email'=>$value->user->email,
                    'phone'=>$value->user->phone,
                    'oder_amount'=>$value->oder_amount,
                    'payment_status'=>$paymentStatus,
                    'shipment_status'=>$shippingStatus,
                    'action'=>$action
                 ];
            endforeach;
            return response()->json([
                    'draw'=>$draw,
                    'recordsTotal'=>$totalRecords,
                    'recordsFiltered'=>$totalRecordswithFilter,
                    'data'=>$tempArr,
                 ]);
        endif;
    }
}
