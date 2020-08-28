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
use Session;
use DB;

class PagesController extends Controller
{

  
    public function getHome()
    {

        $category_list = Category::where('parent_id','=',0)->where('status','=', 1)->with('children')->get();

        $ourmenu_category_listData = Category::where('parent_id','!=',0)->where('status','=', 1)->get();
        $ourmenu_category_list = array();
        
        if(!empty($ourmenu_category_listData)){
            foreach($ourmenu_category_listData as $cat){
                $cat_name = strtolower(trim($cat->name));
                $cat_name = str_replace(' ', '-', $cat_name);
                $ourmenu_category_list[$cat_name] = $cat;
            }
        }
        
       // echo '<pre>'; print_r($ourmenu_category_listArr); die;
        
    	$ourmenu_category_productData = Category::where('parent_id','!=',0)->where('status','=', 1)->with('product')->get();
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

       //echo '<pre>';print_r($ourmenu_category_product);die;

    	$sliders = Slider::where('status','=', 1)->get();
    	$testimonials = Testimonial::where('status','=', 1)->get();

    	$products = Product::where('status','=', 1)->where('is_popular','=', 1)->orderBy(DB::raw('RAND()'))->limit(10)->get();
    	//$setting = Setting::where('status','=', 1)->first();

    	//echo '<pre>';print_r($category_list);die;
 
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
        //echo '<pre>';print_r($request->all());die;
        $newsLetter = new NewsLetter;

        $newsLetter->email = $request->email;

        if($newsLetter->save()){
            Session::flash('success','NewsLetter Save successfully');
            }else{
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
        $testimonials = Testimonial::where('status','=', 1)->get();
        
        return view('front.pages.about_us',["pageabout_us" => $pageabout_us,"product_count" => $product_count,"testimonials" => $testimonials]);
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
            Session::flash('success','Contact Save successfully');
            }else{
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

}
