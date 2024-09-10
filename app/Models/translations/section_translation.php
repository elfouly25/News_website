<?php

namespace App\Models\translations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Section;

class section_translation extends Model
{
    use HasFactory;
    public $fillable = [
        "title",
        "section_id",
        "languageCode"
    ];

    public function section(){
        return $this->belongsTo(Section::class);
    }
}
