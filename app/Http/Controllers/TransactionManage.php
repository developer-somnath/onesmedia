<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionLog;

class TransactionManage extends Controller
{
    public function index(Request $request)
    {
        $title="Transactions";
        return view('pages.transaction.list',compact('title'));
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
            $totalRecords = Transaction::select('count(*) as allcount')->count();
            $totalRecordswithFilter = Transaction::select('count(*) as allcount')->count();
            // ->when($published, function ($q) use ($published) {
            //     return $q->where('published', 1);
            // })
            // Fetch records
            $records = Transaction::orderBy($columnName,$columnSortOrder)
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
                
                // $action = '<a href="'.(url("order/details/".$value->id)).'" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                // <a href="javascript:void(0)" id="'.($value->id).'" data-table="orders" data-status="3" data-key="id" data-id="'.($value->id).'" class="btn btn-danger change-status"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                // $image='';
                
                $tempArr[]=[
                    'id'=>($key+1),
                    'order_alt_id'=>$value->order->order_alt_id,
                    'name'=>$value->order->user->first_name.' '.$value->order->user->last_name,
                    'email'=>$value->order->user->email,
                    'phone'=>$value->order->user->phone,
                    'payment_intend_id'=>$value->payment_intend_id,
                    'payment_intent_client_secret'=>$value->payment_intent_client_secret,
                    'amount'=>$value->amount,
                    'payment_status'=>$paymentStatus,
                    'payment_method'=>strtoupper($value->payment_method),
                    'created_at'=>date('d-m-Y h:i a',strtotime($value->created_at)),
                    // 'action'=>$action
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
