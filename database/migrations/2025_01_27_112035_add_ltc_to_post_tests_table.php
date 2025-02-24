<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLtcToPostTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_tests', function (Blueprint $table) {
            $table->enum('ltc', ['aluminium', 'steel', 'common'])->default('common')->after('end_time'); // Adding the ltc column with default value
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
            $table->dropColumn('ltc'); // Remove the ltc column if rolling back
        });
    }
}
