<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'hash', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
