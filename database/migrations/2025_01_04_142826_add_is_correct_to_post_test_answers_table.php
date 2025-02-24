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
            $table->boolean('is_correct')->default(false); // menambahkan kolom 'is_correct' yang default-nya false
        });
    }
    
    public function down()
    {
        Schema::table('post_test_answers', function (Blueprint $table) {
            $table->dropColumn('is_correct');
        });
    }
    
};
