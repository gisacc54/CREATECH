<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'push_notification',
        'sms_notification',
        'email_notification',
    ];
}
