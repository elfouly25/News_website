<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('section_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title', 350);
            $table->string('languageCode', 10);
            $table->foreignId('section_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('section_translations');
    }
}