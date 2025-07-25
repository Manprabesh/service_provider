<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


 

class User extends  Model
{

    protected $table='users';
    protected $fillable = [
        'name',      
        'email',
        'password',
    ];

    public function services():BelongsToMany{
        return $this->belongsToMany(Providers::class,'providers_user','user_id', 'provider_id');
    }
  
}
