<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('username', 8)->unique();
            $table->string('name', 150);
            $table->string('password');
            $table->string('email')->unique();
            $table->string('department', 150)->nullable();
            $table->string('section', 150)->nullable();
            $table->string('division', 150)->nullable();
            $table->date('date_of_join')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('cc', 5)->nullable();
            $table->string('occupation', 150)->nullable();
            $table->enum('ltc', ['aluminium', 'steel', 'common'])->nullable();
            $table->enum('sex', ['male', 'female']);
            $table->enum('role', ['admin', 'trainer', 'participant']);
            $table->rememberToken();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
