<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('sub_admins', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('email')->unique(); // Unique email column
            $table->string('password'); // Password column
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_admins'); // Drop the table if it exists
    }
}