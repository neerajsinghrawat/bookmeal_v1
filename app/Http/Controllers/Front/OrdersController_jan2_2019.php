<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Country;
use App\Models\Postcode;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Controllers\Controller;
use Session;
use Auth;

class OrdersController extends Controller
{

  /**
     * displaying order detail.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  varchar  $order_number
     * @return \Illuminate\Http\Response
     */
	public function order_detail(Request $request ,$order_number = null){
		
		if(!empty($order_number)){
			
			$orderDetail = Order::with('order_items')->where('user_id','=', Auth::user()->id)->where('order_number','=',$order_number)->orderBy('id','desc')->first();
			
			if(!empty($orderDetail)){
				 return view('front.orders.order_detail',['orderDetail'=>$orderDetail]);
			}else{
				return abort(404);
			}
		}else{
			return abort(404);
		}
		
		
	}



}
