<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTestAnswer extends Model
{
    use HasFactory;

    // Tentukan tabel yang digunakan
    protected $table = 'post_test_answers';

    // Kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'user_id',
        'post_test_question_id',
        'answer',
        'is_correct',
        'type', // Tambahkan kolom type di sini
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke PostTestQuestion
     */
    public function postTestQuestion()
    {
        return $this->belongsTo(PostTestQuestion::class);
    }
}
