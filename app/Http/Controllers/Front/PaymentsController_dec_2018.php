<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use URL;
use Auth;
use Session;
use Redirect;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;

class PaymentsController extends Controller
{
    private $_api_context;
    public function __construct()
    {
	   /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        //echo '<pre>';print_r();die;
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );

        //
        $this->_api_context->setConfig($paypal_conf['settings']);
        //echo '<pre>';print_r($paypal_conf['settings']));die;
	}




/**
 * Show the form for creating a new resource.
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
    public function paypal(Request $request)
    {
       //echo '<prE>item_1'; print_r(Session::get('shoppingstep.total')); die; 
       $total = (Session::has('shoppingstep.total'))?Session::get('shoppingstep.total'):0; 
       if($total == 0){
        return redirect('/shopping-cart');
       }      
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

                $item = new Item();
                $item->setName('product') 
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($total); 

    
            $item_list = new ItemList();
        $item_list->setItems(array($item));
 
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($total);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('12_23');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('payments/success')) /** Specify return URL **/
            ->setCancelUrl(URL::to('payments/cancel'));

         
        $patchReplace = new Patch();
        $patchReplace->setOp('add')
                    ->setPath('/transactions/0/item_list/shipping_address')
                    ->setValue(json_decode('{
                        "line1": "345 Lark Ave",
                        "city": "Montreal",
                        "state": "QC",
                        "postal_code": "H1A4K2",
                        "country_code": "CA"
                    }'));

        $patchRequest = (new PatchRequest())->setPatches([$patchReplace]);

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

   
        try {
           
            $payment->create($this->_api_context);
            $payment->update($patchRequest, $this->_api_context);
              //dd($payment);exit;
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return Redirect::to('/');
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/');
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('/');
    }



    public function getPaymentStatus()
    {
		 
		
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error', 'Payment failed');
            return Redirect::to('/');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        
        if ($result->getState() == 'approved') {
			
           $order_number = $this->random_num(7);
           
            $order = new Order;
            $order->order_number = $order_number;
            $order->payment_id = $result->getId();
            $order->user_id =  Auth::user()->id;
			$order->total_amount =  (isset($result->transactions[0]->amount->total) && !empty($result->transactions[0]->amount->total)) ? $result->transactions[0]->amount->total : 0;
			
			$total_qty = 0;
			$cartIds = array();
			$productIds = array();
			$cart_itemslist = Cart::where('user_id','=', Auth::user()->id)->get();
			if(!empty($cart_itemslist)){
				foreach($cart_itemslist as $cart){
					$total_qty += $cart->qty;
					$cartIds[$cart->id] = $cart->id;
					$productIds[$cart->product_id] = $cart->product_id;
					
				}
			}
			
			$order->total_qty  = $total_qty;
			$order->payment_status  = $result->getState();
			$order->product_ids  = serialize($productIds);
            $order->save();
			
			
			$cart_itemslist = Cart::with('product')->where('user_id','=', Auth::user()->id)->get();
			 if(!empty($cart_itemslist)){
				 foreach($cart_itemslist as $cart){
					
					 // save data in cart item table
					$orderItem = new OrderItem();
					$orderItem->order_id = $order->id;
					$orderItem->product_id = $cart->product_id;
					$orderItem->user_id = Auth::user()->id;
					$orderItem->product_name = $cart->product->name;
					$orderItem->product_image = $cart->product->image;
					$orderItem->qty =  $cart->qty;
					$orderItem->amount = $cart->product->price;
					$orderItem->total_amount = $cart->qty * $cart->product->price;
					
					$orderItem->save();
				 }
			 }
			
			
			
			// deleting user cart by cartids
			$this->deleteUserCartByIds($cartIds);
			
			// distory user cart session
			$this->distoryUserCartSession();
			
            Session::put('success', 'Payment success');

            return Redirect::to('/cart-thankyou');
        }
		
		
        Session::put('error', 'Payment failed');
        return Redirect::to('/');
    }
	
	
/**
 * delete user cart by cart ids
 *
 * @param string $cartIds
 *
 * @return \Illuminate\Http\Response
 */
	public function deleteUserCartByIds($cartIds){
		if(!empty($cartIds)){
			Cart::whereIn('id', $cartIds)->delete(); 
		}
	}
	
	
/**
 * distory user cart session
 *
 *
 * @return \Illuminate\Http\Response
 */
	public function distoryUserCartSession(){
		
		Session::forget('cart_count');
		Session::forget('shoppingstep');
	}
	
	public function thankyou_cart(){
		
		$lastOrder = Order::with('user')->where('user_id','=', Auth::user()->id)->orderBy('id','desc')->first();
		//echo '<pre>lastOrder'; print_r($lastOrder); die;
		if(!empty($lastOrder)){
			 return view('front.orders.thankyou',["lastOrder" => $lastOrder]);
		}else{
			 return Redirect::to('/');
		}
		
	}
	
	
/**
 * function for getting random number for order number
 *
 * @param string $size
 *
 * @return \Illuminate\Http\Response
 */
	public function random_num($size) {
	$alpha_key = '';
	$keys = range('A', 'Z');

	for ($i = 0; $i < 2; $i++) {
		$alpha_key .= $keys[array_rand($keys)];
	}

	$length = $size - 2;

	$key = '';
	$keys = range(0, 9);

	for ($i = 0; $i < $length; $i++) {
		$key .= $keys[array_rand($keys)];
	}

	return $alpha_key . $key;
}


    public function cancel()
    {
		$errorMsg = '';
		
		$cartIds = array();
		$cart_itemslist = Cart::where('user_id','=', Auth::user()->id)->get();
		if(!empty($cart_itemslist)){
			foreach($cart_itemslist as $cart){
				$cartIds[$cart->id] = $cart->id;
			}
		}
		
		// deleting user cart by cartids
		$this->deleteUserCartByIds($cartIds);
		
		// distory user cart session
		$this->distoryUserCartSession();
		
		return view('front.orders.payment_cancel',["errorMsg" => $errorMsg]);
        
    }
       /**
 * Show the form for creating a new resource.
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function notify()
    {
     echo '<pre>';print_r($_POST);
     echo '<pre>';print_r($request->all());
     echo '<pre>';print_r($request->tx);
     echo '<pre>';print_r($_GET);
     echo '<pre>';print_r($_REQUEST);die;
    
    //return view('admin.products.pay');
        
    }
       /**
 * Show the form for creating a new resource.
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function success(Request $request)
    {

    //echo '<pre>';print_r($_POST);
     echo '<pre>';print_r($request->all());

     echo '<pre>';print_r($_GET);
     echo '<pre>';print_r($_REQUEST);
    die('success');
    //return view('admin.products.pay');
        
    }

}
