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
        Schema::table('post_test_answers', function (Blueprint $table) {
            $table->enum('type', ['post', 'remed1', 'remed2'])->default('post')->after('answer');
        });
    }
    
    public function down()
    {
        Schema::table('post_test_answers', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
    
};
