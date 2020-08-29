<?php

namespace App\Http\Controllers\Front;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\NewsLetter;
use App\Models\Product;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Client;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\WebsiteVisitor;
use App\Models\TableReservation;
use App\Models\OpeningTime;


use Session;
use DB;

class PagesController extends Controller
{

  
    public function getHome()
    {
       //echo '<pre>';print_r($_SERVER['REMOTE_ADDR']);die('dmnhk');

        $getip = WebsiteVisitor::where('ip_address','=',$_SERVER['REMOTE_ADDR'])->count();

        if ($getip < 1) {
        $websiteVisitor = new WebsiteVisitor;

        $websiteVisitor->ip_address = $_SERVER['REMOTE_ADDR'];

        $websiteVisitor->save();
        }

        $category_list = Category::where('parent_id','=',0)->where('status','=', 1)->with('children')->get();

        $ourmenu_category_list = Category::where('parent_id','!=',0)->where('status','=', 1)->get();
        //$ourmenu_category_list = array();
        
        /*if(!empty($ourmenu_category_listData)){
            foreach($ourmenu_category_listData as $cat){
                $cat_name = strtolower(trim($cat->name));
                $cat_name = str_replace(' ', '-', $cat_name);
                $ourmenu_category_list[$cat_name] = $cat;
            }
        }*/
        
    	$ourmenu_category_productData = Category::where('parent_id','!=',0)->where('status','=', 1)->with(['product' => function($test) {
                        $test->where('status', '=', 1);
                    }])->get();
    	 if(!empty($ourmenu_category_productData)){
    	     $i = 1;
            foreach($ourmenu_category_productData as $cat){
                $cat_name = strtolower(trim($cat->name));
                $cat_name = str_replace(' ', '-', $cat_name);
                    $ourmenu_category_product[$cat_name]['cat_detail']['start_time'] = $cat->start_time; 
                    $ourmenu_category_product[$cat_name]['cat_detail']['end_time'] = $cat->end_time; 
                if(isset($cat->product) && count($cat->product) > 0){
                    foreach($cat->product as $product){
                       $ourmenu_category_product[$cat_name]['product'][] = $product; 
                    }
                    
                }
               
            $i++; }
        }

    	$sliders = Slider::where('status','=', 1)->get();
    	$testimonials = Testimonial::where('status','=', 1)->where('show_inhome_page','=', 1)->get();

    	$products = Product::where('status','=', 1)->where('is_popular','=', 1)->orderBy(DB::raw('RAND()'))->limit(10)->get();
    	//$setting = Setting::where('status','=', 1)->first();
 
        return view('front.pages.home',["category_list" => $category_list,"sliders" => $sliders,"testimonials" => $testimonials,"products" => $products,"ourmenu_category_list" => $ourmenu_category_list,"ourmenu_category_list" => $ourmenu_category_list,"ourmenu_category_product" => $ourmenu_category_product]);
 
    }

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
    public function create_newsletter(Request $request)
    {
        //echo '<pre>';print_r($request->email);die;
        $newsLetter = new NewsLetter;

        $newsLetter->email = $request->email;

        if($newsLetter->save()){
            Session::flash('success_h1','NewsLetter');
            Session::flash('success','Thankyou for connect with us.');
        }else{
			Session::flash('error_h1','NewsLetter');
            Session::flash('error','Please try again.');
        }       
        return \Redirect::to('/');
    }


/**
 * Display the about_us by page.
 *
 * @return \Illuminate\Http\Response
 */
    public function about_us()
    {

        $pageabout_us = Page::where('status','=', 1)->where('slug','=', 'about-us')->first();
        $product_count = Product::where('status','=', 1)->count();
        $order_count = Order::where('payment_status','=', 'approved')->count();
        $productreview_count = ProductReview::count();
        $websitevisitor_count = WebsiteVisitor::count();
        $testimonials = Testimonial::where('status','=', 1)->get();
        
        return view('front.pages.about_us',["pageabout_us" => $pageabout_us,"product_count" => $product_count,"testimonials" => $testimonials,"order_count" => $order_count,"productreview_count" => $productreview_count,"websitevisitor_count" => $websitevisitor_count]);
    }

/**
 * Display the contact_us by page.
 * save contact_us records 
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
    public function contact_us()
    {

        $setting = Setting::first();
        return view('front.pages.contact_us',["setting" => $setting]);
    }

/**
 * Display the contact_us by page.
 * save contact_us records 
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
    public function contactus_save(Request $request)
    {
        $contact = new Contact;

        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->message = $request->message;

        if($contact->save()){
            Session::flash('success_h1','Contact us');           
            Session::flash('success','Contact Save successfully');
            }else{
            Session::flash('error_h1','Contact us');
                Session::flash('error','Please try again.');
            }
        return \Redirect::to('/contact-us');
    }

/**
 * Display the page detail.
 * 
 * @return \Illuminate\Http\Response
 */
    public function page_detail($slug)
    {
       if(!empty($slug)) {
            
            $pageabout_us = Page::where('status','=', 1)->where('slug','=', $slug)->first();
            if(!empty($pageabout_us)) {

            }else{
                 return abort(404);
            }

       }else{
         return abort(404);
       }

       return view('front.pages.page_detail',["pageabout_us" => $pageabout_us]);
    }

/**
 * Display the client by page.
 *
 * @return \Illuminate\Http\Response
 */
    public function client_list()
    {

        $client_list = Client::where('status','=', 1)->get();
        
        return view('front.pages.client_list',["client_list" => $client_list]);
    }
/**
 * Display the client by page.
 *
 * @return \Illuminate\Http\Response
 */
    public function table_reservation()
    {

        $setting = Setting::with('openingTime')->first();
        $people_count = range(1, $setting->total_men);
        //echo '<pre>';print_r($people_count);die;
        return view('front.pages.table_reservation',["setting" => $setting,"people_count" => $people_count]);
    }

/**
 * Remove the specified resource from storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
    public function save_table_reservation(Request $request)
    {
       $result = 0;
       $msg = '';
       $setting = Setting::first();
//die('kmjkjjghj');
       
       if (!empty($request->reservation_date) && !empty($request->people_count) && !empty($request->reservation_time) && !empty($request->name) &&  !empty($request->email) &&  !empty($request->phone)) {

            $time = date('H:i:s',strtotime($request->reservation_time));
            $date = date('Y-m-d',strtotime($request->reservation_date));
            $currenttime = date('H:i:s');
            $currentDate = date('Y-m-d');
            $day = strtolower(date('l',strtotime($request->reservation_date)));
            if (($date == $currentDate && $time > $currenttime) || ($date > $currentDate)) {
                $openingTimes = OpeningTime::where('setting_id','=',$setting->id)->where('day_name','=',$day)->first();
                if (!empty($openingTimes) && $openingTimes->is_close == 0) {

                    if ($openingTimes->start_time <= $time && $openingTimes->end_time > $time) { 

                        $tableReservations = TableReservation::where('reservation_time','=', $time)->where('reservation_date','=', $date)->get()->toArray();
                        if (!empty($tableReservations)) {
                            $total_men = 0;
                            foreach ($tableReservations as $key => $value) {
                                $total_men += $value['people_count'];
                                
                            }
                            
                            if ($setting->total_men != $total_men) {

                                $remaining = $setting->total_men - $total_men;

                                if ($request->people_count <= $remaining) {
                                    $tableReservation = new TableReservation;

                                    $tableReservation->reservation_date = $date;
                                    $tableReservation->people_count = $request->people_count;       
                                    $tableReservation->reservation_time = $time;       
                                    $tableReservation->name = $request->name;       
                                    $tableReservation->email = $request->email;       
                                    $tableReservation->phone = $request->phone; 
                                            

                                    if($tableReservation->save()){

                                        $msg = 'Your Table Book successfully';
                                        $result = 1;
                                    }
                                }else{

                                        $msg = 'Only '.$remaining .' People Space on selected time';
                                        $result = 0;

                                }
                                

                            }else{
                                        $msg = 'All Table reserved this selected time';
                                        $result = 0;
                            }
                        }else{
                                $tableReservation = new TableReservation;

                                $tableReservation->reservation_date = $date;
                                $tableReservation->people_count = $request->people_count;       
                                $tableReservation->reservation_time = $time;       
                                $tableReservation->name = $request->name;       
                                $tableReservation->email = $request->email;       
                                $tableReservation->phone = $request->phone; 
                                        

                                if($tableReservation->save()){

                                    $msg = 'Your Table Book successfully';
                                    $result = 1;
                                }
                        }
                    }else{
                        $msg = 'This time not set in Detail';
                        $result = 0;

                    }


                }else{

                        $msg = 'This day is week off please cahnge date';
                        $result = 0;

                }

            }else{

                        $msg = 'Please select greater than current time ';
                        $result = 0;
            }
          
       }else{
        $msg = 'Please Fill all * fields';
       }
        
        

        return response()->json(['success'=> $result,'msg'=>$msg]);
        die;
    }     

}
