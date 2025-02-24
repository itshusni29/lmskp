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
        Schema::table('post_test_results', function (Blueprint $table) {
            $table->string('grade')->nullable()->after('score'); // Menambahkan kolom grade setelah kolom score
        });
    }

    public function down()
    {
        Schema::table('post_test_results', function (Blueprint $table) {
            $table->dropColumn('grade'); // Menghapus kolom grade jika migrasi dibatalkan
        });
    }
};
