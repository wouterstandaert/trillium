<?php

namespace App\Models;

use App\Models\ProductTranslation;
use App\Models\ProductModel;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function translations()
    {
        return $this->belongsTo(ProductTranslation::class, 'id', 'product_id')->where('language_id', '=', 1); // @todo: make the language id dynamic
    }


    public function model()
    {
        return $this->hasOne(ProductModel::class, 'id', 'product_model_id');
    }
}