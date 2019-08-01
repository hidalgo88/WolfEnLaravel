<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  public $table = "product_user";
  public $guarded = [];

  public function product(){
    return $this->belongsTo(Product::class)->orderBy('id');
  }
}
