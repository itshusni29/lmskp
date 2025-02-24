<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_modules', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('title'); // Title of the training module
            $table->text('content'); // Content of the training module (could be rich text)
            $table->string('image_path')->nullable(); // Optional image path for the module
            $table->foreignId('training_class_id') // Foreign key to the training_classes table
                  ->constrained() // Automatically references 'id' on 'training_classes' table
                  ->onDelete('cascade'); // Deletes modules if the corresponding training class is deleted
            $table->foreignId('creator_id') // Foreign key to the users table (creator of the module)
                  ->constrained('users') // Explicitly mentions the 'users' table for the foreign key
                  ->onDelete('cascade'); // Deletes module if the user (creator) is deleted
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_modules'); // Drops the training_modules table if it exists
    }
}
