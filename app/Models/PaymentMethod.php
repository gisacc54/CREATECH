<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'methode_type',
        'default',
        'account',
        'name',
        'cvv',
        'month',
        'year',
    ];
}
