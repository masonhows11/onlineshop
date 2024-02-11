<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeProduct extends Model
{
    use HasFactory;
    protected $table = 'attribute_products';
    protected $fillable = ['product_id','attribute_id','priority','type','values'];



//    protected $casts = [
//        'values' => 'json',
//    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class,'attribute_id');
    }

}
