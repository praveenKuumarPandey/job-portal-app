<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(Job $job)
    {
        $this->authorize('apply', $job);
        return view('job_application.create', ['job' => $job]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Job $job, Request $request)
    {

        $this->authorize('apply', $job);

        $validatedData = $request->validate([
            'expected_salary' => 'required|min:1|max:1000000',
            'cv' => 'required|file|mimes:pdf|max:2048'
        ]);

        $file = $request->file('cv');
        $path = $file->store('cvs', 'private');


        $job->jobApplications()->create([
            'user_id' => $request->user()->id,
            'expected_salary' => $validatedData['expected_salary'],
            'cv_path' => $path

        ]);


        return redirect()->route('jobs.show', $job)->with('success', 'Job Application Submitted.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job, JobApplication $application)
    {


        $application->update([
            'status' => 'under_review',
        ]);
        return view('job_application.show', ['job' => $job, 'jobApplication' => $application]);
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

    public function updateState(Request $request, Job $job, JobApplication $application)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:accept,reject,under_review',
            // Add other query parameters you want to validate
        ]);


        // dd($validatedData, $application, $request);

        $application->update([
            'status' => $validatedData['status']
        ]);
        return redirect()->back()->with("success", "Job Application updated");
    }
}
