<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EssayQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_test_id',
        'question_text',  // Pertanyaan untuk soal essay
        'weight',         // Bobot soal essay
    ];

    // Relasi ke PostTest
    public function postTest()
    {
        return $this->belongsTo(PostTest::class);
    }
}
