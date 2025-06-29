<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'age',
        'email_address',
        'phone_number',
       'emergency_contact',
        'photo',
    ];
}
