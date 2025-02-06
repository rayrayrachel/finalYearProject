<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CV extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'application_id',
        //'title',
        'contact_information',
        'personal_statement',
        'professional_experiences',
        'educations',
        'skills',
        'certifications'
    ];

    protected $casts = [
        'contact_information' => 'array',
        'personal_statement' => 'array',
        'professional_experiences' => 'array',
        'educations' => 'array',
        'skills' => 'array',
        'certifications' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
