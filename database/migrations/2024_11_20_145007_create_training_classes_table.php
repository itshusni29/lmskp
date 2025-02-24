<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('instructor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->text('description');
            $table->foreignId('training_stage_id')->nullable()->constrained('training_stages')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_classes');
    }
};
