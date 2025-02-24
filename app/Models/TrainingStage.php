<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingStage extends Model
{
    use HasFactory;

    protected $table = 'training_stages';

    protected $fillable = [
        'name',
        'description',
        'banner_image',
    ];

    // Relasi dengan TrainingClass
    public function trainingClasses()
    {
        return $this->hasMany(TrainingClass::class, 'training_stage_id');
    }

    public function getBannerImageUrlAttribute()
    {
        return $this->banner_image ? asset('storage/' . $this->banner_image) : null;
    }
}
