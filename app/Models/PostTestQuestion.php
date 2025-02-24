<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTestQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_test_id',
        'question',        // Pertanyaan untuk soal pilihan ganda
        'option_a',        // Pilihan A
        'option_b',        // Pilihan B
        'option_c',        // Pilihan C
        'option_d',        // Pilihan D
        'correct_answer',  // Jawaban yang benar
    ];

    // Relasi ke PostTest
    public function postTest()
    {
        return $this->belongsTo(PostTest::class);
    }
        // Relasi ke PostTestAnswer
    public function answers()
    {
        return $this->hasMany(PostTestAnswer::class);
    }
}
