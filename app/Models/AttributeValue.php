<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    protected $table = 'attribute_values';


    protected $fillable = [
        'attribute_id','priority','value',
    ];

    protected $casts = [
        'attribute_id' => 'integer',
    ];

    // one to many reverse with Attribute model
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
