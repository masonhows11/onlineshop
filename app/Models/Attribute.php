<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $table = 'attributes';

    protected $fillable = [
        'code','name', 'type','priority','has_default_value','category_id','is_filterable', 'is_required'
    ];


    protected $casts = [
        'is_filterable' => 'boolean',
        'is_required' => 'boolean',
    ];

    // one to many with AttributeValue model
    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function getTypeValueAttribute()
    {
        switch ($this->type) {
            case 'select':
                $result = 'Select_box';
                break;
            case 'radio':
                $result = 'Radio_button';
                break;
            case 'text_box':
                $result = 'Text_Box';
                break;
            case 'text_area':
                $result = 'Text_Area';
                break;
            default:
                $result = 'Text_Box';

        }
        return $result;
    }
}
