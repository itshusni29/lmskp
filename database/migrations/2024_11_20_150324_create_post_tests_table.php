<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tests', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Name of the PostTest
            $table->foreignId('training_class_id')->constrained()->onDelete('cascade'); // Foreign key to the TrainingClass table
            $table->text('description')->nullable(); // Description of the PostTest
            $table->timestamp('start_time')->nullable(); // Start time of the PostTest
            $table->timestamp('end_time')->nullable(); // End time of the PostTest
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tests');
    }
}
