<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['skill_name', 'description'];

    public function jobSeekers()
    {
        return $this->belongsToMany(JobSeeker::class, 'job_seeker_skills')->withTimestamps();
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_skills')->withTimestamps();
    }

    public function course()
    {
        return $this->belongsToMany(Course::class, 'course_skill')->withTimestamps();
    }

}
