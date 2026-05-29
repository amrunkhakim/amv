<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'category',
        'title',
        'description',
        'image_path',
        'link',
        'sort_order',
    ];
}
