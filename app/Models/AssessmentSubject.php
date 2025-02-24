<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentSubject extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'assessment_id', 'subject', 'score'
    ];

    /**
     * Relationships
     */

    // Relasi ke Assessment
    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
}
