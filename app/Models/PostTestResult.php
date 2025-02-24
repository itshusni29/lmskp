<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTestResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_test_id',
        'score',
        'is_passed',
        'attempted_on',
        'type',
        'grade'
    ];

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship to the PostTest model
    public function postTest()
    {
        return $this->belongsTo(PostTest::class);
    }
}


