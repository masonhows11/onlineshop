<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryAttribute extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'category_attributes';
    protected $fillable = [
        'title',
        'type',
        'unit',
        'category_id'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // each category attribute might have multi value
    public function values()
    {
        return $this->hasMany(CategoryAttributeValue::class);
    }
}
