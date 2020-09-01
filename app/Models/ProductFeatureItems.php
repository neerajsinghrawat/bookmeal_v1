<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFeatureItems extends Model
{
     protected $table = 'product_feature_items';
 
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['product_feature_items'];

    public function productFeature()
    {
        return $this->belongsTo('App\Models\ProductFeature');
    }    
}
