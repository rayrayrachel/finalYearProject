<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'requirements',
        'salary_range',
        'location'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function application()
    {
        return $this->hasOne(Application::class);
    }
}
