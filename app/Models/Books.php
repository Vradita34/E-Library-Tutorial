<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Books extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'book_category','book_id','category_id');
    }


    public function review() : HasMany
    {
        return $this->hasMany(Reviews::class);
    }
}
