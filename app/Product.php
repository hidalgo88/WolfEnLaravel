<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Size;
use App\Brand;
use App\League;


class Product extends Model
{
  protected $table = 'products';
  protected $fillable = ['name', 'price', 'description', 'size_id', 'league_id', 'brand_id', 'imgProduct'];

  public function size()
  {
    return $this->belongsTo(Size::class);
  }
  public function brand()
  {
    return $this->belongsTo(Brand::class);
  }
  public function league()
  {
    return $this->belongsTo(League::class);
  }

}
