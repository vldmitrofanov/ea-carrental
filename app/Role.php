<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $table = 'roles';

    public function users() {
        return $this->belongsToMany('App\User', 'role_user');
    }
}
