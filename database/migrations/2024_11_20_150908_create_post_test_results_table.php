<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTestResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');  // Foreign key to User
            $table->foreignId('post_test_id')->constrained('post_tests')->onDelete('cascade');  // Foreign key to PostTest
            $table->float('score');  // User's score for the test
            $table->boolean('is_passed');  // Whether the user passed the test or not
            $table->timestamp('attempted_on')->nullable();  // Timestamp when the test was attempted
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
        Schema::dropIfExists('post_test_results');
    }
}
