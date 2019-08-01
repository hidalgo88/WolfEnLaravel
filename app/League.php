<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
  public function products()
  {
    return $this->hasMany(Product::class)->orderByDesc('id');
  }
}
