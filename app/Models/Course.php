<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    public function foods(): HasMany {
        return $this->hasMany(Food::class, 'course_id');
    }

    public function recipes(): HasMany {
        return $this->hasMany(Recipe::class, 'course_id');
    }
}
