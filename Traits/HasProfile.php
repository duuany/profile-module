<?php
/**
 * Created by PhpStorm.
 * User: jjsquady
 * Date: 9/3/17
 * Time: 2:05 AM
 */

namespace Modules\Profile\Traits;

use Modules\Profile\Models\Profile;

trait HasProfile
{
    public function getRouteKeyName()
    {
        return config('profile.user.route-key-name');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}