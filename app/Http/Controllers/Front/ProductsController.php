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
use App\Models\ShippingTax;
use App\Models\Couponcode;
use App\Models\Order;
use App\Models\ProductFeature;
use App\Models\ProductFeatureAttribute;

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
      $products = array();
      $subCategories = array();
      $subCatArr = array();
      $productsArr = array();
      $current_time = strtotime(date('H:i:s a'));
      
      $categories_first = Category::where('slug','=', $slug)->first();

      $categories = Category::where('parent_id','=', $categories_first->id)->get();

      if (!empty($categories)){

        $products = Product::with('categorysub')->where('category_id','=', $categories_first->id)->where('status','=',1)->get()->toArray();
      }   

      foreach ($products as $key => $value) {
          $productsArr[$value['categorysub']['name'].'~'.$value['categorysub']['image'].'~'.$value['categorysub']['slug']][] = $value ;
      }
    //echo '<pre>';print_r($productsArr);die;
      return view('front.products.index',['categories' =>$categories,'products' =>$productsArr,]);
  }

/**
 * Display the products by sub category.
 *
 * @param string $slug
 *
 * @return \Illuminate\Http\Response
 */  
  public function sub_categoryindex(Request $request ,$slug = null)
  {
    $conditions[] = array('status','=',1);
    $orconditions = array();
    $column = 'created_at';
    $type = 'DESC';
    $limit = 25;

    $products = array();
    $productrates = array();
    $avg_rating = 0;
    $totalRating = 0;
    $tagIds = array();
    $productIds = array();
    $product_Ids = array();
    $tag_list = array();

    $categories = Category::where('slug','=', $slug)->first();
    $tagists = ProductTag::get();

    foreach ($tagists as $key => $tagist) {
      $tag_list[strtolower($tagist->tag)] = strtolower($tagist->tag);
    }
    
    if (!empty($categories)){

      $conditions[] = array('sub_category_id','=', $categories->id);
      $productrating = Product::select ('sub_category_id','id','name')->with('productReview')->where('sub_category_id','=', $categories->id)->where('status','=',1)->get()->toArray();

      foreach ($productrating as $key => $value) {
        $avg_rating = 0;
        $totalRating = 0;
        if (!empty($value['product_review'])) {
          foreach ($value['product_review'] as $key => $proreview) {
            $totalRating += $proreview['rating'];
          }
          if(($totalRating > 0) && (count($value['product_review']) > 0)){
            $avg_rating = $totalRating / count($value['product_review']);
          }
        }
        $productrates[$value['id']] = round($avg_rating);
      }


      $column = 'created_at';
      $type = 'DESC';
      $is_search = 0;  

      if (isset($_GET['data'])) {
       
          if (isset($_GET['data']['sort']) && !empty($_GET['data']['sort'])) {

            if ($_GET['data']['sort'] == 'low_to_high') {
                $column = 'price';
                $type = 'ASC';
            } elseif($_GET['data']['sort'] == 'high_to_low') {
                $column = 'price';
                $type = 'DESC';
            }else{
                $column = 'created_at';
                $type = 'DESC';
            }
          }

          if (isset($_GET['data']['show_recored']) && !empty($_GET['data']['show_recored'])) {
            $limit = $_GET['data']['show_recored'];
          }            

          if (isset($_GET['data']['product_name']) && !empty($_GET['data']['product_name'])) {
            $is_search = 1;
            $conditions[] = array('name','LIKE', '%'.$_GET['data']['product_name'].'%');
          }              

          if (isset($_GET['data']['tag']) && !empty($_GET['data']['tag'])) {
            $is_search = 1;
            $tagitem_arr['data'] = explode(',', $_GET['data']['tag']);

            foreach ($tagitem_arr['data'] as $key => $value) {
              $tagIds[] = $value;
            }

            $tagproduct_id = ProductTag::whereIn('tag',$tagIds)->get();
            foreach ($tagproduct_id as $key => $tagproductid) {
              $product_Ids[$tagproductid['product_id']] = $tagproductid['product_id'];
            }
            $orconditions = (!empty($product_Ids))?$product_Ids:null;
          }            

          if (isset($_GET['data']['rating']) && ($_GET['data']['rating'] >= 0 )) {

            $is_search = 1;
            foreach ($productrates as $key => $productrate) {
              if ($_GET['data']['rating'] == $productrate) {
                $productIds[$key] = $key;
              }              
            }
            $orconditions = (!empty($productIds))?$productIds:null;
          }
        }

        if($is_search == 1){
          if(!empty($orconditions)){
           $products = Product::where($conditions)->whereIn('id',$orconditions)->OrderBy($column, $type)->limit($limit)->get(); 
          }else{
            $products = '';
          }
        }else{
          $products = Product::where($conditions)->OrderBy($column, $type)->limit($limit)->get();
        }

    }   
    
    return view('front.products.sub_categoryindex',["products" => $products,'categories' =>$categories,'tag_list' =>$tag_list]);
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
    $product_details = Product::with('category','productItem','productAttribute')->where('slug','=', $slug)->where('status','=',1)->first();
		$productImages = array();
		if(!empty($product_details)){
			$iImgPath = asset('image/no_product_image.jpg');
      if(isset($product_details->image) && !empty($product_details->image)){
        $iImgPath = asset('image/product/400x330/'.$product_details->image);
      }
			$productImages[] = $iImgPath;
			
			if(!empty($product_details->product_images) && count($product_details->product_images) > 0){
				foreach($product_details->product_images as $product_img){
					$productImages[] = asset('image/product/400x330/'.$product_img->image);
				}
			}
		}

    $related_products  = Product::where('sub_category_id','=',$product_details->sub_category_id)->where('id','!=',$product_details->id)->where('status','=',1)->get();

    /*$productFeatureItems = ProductFeatureItems::with('productFeature')->where('product_id','=', $product_details->id)->get()->toArray();	*/

    //echo "<pre>";print_r($productFeatureItems);die;

    $productReviews = ProductReview::with('user')->where('product_id','=',$product_details->id)->get();
		
    return view('front.products.detail',["product_details" => $product_details,'productReviews'=>$productReviews,'related_products'=>$related_products,'productImages'=>$productImages]);
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
        $postcode_list = Postcode::where('post_code','=',$request->code)->first();
        $postcode = array();
        if (!empty($postcode_list)) {          
          $postcode['code'] = 'Current Post Code : '.$request->code;
          $postcode['code_status'] = 1;
          $postcode['button_text'] = 'Search new Postcode';
          $postcode['postcode'] = $request->code;
          if (Session::has('postcode')) {
            Session::forget('postcode');
          }
          Session::put('postcode', $postcode);

          Session::flash('success_h1','Postcode');
          Session::flash('success','Food delivery able to your Postcode');          
        }else {
          Session::flash('error_h1','Postcode');
          Session::flash('error','Something went wrong. Please try again');
        }
    }
    return redirect('/');
  }

