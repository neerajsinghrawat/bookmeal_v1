<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Client;
use App\Models\Page;
use App\Models\OrderComplaint;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Setting;

use App\Models\Product;
use App\Models\Country;
use App\Models\Postcode;
use App\Models\User;
use App\Models\ProductReview;
use App\Models\ProductTag;
use App\Models\UserAddress;
use App\Models\ShippingTax;
use App\Models\Couponcode;

use View;
use Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        

        View::composer('partials.header', function($view)
            {
                $category_list = Category::with('children')->where('parent_id','=',0)->where('status','=', 1)->get();
                
                $cart_count = Cart::where('user_id','=', ((Auth::check())?Auth::user()->id:'1'))->get();
                $view->with('category_list', $category_list);
            });
/*        View::composer('partials.header', function($view)
            {
                
        $subcategory_list = Category::where('parent_id','!=',0)->where('status','=', 1)->get();
                $view->with('subcategory_list', $subcategory_list);
            });*/        

        View::composer('partials.header', function($view)
            {
                
                $cart_count = Cart::where('user_id','=', ((Auth::check())?Auth::user()->id:'1'))->count();
                $view->with('cart_count', $cart_count);
            });

        View::composer('partials.footer', function($view)
            {
                
                $pages_detail = Page::where('status','=', 1)->where('footer_page','=', 1)->orderBy('sort_number')->get();
                $view->with('pages_detail', $pages_detail);
            });

        View::composer('partials.footer', function($view)
            {
                
                $client_list = Client::where('status','=', 1)->where('featured','=', 1)->limit(6)->get();
                $view->with('client_list', $client_list);
            });

        View::composer('partials.header', function($view)
            {
                
                $pages_detail = Page::where('status','=', 1)->where('header_page','=', 1)->orderBy('sort_number')->get();
                $view->with('pages_detail', $pages_detail);
            });

        View::composer('*', function($view)
            {


          $current_date = date('Y-m-d');
          $conditions = array(1 => 1,0 => 0);

          $cart_list = Cart::with('product')->where('user_id','=', ((Auth::check())?Auth::user()->id:'1'))->get();
             //echo '<pre>couponn'; print_r($cart_list); die;
          
          $couponcode_lists = Couponcode::with('couponItem')->where('status','=', 1)->where('start_date','<=', $current_date)->where('expire_date','>=', $current_date)->whereIn('group_id',$conditions)->get();
          //echo '<pre>couponcode_lists'; print_r($couponcode_lists); die;
          
          $couponn = array();
          foreach ($cart_list as $key1 => $cart_value) {
              foreach ($couponcode_lists as $key3 => $couponcodeList) {
                //echo '<pre>couponcodeList'; print_r($couponcodeList); die;

                $appliedCoupon = order::where('coupon_code','=', $couponcodeList->code)->count();

                $appliedUserCoupon = order::where('coupon_code','=', $couponcodeList->code)->where('user_id','=', ((Auth::check())?Auth::user()->id:'1'))->count();

                if (($couponcodeList->coupon_count > $appliedCoupon) && ($couponcodeList->use_code_times > $appliedUserCoupon)) {
                  if($couponcodeList->apply_for == "cart"){
                     $couponn[$couponcodeList->id] = $couponcodeList->id; 

                  }else{
                    foreach ($couponcodeList->couponItem as $key4 => $value) {
                     if ($value->apply_for == 'product' && $value->product_id == $cart_value->product_id) {
                      $couponn[$value->couponcode_id] = $value->couponcode_id; 
                     }elseif ($value->apply_for == 'category' && $value->category_id == $cart_value['product']['sub_category_id']){
                      //
                      $couponn[$value->couponcode_id] = $value->couponcode_id; 

                     }
                    }
                  }

                }else{

                }
                
              }      
          }
   
          $couponcode_list = Couponcode::whereIn('id',$couponn)->get();

      //die('asfsdfd');
          $shipping_taxes = ShippingTax::first();

          $addressesArr = array();
          $addresses = UserAddress::where('user_id','=',((Auth::check())?Auth::user()->id:'1'))->get();
          if(!empty($addresses)){
            $i = 0;
            foreach ($addresses as $key => $address) {
              if($address->type == "other"){
                $addressesArr[$address->type][$i] = $address;
                $i++;
              }else{
                $addressesArr[$address->type] = $address;
              }          
            }   
          }

          
                $view->with('cart_list', $cart_list);
                $view->with('addressesArr', $addressesArr);
                $view->with('shipping_taxes', $shipping_taxes);
                $view->with('couponcode_list', $couponcode_list);

            });
            
            
        
		


        $activeComplaints = OrderComplaint::select('order_number')->where('status','=',0)->where('user_type','=','customer')->distinct('order_number')->orderBy('created_at','desc')->get();
        //echo '<pre>data_crawled_count'; print_r($activeComplaints); die;
        $activeComplaintDataArr = array();
        if(!empty($activeComplaints)){
            $i = 0;
            foreach($activeComplaints as $active_complaint){
                
                $lastComplaint = OrderComplaint::where('status','=',0)->where('order_number','=',$active_complaint['order_number'])->orderBy('created_at','desc')->first();
                
                if($lastComplaint->user_type == "customer"){
                    $activeComplaintDataArr[$lastComplaint->order_number]['user_id'] = $lastComplaint->user_id;
                    $activeComplaintDataArr[$lastComplaint->order_number]['order_number'] = $lastComplaint->order_number;
                    //$activeComplaintDataArr[$i][$active_complaint->order_number][$i]['subject'] = $active_complaint->subject;
                    $activeComplaintDataArr[$lastComplaint->order_number]['problem'] = $lastComplaint->problem;
                    $activeComplaintDataArr[$lastComplaint->order_number]['user_type'] = $lastComplaint->user_type;
                    $activeComplaintDataArr[$lastComplaint->order_number]['created_at'] = date('d M,Y  H:i A', strtotime($lastComplaint->created_at));
                }
                //echo '<pre>lastComplaint'; print_R($lastComplaint); die;
                
            $i++;
            }
            
            //echo '<pre>activeComplaintArr'; print_R($activeComplaintArr); die;
        }
        View::share('activeComplaints', $activeComplaints);
        View::share('activeComplaintDataArr', $activeComplaintDataArr);		
        $setting = Setting::with('openingTime')->first();
        $people_count = range(1, $setting->total_men);
        View::share('people_count', $people_count);        

        $timearray = getTimeArr();
        View::share('timearray', $timearray);













/***************************pre order admin header**********************************************/
        $orders_pre = Order::select('order_number','id','created_at')->with(['order_items' => function($test) {
                        $test->where('is_pre_order', '=', 1);
                    }])->where('order_status','=','Order Confirmed')->orderBy('created_at','desc')->get();

//		echo '<pre>data_crawled_count'; print_r($orders_pre);die;
		$preorderDataArr = array();
		if(!empty($orders_pre)){			
			foreach($orders_pre as $orders_pres){

              foreach ($orders_pres->order_items as $key => $preorder_item) {
                if (($preorder_item->is_pre_order == 1) && ($preorder_item->order_id == $orders_pres->id)){
                     $preorderDataArr[$orders_pres->id]['order_number'] = $orders_pres->order_number;
                     $preorderDataArr[$orders_pres->id]['date'] = date('d M,Y  H:i A', strtotime($orders_pres->created_at));
                }               
              }              
			}
		}
       // echo '<pre>';print_r($preorderDataArr);die;
		View::share('preorderDataArr', $preorderDataArr);
/*************************************************************************************8*/
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
