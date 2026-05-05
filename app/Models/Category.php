<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
    ];

    /**
     * Get all products in this category.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