/**
 * find post code and save session
 *
 * ajax
 * @param \Illuminate\Http\Request  $request
 *
 * @return \Illuminate\Http\Response
 */
  public function ajax_search_postalcode(Request $request)
  {
    $result = array();
    if ($request->isMethod('post')) {          
      $postcode_list = Postcode::where('post_code','=',$request->code)->first();
     
      $postcode = array();
      if (!empty($postcode_list)) {        
        $postcode['code'] = 'Post Code : '.$request->code;
        $postcode['code_status'] = 1;
          if (Session::has('postcode')) {
            Session::forget('postcode');
          }
          Session::put('postcode', $postcode);
        $result = $postcode;
      }
    }
    return response()->json($result);
  }

/**
 * autocomplete_postcode
 *
 * ajax
 * 
 * @return \Illuminate\Http\Response
 */
  public function autocomplete_postcode()
  { 
    $codes =array();
    if(isset($_GET['term']) && !empty($_GET['term'])){
      $term = $_GET['term'];
      $postcode_list = Postcode::where('post_code','LIKE',$term.'%')->get();
         
      if (isset($postcode_list[0]) && !empty($postcode_list)) {
               foreach ($postcode_list as $key => $value) {
                   $codes[$value->id] = $value->post_code;
               }
      }
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
    //echo '<pre>';print_r($_POST);die;
    if(Auth::check()){
      if ($request->isMethod('post')) {

        $set_id = new Cart;
        $qty = isset($request->productqty)?$request->productqty:1;
        $products = Product::where('status','=', 1)->where('id','=', $request->productid)->first();
        $cart_list = Cart::where('product_id','=',$request->productid)->first();

        if (!empty($cart_list)) {
          $set_id = Cart::find($cart_list->id);
          $oldqty = $cart_list->qty;
        }

        if (Session::has('shoppingstep')) {
          Session::forget('shoppingstep');
        }

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
        }        
      }
    }else{

    }
    return response()->json($result);
  }
