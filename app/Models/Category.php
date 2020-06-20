<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    protected $fillable = ['parent_id', 'name', 'slug', 'active'];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function fields()
    {
        return $this->belongsToMany(Field::class);
    }
}
