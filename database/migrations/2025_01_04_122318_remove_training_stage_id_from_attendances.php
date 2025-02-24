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
        Schema::table('attendances', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign('attendances_training_stage_id_foreign'); // Replace with the correct foreign key constraint name
    
            // Drop the training_stage_id column
            $table->dropColumn('training_stage_id');
        });
    }
    
    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            // Re-add the training_stage_id column
            $table->foreignId('training_stage_id')->constrained('training_stages'); // Re-add the foreign key
        });
    }
    
    
};
