<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FieldPost extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'field_posts';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    //protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'field_id',
        'option_id',
        'value',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function field()
    {
        return $this->belongsTo(Field::class, 'field_id');
    }

    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id');
    }

    /*
|--------------------------------------------------------------------------
| SCOPES
|--------------------------------------------------------------------------
*/

    public function scopePosts($query, $value)
    {
        return $query->where('post_id', $value)->with('field')->get();

    }
    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
