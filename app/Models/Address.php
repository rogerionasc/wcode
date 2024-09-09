<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_code',
        'street',
        'number',
        'neighborhood',
        'city',
        'state',
        'complement',
        'user_id'
    ];
}
