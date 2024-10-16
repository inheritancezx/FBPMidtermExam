<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'course_id', 'category_id', 'est_price', 'content'];

    public function course(): BelongsTo {
        return $this->belongsTo(Course::class);
    }

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }
}
