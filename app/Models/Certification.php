<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'languages_spoken',
        'certifications',
        'awards',
        'publications',
        'presentations',
        'relevant_activities',
        'hobbies_and_interests',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
