<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    public function foods(): HasMany {
        return $this->hasMany(Food::class, 'category_id');
    }

    public function recipes(): HasMany {
        return $this->hasMany(Recipe::class, 'category_id');
    }
}
