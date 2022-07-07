<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwoFactor extends Model
{
    use HasFactory;

    protected $fillable= [ 'userId' , 'ip' , 'secret'];

    public function emails()
    {
        return $this->hasManyThrough(UserEmail::class,User::class,'id','userId','userId','id');
    }
}
