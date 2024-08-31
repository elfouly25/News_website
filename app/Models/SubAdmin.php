<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubAdmin extends Model
{
    use HasFactory;

    protected $table = 'sub_admins'; // Specify the table name

    protected $fillable = ['email', 'password']; // Specify the fillable fields
}