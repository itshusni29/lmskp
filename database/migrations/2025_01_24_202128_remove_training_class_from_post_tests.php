<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTrainingClassFromPostTests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_tests', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['training_class_id']);
            
            // Drop the column
            $table->dropColumn('training_class_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_tests', function (Blueprint $table) {
            // Add the column back
            $table->foreignId('training_class_id')->constrained()->onDelete('cascade');
        });
    }
}
