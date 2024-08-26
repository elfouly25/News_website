<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Creates an unsignedBigInteger primary key
            $table->string('title'); // Title of the post
            $table->text('content'); // Content of the post
            $table->string('writer'); // Writer of the post
            $table->unsignedBigInteger('section_id'); // Foreign key to the sections table
            $table->string('image')->nullable(); // Image related to the post
            $table->timestamps();

            // Set up foreign key relationship with sections table
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
