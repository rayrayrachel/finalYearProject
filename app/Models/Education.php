<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'degree',
        'field_of_study',
        'university_name',
        'graduation_date',
        'grade',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
