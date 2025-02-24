<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTestAnswersTable extends Migration
{
    public function up()
    {
        Schema::create('post_test_answers', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id') // Menghubungkan ke tabel users
                  ->constrained('users') // Relasi ke tabel users
                  ->onDelete('cascade'); // Menghapus jawaban jika user dihapus
            $table->foreignId('post_test_question_id') // Menghubungkan ke tabel post_test_questions
                  ->constrained('post_test_questions') // Relasi ke tabel post_test_questions
                  ->onDelete('cascade'); // Menghapus jawaban jika soal dihapus
            $table->string('answer'); // Menyimpan jawaban yang dipilih peserta (misalnya: 'a', 'b', 'c', atau 'd')
            $table->timestamps(); // Menyimpan timestamp untuk created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_test_answers');
    }
}
