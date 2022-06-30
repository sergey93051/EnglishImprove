<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEmail extends Model
{
    use HasFactory;

    protected $fillable=[
        'email',
        'email_verify_hash',
        'email_verified_at',
        'userId'
    ];
}
