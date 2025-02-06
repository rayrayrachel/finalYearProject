<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;


    protected $fillable = [
        'job_id', 
        'user_id', 
        'cover_letter', 
        'status'];

    public function job()
    {
        return $this->belongsTo(JobPost::class, 'job_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'hunter_id');
    }

    public function cV()
    {
        return $this->hasOne(CV::class);
    }
}
