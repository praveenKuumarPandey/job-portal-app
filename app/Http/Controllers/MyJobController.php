<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;
use App\Models\Skill;
use Illuminate\Http\Request;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->authorize('viewAnyEmployer', Job::class);
        return view(
            'my_job.index',
            [
                'jobs' => auth()->user()->employer->jobs()
                    ->with(['employer', 'jobApplications', 'jobApplications.user'])
                    ->withTrashed()
                    ->get()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Job::class);
        $skills = Skill::all();
        return view('my_job.create', ['skills' => $skills]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {

        // dd($request);
        // dd($request->validated());

        $validatedData = $request->validated();
        $jobCreated = auth()->user()->employer->jobs()->create($validatedData);

        $jobCreated->skills()->attach($validatedData['skills']);

        return redirect()->route('my-jobs.index')->with('success', 'Job created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $myJob)
    {
        // dd($myJob);
        return view('my_job.show', ['job' => $myJob]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $myJob)
    {

        $this->authorize('update', $myJob);
        $skills = Skill::all();
        return view('my_job.edit', ['job' => $myJob, 'skills' => $skills]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, Job $myJob)
    {


        // dd($request, $myJob);

        $validatedData = $request->validated();
        $this->authorize('update', $myJob);
        $myjobupdate = $myJob->update($validatedData);

        if ($myjobupdate) {
            $myJob->skills()->attach($validatedData['skills']);
        }


        return redirect()->route('my-jobs.index')->with('success', 'Job updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $myJob)
    {
        $this->authorize('delete', $myJob);
        $myJob->delete();
        return redirect()->route('my-jobs.index')->with('success', 'Job deleted successfully.');

    }
}
