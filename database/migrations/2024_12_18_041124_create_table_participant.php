<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id(); // Primary key, auto-increment
            $table->string('code', 10); // VARCHAR(10)
            $table->string('full_name', 255); // VARCHAR(255)
            $table->unsignedBigInteger('id_team'); // INT for id_team
            $table->unsignedBigInteger('id_dinner_table'); // INT for id_dinner_table
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
};
