<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public $timestamps = false;

    protected $fillable = ['value', 'parent_id'];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
