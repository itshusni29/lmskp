<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_stages', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary Key
            $table->string('name'); // Nama tahap
            $table->text('description')->nullable(); // Deskripsi tahap
            $table->string('banner_image')->nullable(); // Banner image field
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_stages');
    }
}
