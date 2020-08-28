<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductFeature;
use Session;
class ProductFeaturesController extends Controller
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
        $testimonials = ProductFeature::OrderBy('created_at','DESC')->paginate(10);
        return view('admin.productFeatures.index',["testimonials" => $testimonials]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */     
     public function add()
    {
        
        return view('admin.productFeatures.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //echo '<pre>';print_r($request->all());die;
        $testimonial = new ProductFeature;

        $testimonial->value = trim($request->name);
        $testimonial->status = ($request->status == 'on')?1:0;

        if($testimonial->save()){
            Session::flash('success','ProductFeature Save successfully');
            }else{
                Session::flash('error','Please try again.');
            }
        return \Redirect::to('admin/productFeatures');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //die($id);
        $testimonials = ProductFeature::find($id);
       
        return view('admin.productFeatures.edit',["testimonials" => $testimonials]);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //die($request->file('image'));
        $testimonial = ProductFeature::find($id);
        
       	$testimonial->value = trim($request->name);
        $testimonial->status = ($request->status == 'on')?1:0;

        if($testimonial->save()){
            Session::flash('success','ProductFeature Update successfully');
            }else{
                Session::flash('error','Please try again.');
            }
        return \Redirect::to('admin/productFeatures');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //die('sdfdsf');
        $testimonial = ProductFeature::find($id);    
        
        if($testimonial->delete()){
            Session::flash('success','ProductFeature Delete successfully');
            }else{
                Session::flash('error','Please try again.');
            }
        return \Redirect::to('admin/productFeatures');
    }
}
