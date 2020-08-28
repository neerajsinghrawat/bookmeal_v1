<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Session;
class OrdersController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth:admin');
     
    }

    /**
     * Show all recoreds in table a new resource.
     *
     * @return \Illuminate\Http\Response
    */  
    public function index()
    {
		$orders = Order::with('order_items','user')->orderBy('id','desc')->paginate(10);
    	
		return view('admin.orders.index',["orders" => $orders]);
    }

	/**
     * displaying order detail.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  varchar  $order_number
     * @return \Illuminate\Http\Response
     */
	public function order_detail(Request $request ,$order_number = null){
		
		if(!empty($order_number)){
			
			$orderDetail = Order::with('order_items')->where('order_number','=',$order_number)->orderBy('id','desc')->first();
			//echo '<pre>orderDetail'; print_R($orderDetail); die;
			return view('admin.orders.order_detail',['orderDetail'=>$orderDetail]);
		}
		
	}



    
}
