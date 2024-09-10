<?php

namespace App\Models;

use App\Models\translations\section_translation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'order']; // Include 'order' in the fillable array

    public function translation(){
        return $this->hasMany(section_translation::class);
    }
}