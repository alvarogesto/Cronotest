<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer',
        'question_id',
        'correct',
    ];

    protected $casts = [
        'correct' => 'boolean',
    ];
    
    // Establece una relación entre Answer y Question
    public function question() {
        return $this->belongsTo(Question::class);      
    }
}
