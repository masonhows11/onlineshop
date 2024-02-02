<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $table = 'attributes';

    protected $fillable = [
        'code', 'name', 'type','has_default_value','is_filterable', 'is_required'
    ];


    protected $casts = [
        'is_filterable' => 'boolean',
        'is_required' => 'boolean',
    ];

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
