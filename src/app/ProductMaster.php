<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductMaster extends Model
{
    protected $fillable = [
        'product_name',
        'price',
    ];

    public function stocks()
    {
        return $this->hasOne('App\Stock');
    }

    public function saleslogs()
    {
        return $this->hasOne('App\SalesLog');
    }

    public $timestamps = false;
}
