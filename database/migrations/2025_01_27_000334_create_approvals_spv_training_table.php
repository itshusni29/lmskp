<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovalsSpvTrainingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approvals_spv_training', function (Blueprint $table) {
            $table->id();
            $table->foreignId('training_stage_id')->constrained()->onDelete('cascade'); // Reference to training stage
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Trainee
            $table->foreignId('spv_training_id')->constrained('users')->onDelete('cascade'); // Supervisor
            $table->enum('approval_status', ['pending', 'approved', 'rejected'])->default('pending'); // Approval status
            $table->text('remark')->nullable(); // Remarks or comments
            $table->timestamps(); // Timestamps for created and updated
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approvals_spv_training');
    }
}
