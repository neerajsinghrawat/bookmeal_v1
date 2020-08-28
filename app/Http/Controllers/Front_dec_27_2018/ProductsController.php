<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Country;
use App\Models\Postcode;
use App\Models\Cart;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Models\ProductTag;
use App\Models\UserAddress;
use Session;
use Auth;
use DB;

class ProductsController extends Controller
{

    
/**
 * Display the products by category.
 *
 * @param string $slug
 *
 * @return \Illuminate\Http\Response
 */

  
  public function index(Request $request ,$slug = null)
    {
        /*if (Session::has('postcode')) {

        }else{

            return redirect('search-postal');
        }*/

        $products = array();
        $categories = Category::where('slug','=', $slug)->first();
        if (!empty($categories)){
            $products = Product::with('categorysub')->where('category_id','=', $categories->id)->where('status','=',1)->get()->toArray();

            $popular_products = Product::where('status','=', 1)->where('is_popular','=', 1)->where('category_id','=', $categories->id)->orderBy(DB::raw('RAND()'))->limit(10)->get();
        }   



        $productsArr = array();

        foreach ($products as $key => $value) {
            $productsArr[$value['categorysub']['name']][] = $value ;
        }

        //echo'<pre>';print_r($productsArr);die;
        return view('front.products.index',["products" => $productsArr,"slug" => $slug,"popular_products" => $popular_products]);
    }


/**
 * Display products details.
 *
 * @param string $slug
 *
 * @return \Illuminate\Http\Response
 */
  public function detail($slug = null)
    {

        $product_details = Product::where('slug','=', $slug)->where('status','=',1)->first(); 

    	$related_products  = Product::where('sub_category_id','=',$product_details->sub_category_id)->where('id','!=',$product_details->id)->where('status','=',1)->get(); 
		
		$productReviews = ProductReview::with('user')->where('product_id','=',$product_details->id)->get();
		
        return view('front.products.detail',["product_details" => $product_details,'productReviews'=>$productReviews,'related_products'=>$related_products]);
    }