/**
 * add_to_cart
 *
 * ajax
 * @param \Illuminate\Http\Request  $request
 *
 * @return \Illuminate\Http\Response
 */
  public function add_to_cart_new(Request $request)
  {         
    $result['cart_count'] = 0;
    $result['response'] = 0;
    $oldqty = 0;
    //echo '<pre>';print_r($_POST);die;
    if(Auth::check()){
      if ($request->isMethod('post')) {

        $set_id = new Cart;
        $qty = isset($request->quantity)?$request->quantity:1;
        $products = Product::where('status','=', 1)->where('id','=', $request->product_id)->first();
       // echo '<pre>';print_r($_POST);die;
        //$cart_list = Cart::where('product_id','=',$request->productid)->first();
        $cart_list = array();

        if (!empty($cart_list)) {
          $set_id = Cart::find($cart_list->id);
          $oldqty = $cart_list->qty;
        }

        if (Session::has('shoppingstep')) {
          Session::forget('shoppingstep');
        }

        if(!empty($products)){
         // echo '<pre>';print_r($_POST);die;
            $cart = $set_id;
            $cart->user_id = Auth::user()->id;
            $cart->product_id = $request->product_id;
            $cart->qty = $qty+$oldqty; 

            if (isset($request->productFeatureItem) && !empty($request->productFeatureItem)) {
               foreach ($request->productFeatureItem as $key => $value) {
                   $cart->productFeatureItem_id = $key; 
                   $cart->productFeatureItem_price = $value; 
                } 
            }

            if (isset($request->productItem) && !empty($request->productItem)) {
               $cart->productItem_ids = serialize($request->productItem);
            }  
            
            $cart->save();

            $cart_count = Cart::where('user_id','=', Auth::user()->id)->count();
            $result['cart_count'] = $cart_count;
            $result['response'] = 1;

            if (Session::has('cart_count')) {
                Session::forget('cart_count');
            }
            Session::put('cart_count', $cart_count);
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
    $tax_shipping = ShippingTax::first();
    if(Auth::check()){      
      if ($request->isMethod('post')) {
        if ($request->qty <= 1 && $request->button_type == 'sub') {
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
            

            if (!empty($tax_shipping->shipping_amount) && $tax_shipping->shipping_type == 'Paid') {

             $result['shippingamount'] = $tax_shipping->shipping_amount;

            }else{
              $result['shippingamount'] = 0;
            }

            if (!empty($tax_shipping->tax_percent) && $tax_shipping->tax_percent > 0) {              
                $result['tax_amount'] =  ($result['total'] * $tax_shipping->tax_percent) / 100;
            } else{
              $result['tax_amount'] = 0 ;
            }

            $result['product_id'] = $request->product_id;
            $result['cart_id'] = $request->cart_id;
            $result['qty'] = $qty;
            $result['subMaintotal'] = $result['shippingamount'] + $result['total'] + $result['tax_amount'];


    if (Session::has('apply_coupon')) {
      if (Session::get('apply_coupon.status') == 'percentage') {
         $result['coupon_discount'] = $result['total'] * Session::get('apply_coupon.percentage') / 100 ;
        if ($result['subMaintotal'] > $result['coupon_discount']) {
            $result['Maintotal'] = $result['subMaintotal'] - $result['coupon_discount'];
        }else {
            $result['Maintotal'] = 0;
        }
      }else{
        $result['coupon_discount'] = Session::get('apply_coupon.amount');
        if ($result['subMaintotal'] > Session::get('apply_coupon.amount')) {
            $result['Maintotal'] = $result['subMaintotal'] - Session::get('apply_coupon.amount');
        }else {
            $result['Maintotal'] = 0;
        }
      }
        Session::put('apply_coupon.amount',$result['coupon_discount']); 
    }

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
    $current_date = date('Y-m-d');
    $conditions = array(Auth::user()->group_id => Auth::user()->group_id,0 => 0);

    $cart_list = Cart::with('product')->where('user_id','=', Auth::user()->id)->get();

    
    $couponcode_lists = Couponcode::with('couponItem')->where('status','=', 1)->where('start_date','<=', $current_date)->where('expire_date','>=', $current_date)->whereIn('group_id',$conditions)->get();
    //echo '<pre>couponcode_lists'; print_r($couponcode_lists); die;
    
    $couponn = array();
    foreach ($cart_list as $key1 => $cart_value) {
        foreach ($couponcode_lists as $key3 => $couponcodeList) {
          //echo '<pre>couponcodeList'; print_r($couponcodeList); die;

          $appliedCoupon = order::where('coupon_code','=', $couponcodeList->code)->count();

          $appliedUserCoupon = order::where('coupon_code','=', $couponcodeList->code)->where('user_id','=', Auth::user()->id)->count();

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
//echo '<pre>couponn'; print_r($couponn); die;
    $couponcode_list = Couponcode::whereIn('id',$couponn)->get();

//die('asfsdfd');
    $shipping_taxes = ShippingTax::first();

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

        
    return view('front.products.cart_detail',["cart_list" => $cart_list,"addressesArr" => $addressesArr,"shipping_taxes" => $shipping_taxes,"couponcode_list" => $couponcode_list]);
  }

/**
 * sopping_cart_step.
 * 
 * @param \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
  public function shopping_cart_step(Request $request)
  {
    //die('sfsdffg');
    $steps = array();
    $product_detail = array();

    $cart_itemslist = Cart::with('product')->where('user_id','=', Auth::user()->id)->get();
    $shipping_taxes = ShippingTax::first();
    $total = 0;

    if (!empty($cart_itemslist[0])) {
      foreach ($cart_itemslist as $key => $cartlistdetail) {                 
          $total += ($cartlistdetail->product->price * $cartlistdetail->qty);
      }

      if (!empty($shipping_taxes->shipping_amount) && $shipping_taxes->shipping_type == 'Paid') {

      $shippingamount = $shipping_taxes->shipping_amount;

      }else {

      $shippingamount = 0;
      }

      if (!empty($shipping_taxes->tax_percent) && $shipping_taxes->tax_percent > 0) {              
        $tax_amount =  ($total * $shipping_taxes->tax_percent) / 100;
      } else {
        $tax_amount = 0 ;
      }

      $submaintotal = $total + $shippingamount + $tax_amount;

      //echo '<pre>';print_r(Session::get('apply_coupon'));die;
      if (Session::has('apply_coupon')) {
        if (Session::get('apply_coupon.status') == 'percentage') {
          $coupon_discount = $total * Session::get('apply_coupon.percentage') / 100 ;
          if ($submaintotal > $coupon_discount) {
              $maintotal = $submaintotal - $coupon_discount;
          }else {
              $maintotal = 0;
          }
        }else{
          $coupon_discount = Session::get('apply_coupon.amount');
          if ($submaintotal > Session::get('apply_coupon.amount')) {
              $maintotal = $submaintotal - Session::get('apply_coupon.amount');
          }else {
              $maintotal = 0;
          }
        }        
      }else{
        $coupon_discount = 0;
        $maintotal = $submaintotal;
      }
    }

    if (!empty($cart_itemslist[0])) {
      if (isset($request->step) && !empty($request->step)) {
        if($request->step == 'step_1') {
          $steps['step'] = 'step_1';
          $steps['total'] = $total; 
          $steps['tax_amount'] = $tax_amount; 
          $steps['maintotal'] = $maintotal; 
          $steps['coupon_discount'] = $coupon_discount; 
          $steps['shippingamount'] = $shippingamount; 
          $steps['shipping_type'] = $shipping_taxes->shipping_type; 
          $steps['tax_percentage'] = $shipping_taxes->tax_percent; 

          if (Session::has('shoppingstep')) {
            Session::forget('shoppingstep');
          }
          Session::put('shoppingstep', $steps);       
        }

        if($request->step == 'step_2') {
          $steps['deliveryAddress'] = isset($request->deliveryAddress) ? $request->deliveryAddress : '';
          $postcode_list = Postcode::where('post_code','=',$steps['deliveryAddress']['postcode'])->first();

          if (!empty($postcode_list)) {
            $steps['step'] = 'step_2';
            $steps['total'] = $total;
            $steps['user'] = $request->user;
            $steps['tax_amount'] = $tax_amount; 
            $steps['maintotal'] = $maintotal; 
            $steps['coupon_discount'] = $coupon_discount; 
            $steps['shippingamount'] = $shippingamount; 
            $steps['shipping_type'] = $shipping_taxes->shipping_type; 
            $steps['tax_percentage'] = $shipping_taxes->tax_percent; 
            if (Session::has('shoppingstep')) {
                Session::forget('shoppingstep.step');
            }
            Session::put('shoppingstep', $steps);
          }else{
            Session::flash('error_h1','Postcode');
            Session::flash('error','Food delivery not able to your Postcode, Change Postcode');
          }              
        }
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
            Session::flash('success_h1','Review');  
					Session::flash('success','Your review has been saved successfully');
				}else{
            Session::flash('error_h1','Review');
					Session::flash('error','Something went wrong. Please try again');
				}
			}else{
        Session::flash('error_h1','Review');
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



public function ajaxSelectDeliveryAddress(){
    
    $resultArr = array();
    $resultArr['result'] = 0;
    if(isset($_POST['requestType']) && $_POST['requestType'] == "selectAddress"){
        
        $address_id = (isset($_POST['address_id']) && !empty($_POST['address_id'])) ? $_POST['address_id'] : '';
        $address_type = (isset($_POST['address_type']) && !empty($_POST['address_type'])) ? $_POST['address_type'] : '';
        
        if(!empty($address_id)){
            $deliveryAddress =  UserAddress::where('user_id','=',Auth::user()->id)->where('id','=',$address_id)->first();
            if(!empty($deliveryAddress)){
                 $resultArr['result'] = 1;
                $resultArr['delivery_address_id'] = $deliveryAddress->id;
                $resultArr['delivery_address'] = $deliveryAddress->address;
                 $resultArr['delivery_title'] = $deliveryAddress->title;
                $resultArr['delivery_postcode'] = $deliveryAddress->postcode;
                $resultArr['delivery_phone'] = $deliveryAddress->phone;
            }
        }
        
    }
   echo json_encode($resultArr); exit();
}


/**
 * set coupon amount in cart items .
 * 
 *
 * @param string $slug
 *
 * @return \Illuminate\Http\Response
 */
    public function apply_coupon_amount($id = null ,$slug = null)
    {   
      //echo $slug;die;
      $applyCouponAmount = array();
      $couponcode = Couponcode::where('id','=',$id)->first();
      if (Session::has('apply_coupon')) {
          Session::forget('apply_coupon');
      }
      if ($couponcode->coupon_type == 'amount' ) {
        $applyCouponAmount['amount'] = $couponcode->amount;
        $applyCouponAmount['message'] = 'Coupon Applied ! '. $couponcode->code;
        $applyCouponAmount['id'] = $couponcode->id;
        $applyCouponAmount['status'] = 'amount';
        $applyCouponAmount['coupon_code'] = $couponcode->code;
        $applyCouponAmount['coupon_type'] = $couponcode->coupon_type;
        $applyCouponAmount['coupon_amount'] = $couponcode->amount;
        
      }else{
        $coupon_amount = $slug * $couponcode->amount / 100 ; 
        $applyCouponAmount['amount'] = $coupon_amount;
        $applyCouponAmount['message'] = 'Coupon Applied ! '. $couponcode->code;
        $applyCouponAmount['id'] = $couponcode->id;
        $applyCouponAmount['percentage'] = $couponcode->amount;
        $applyCouponAmount['status'] = 'percentage';
        $applyCouponAmount['coupon_code'] = $couponcode->code;
        $applyCouponAmount['coupon_type'] = $couponcode->coupon_type;
        $applyCouponAmount['coupon_amount'] = $couponcode->amount;
      }
        Session::put('apply_coupon', $applyCouponAmount);
      return redirect('/shopping-cart');
    }

/**
 * back_to_cart .
 * 
 *
 * @return \Illuminate\Http\Response
 */
    public function back_to_cart()
    {   

      if (Session::has('shoppingstep')) {
          Session::forget('shoppingstep');
      }
      return redirect('/shopping-cart');
    }


}
