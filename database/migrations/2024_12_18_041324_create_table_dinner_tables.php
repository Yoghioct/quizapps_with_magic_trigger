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
        Schema::create('dinner_tables', function (Blueprint $table) {
            $table->id(); // Primary key, auto-increment
            $table->string('nama_table', 255); // VARCHAR(255) for table name
            $table->integer('nomor_table'); // INT for table number
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
        Schema::dropIfExists('dinner_tables');
    }
};
