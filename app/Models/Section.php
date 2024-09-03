<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    // Specify the fillable attributes
    protected $fillable = ['title', 'order']; // Include 'order' in the fillable array
}