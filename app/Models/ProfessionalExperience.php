<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfessionalExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_title',
        'company_name',
        'location',
        'start_date',
        'end_date',
        'key_achievements',
        'quantifiable_results',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
