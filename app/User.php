<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Carbon\Carbon;
use File;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {
    use Notifiable, Authenticatable, CanResetPassword, EntrustUserTrait;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y h:i A');
    }

    public function roles() {
        return $this->belongsToMany('App\Role', 'role_user', 'user_id');
    }
    
    public function passport(){        
        if ($this->passport_id!='' && File::exists(storage_path().'/app/'. $this->passport_id)){
            return asset(str_replace('public/', 'storage/', $this->passport_id));
        }else{
            return '';
        }
    }
    
    public function licence(){        
        if ($this->driver_licence!='' && File::exists(storage_path().'/app/'. $this->driver_licence)){
            return asset(str_replace('public/', 'storage/', $this->driver_licence));
        }else{
            return '';
        }
    }
    
    public function rentalForm(){        
        if ($this->rental_form!='' && File::exists(storage_path().'/app/'. $this->rental_form)){
            return asset(str_replace('public/', 'storage/', $this->rental_form));
        }else{
            return '';
        }
    }
}