    /**
     * search postcode
     *
     * @param \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
      public function search_postalcode(Request $request)
    {
    	  if ($request->isMethod('post')) {
            
            $postcode_list = Postcode::where('main','=',1)->where('post_code','=',$request->code)->first();

            if (!empty($postcode_list)) {
                if (Session::has('postcode')) {

                    Session::forget('postcode');
                }
                Session::put('postcode', $postcode_list);
                 //echo Session::get('postcode');die;
              return redirect('/');
            }

          }

        return view('front.products.search_postalcode');
    }


     public function autocomplete_postcode()
     { 
        $codes =array();

        if(isset($_GET['term']) && !empty($_GET['term'])){
            $term = $_GET['term'];
           // echo $term ;die;
            $postcode_list = Postcode::where('main','=',1)->where('post_code','LIKE',$term.'%')->get();
             
            if (isset($postcode_list[0]) && !empty($postcode_list)) {
                     foreach ($postcode_list as $key => $value) {
                         $codes[$value->id] = $value->post_code;
                     }
            }         
            //echo '<pre>';print_r($codes);die;
            echo json_encode($codes); exit();
            
        }
    }

    /**
     * add_to_cart
     *
     * ajax
     * @param \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function add_to_cart(Request $request)
    {
             
        $result['cart_count'] = 0;
        $result['response'] = 0;
        $oldqty = 0;
        if(Auth::check()){

            //$test = $request->getClientIp(true);
             //echo '<pre>';print_r($test);
            if ($request->isMethod('post')) {

                $set_id = new Cart;
                $qty = $request->productqty;

                $products = Product::where('status','=', 1)->where('id','=', $request->productid)->first();

                $cart_list = Cart::where('product_id','=',$request->productid)->first();

                if (!empty($cart_list)) {

                    $set_id = Cart::find($cart_list->id);
                    $oldqty = $cart_list->qty;

                }

                if (Session::has('shoppingstep')) {
                Session::forget('shoppingstep');
            }

                //echo '<pre>';print_r($products);die;
                if(!empty($products)){

                    $cart = $set_id;

                    $cart->user_id = Auth::user()->id;
                    $cart->product_id = $request->productid;
                    $cart->qty = $qty+$oldqty;       
                    
                    $cart->save();

                    
                    $cart_count = Cart::where('user_id','=', Auth::user()->id)->count();

                    $result['cart_count'] = $cart_count;
                    $result['response'] = 1;

                    if (Session::has('cart_count')) {

                        Session::forget('cart_count');
                    }
                    Session::put('cart_count', $cart_count);
                     //echo Session::get('cart_count');die;


                                //echo '<pre>';print_r($result);die;
                }        
            }

        }else{

           
        }

        return response()->json($result);
    }


    /**
     * Update cart
     *
     * ajax
     * @param \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update_cart(Request $request)
    {
             
        $result['cart_count'] = 0;
        $result['response'] = 0;
        $result['class'] = '';
        $oldqty = 0;
        $qty = 0;
        $result['total'] = 0;
        $result['qty'] = 0;
        if(Auth::check()){

            //$test = $request->getClientIp(true);
             //echo '<pre>';print_r($_POST);die;
            if ($request->isMethod('post')) {

                if ($request->qty <= 1 && $request->button_type == 'sub') {
                    //echo '<pre>';print_r($_POST);die;
                    $cart = Cart::find($request->cart_id);    

                    if($cart->delete()){
                        $result['response'] = 2;
                        $result['class'] = "$('.cart_'+$request->cart_id).remove()";

                    }
                        $cart_count = Cart::with('product')->where('user_id','=', Auth::user()->id)->count();
            
                        $result['cart_count'] = $cart_count;

                        if (Session::has('cart_count')) {

                            Session::forget('cart_count');
                        }
                        Session::put('cart_count', $cart_count);

                }else{

                    $cart_list = Cart::where('product_id','=',$request->product_id)->where('id','=',$request->cart_id)->first();

                if (!empty($cart_list)) {

                    $oldqty = $cart_list->qty;

                    if ($request->button_type == 'add') {
                       $qty = $oldqty+1;
                    } elseif ($request->button_type == 'sub') {
                        $qty = $oldqty-1;
                    }

                    $cart = Cart::find($cart_list->id);

                    $cart->qty = $qty;       
                    
                    if($cart->save()){

                        $result['response'] = 1;

                    }

                    $cart_details = Cart::with('product')->where('user_id','=', Auth::user()->id)->get();
                  
                    foreach ($cart_details as $key => $value) {
                        $result['total'] += ($value->product->price * $value->qty);
                    }

                    $result['producttotal'] = $qty*$request->product_price;
                    $result['product_id'] = $request->product_id;
                    $result['cart_id'] = $request->cart_id;
                    $result['qty'] = $qty;
  //echo '<prE>cart_details'; print_r($result); die;
                }
                

                }



                    
                    

            }

        }

        return response()->json($result);
    }


/**
 * Delete cart items
 *
 * ajax
 * @param \Illuminate\Http\Request  $request
 *
 * @return \Illuminate\Http\Response
 */
    public function delete_cart(Request $request)
    {

        $result['cart_count'] = 0;
        $result['response'] = 0;
        if ($request->isMethod('post')) {
            if (!empty($request->cartid)) {

                $cart = Cart::find($request->cartid);    

                if($cart->delete()){
                    $result['response'] = 1;
                }

            $cart_count = Cart::with('product')->where('user_id','=', Auth::user()->id)->count();
            
            $result['cart_count'] = $cart_count;

            if (Session::has('cart_count')) {

                Session::forget('cart_count');
            }
            Session::put('cart_count', $cart_count);

            }       
        }

      return response()->json($result);
    }

/**
 * Cart items list details.
 *
 * @return \Illuminate\Http\Response
 */
    public function cart_detail()
    {

        $cart_list = Cart::with('product')->where('user_id','=', Auth::user()->id)->get();

        $addressesArr = array();
        $addresses = UserAddress::where('user_id','=',Auth::user()->id)->get();
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
        return view('front.products.cart_detail',["cart_list" => $cart_list,"addressesArr" => $addressesArr]);
    }

/**
 * sopping_cart_step.
 * 
 * @param \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
    public function shopping_cart_step(Request $request)
    {
        $steps = '';
        $product_detail = array();

        $cart_itemslist = Cart::with('product')->where('user_id','=', Auth::user()->id)->get();
        $total = 0;

        if (!empty($cart_itemslist[0])) {
            foreach ($cart_itemslist as $key => $cartlistdetail) {                 
                $total += ($cartlistdetail->product->price * $cartlistdetail->qty);
            }
        }


       if (isset($request->step) && !empty($request->step)) {
           if($request->step == 'step_1') {

            $steps['step'] = 'step_1';
            $steps['total'] = $total;

            if (Session::has('shoppingstep')) {
                Session::forget('shoppingstep');
            }
            Session::put('shoppingstep', $steps);
           
           }

            if($request->step == 'step_2') {

                //echo '<pre>';print_r($_POST);die;

                $steps['step'] = 'step_2';
                $steps['total'] = $total;

                $steps['user'] = $request->user;

                if (Session::has('shoppingstep')) {
                    Session::forget('shoppingstep.step');
                }

                Session::put('shoppingstep', $steps);
                 
                $user = User::find(Auth::user()->id);

                $user->first_name = $request->user['first_name'];     
                $user->last_name = $request->user['last_name'];     
                $user->phone = $request->user['phone'];     
                $user->address = $request->user['address'];     
                $user->postcode = $request->user['postcode'];   

                //$user->update($request->all());
                $user->save();
                //echo '<pre>';print_r(Session::get('shoppingstep'));die;
                
            }        

       }

       return redirect('/shopping-cart');
       
    }

/**
 * sopping_cart_step.
 * 
 * @param \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
    public function shoppingcart_step(Request $request)
    {
    $steps = '';
    //echo '<pre>';print_r($_POST);die;
        if (isset($request->step) && !empty($request->step)) {
            if($request->step == 'step_1') {

                $steps['step'] = 'step_1';

                if (Session::has('shoppingstep')) {
                    Session::forget('shoppingstep');
                }
                Session::put('shoppingstep', $steps);
            }

            if($request->step == 'step_2') {
                $steps['step'] = 'step_2';
                if (Session::has('shoppingstep')) {
                    Session::forget('shoppingstep');
                }
                Session::put('shoppingstep', $steps);                
            }
        }

       return redirect('/shopping-cart');
       
    }



/**
     * Store a newly created product review.
     *
     * @return \Illuminate\Http\Response
     */
	public function save_product_review(){
		$product_slug = '';
		if(isset($_POST['submit']) && $_POST['submit'] == "saveProductReview"){
			$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : 0;
			$product_slug = isset($_POST['product_slug']) ? $_POST['product_slug'] : '';
			
			$exitProductReview = ProductReview::where('user_id','=',Auth::user()->id)->where('product_id','=',$product_id)->first();
			
			if(empty($exitProductReview)){
				$review = new ProductReview;
				$review->product_id = $product_id;
				
				$review->review = isset($_POST['review']) ? $_POST['review'] : '';
				$review->rating = isset($_POST['rating']) ? $_POST['rating'] : 0;
				$review->user_id = Auth::user()->id;
				$review->created_at = date('Y-m-d H:i:s');
				$review->updated_at = date('Y-m-d H:i:s');
				
				if($review->save()){
					Session::flash('success','Your review has been saved successfully');
				}else{
					Session::flash('error','Something went wrong. Please try again');
				}
			}else{
				Session::flash('error','you review already exists');
			}
			
			
			return redirect('/product/'.$product_slug);
			
		}
		
	}
    
/**
 * product_tag_list.
 * 
 *
 * @param string $slug
 *
 * @return \Illuminate\Http\Response
 */
    public function product_tag_list($slug = null)
    {   
        $resultarr = array();
        $product_list = array();

        $product_tags = ProductTag::select('product_id')->where('tag','=',$slug)->distinct('tag')->get();

        if (isset($product_tags) && count($product_tags) > 0) {
            
        foreach ($product_tags as $key => $product_tags) {
           $resultarr[$product_tags['product_id']] = $product_tags['product_id'];
        }

        
        //
        $product_list = Product::whereIn('id',$resultarr)->get();

        }

       // echo '<pre>resultarr'; print_r($resultarr); die;
      
        return view('front.products.product_tag_list',["product_list" => $product_list,"slug" => $slug]);
       
    }




}
