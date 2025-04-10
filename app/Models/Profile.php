<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_company',
        'user_name',
        'bio',
        'website',
        'profile_picture',
        'location',
        'phone_number',
        'date_of_birth'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
