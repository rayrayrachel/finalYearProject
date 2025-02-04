<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInformation extends Model
{
    use HasFactory;


    protected $fillable = [
        'full_name',
        'title',
        'phone_number',
        'email',
        'linkedin_profile',
        'portfolio_website',
        'location',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
