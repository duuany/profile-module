<?php

namespace Modules\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'avatar'
    ];

    public function user()
    {
        return $this->belongsTo(config('profile.user.model'));
    }
}
