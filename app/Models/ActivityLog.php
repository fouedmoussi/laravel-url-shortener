<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_log';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'access_date_time', 'visited_link', 'ip_address', 'country', 'user_agent', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
