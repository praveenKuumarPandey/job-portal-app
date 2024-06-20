<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->authorize('viewAny', Job::class);
        $filters = request()->only(
            'Search',
            'min_salary',
            'max_salary',
            'experience',
            'category',
        );
        // $job = Job::query()->filter();
        //-> // $job = Job::filter();

        // dd(request('experience'));

        return view('job.index', ["jobs" => Job::with('employer')->filter($filters)->latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $this->authorize('view', $job);

        $jobWSkills = $job->with('skills');
        $jobSeeker = auth()->user()->jobSeeker;

        $jobSeekerSkills = $jobSeeker->skills->puck('id')->toArray();
        $missingSkills = $job->skills->whereNotIn('id', $jobSeekerSkills);

        // $recommendedCourses = Course::whereHas('skills',);

        return view('job.show', ["job" => $job->load('employer.jobs')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
