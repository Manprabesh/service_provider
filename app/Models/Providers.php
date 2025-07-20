<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Providers extends Model
{
    // protected $table = 'services';
    /**
     * Summary of fillable
     * There are 15 fillable
     */
    protected $fillable=['name','email','service_type','price','DOB','town','pincode','photo','distric','review','phone','about','pan_no','adhar_no','session_id','review','experience'];
    
    public function users(): BelongsToMany

    {

        return $this->belongsToMany(User::class)->withTimestamps();

    }
}
