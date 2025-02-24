<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBannerImageToTrainingClassesTable extends Migration
{
    public function up()
    {
        Schema::table('training_classes', function (Blueprint $table) {
            $table->string('banner_image')->nullable(); // Add the image column
        });
    }

    public function down()
    {
        Schema::table('training_classes', function (Blueprint $table) {
            $table->dropColumn('banner_image'); // Drop the image column if rolling back
        });
    }
}
