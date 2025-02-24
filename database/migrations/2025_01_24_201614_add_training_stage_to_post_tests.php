<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTrainingStageToPostTests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_tests', function (Blueprint $table) {
            $table->foreignId('training_stage_id')->nullable()->constrained('training_stages')->onDelete('cascade')->after('training_class_id');
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
            $table->dropForeign(['training_stage_id']);
            $table->dropColumn('training_stage_id');
        });
    }
}
