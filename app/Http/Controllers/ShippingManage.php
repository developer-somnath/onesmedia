<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShippingCost;
class ShippingManage extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()):
            $validated = $request->validate([
              "price_for_single_qty" => "required",
              "price_for_double_qty" => "required",
              "price_for_more_than_three_or_equal" => "required",
            ]);
            if($validated):
                ShippingCost::find($request->input('updateId'))->update([
                    'price_for_single_qty'=>$request->input('price_for_single_qty'),
                    'price_for_double_qty'=>$request->input('price_for_double_qty'),
                    'price_for_more_than_three_or_equal'=>$request->input('price_for_more_than_three_or_equal')
                ]);
                return response()->json([
                    'status'=>TRUE,
                    'message'=>'Shipping Cost Updated Successfully!',
                    'redirect'=>'shipping-cost/add',
                ]);
            else:
                return response()->json([
                    'status'=>FALSE,
                    'message'=>'All data are not present in the request!',
                    'redirect'=>'',
                ]);
            endif;
        endif;
    }
    public function add()
    {
        $title="Show Edit";
        $oldData = ShippingCost::find('1');
        return view('pages.shippingcost.add',compact('oldData','title'));
    }

}
