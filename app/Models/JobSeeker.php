<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobSeeker extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'address',
        'education_details',
        'user_id'
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'job_seeker_skills');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
