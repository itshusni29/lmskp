<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToPostTestResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_test_results', function (Blueprint $table) {
            $table->enum('type', ['post', 'remed1', 'remed2'])->default('post')->after('attempted_on');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_test_results', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
