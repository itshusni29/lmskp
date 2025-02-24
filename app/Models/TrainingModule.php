<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'image_path', 'training_class_id', 'creator_id'
    ];

    public function trainingClass()
    {
        return $this->belongsTo(TrainingClass::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
