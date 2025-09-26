<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id');
    }
}
