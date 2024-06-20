<?php

namespace App\Http\Controllers;

use App\Models\JobSeeker;
use Illuminate\Http\Request;

class JobSeekerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(JobSeeker $jobSeeker)
    {
        return view('job_seeker.show', ["jobSeeker" => $jobSeeker]);
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

    public function myRecommendedJobs()
    {
        // dd("job seeker", auth()->user()->jobSeeker->skills());


        $recomendedJobs = [];
        $jobSeekerSkills = auth()->user()->jobSeeker->skills();
        // dd("job seeker skill", $jobSeekerSkills);


        $jobSeekerSkills->each(function ($skillPosses) use (&$recomendedJobs) {
            // echo $skillPosses->skill_name . "<br />";
            $jobsAvailable = $skillPosses->jobs;
            // dd('jobAvailable - ', $jobsAvailable);

            if (isset($jobsAvailable)) {



                $jobsAvailable->each(function ($openJob) use (&$recomendedJobs, $skillPosses) {
                    // echo "\t  " . $openJob->title . "<br />";
                    // dd($recomendedJobs);

                    // $recomendedJobs[$openJob->id] = [ 'job' => $openJob, 
                    $recomendedJobs[$openJob->id]['job'] = $openJob;
                    $recomendedJobs[$openJob->id]['skillMatched'][] = $skillPosses->skill_name;
                    $recomendedJobs[$openJob->id]['skillMatched'] = array_unique($recomendedJobs[$openJob->id]['skillMatched']);
                    $recomendedJobs[$openJob->id]['skillMatchCount'] = count($recomendedJobs[$openJob->id]['skillMatched']);
                    // dd($recomendedJobs);

                });
            }

            // echo "<br />";
        });

        // dd($recomendedJobs);

        usort($recomendedJobs, function ($a, $b) {
            return $b['skillMatchCount'] - $a['skillMatchCount'];
        });

        return view('job_seeker.recomendedJobs', ['recomendedJobs' => $recomendedJobs]);

    }

    public function in_arrayi($needle, $haystack)
    {
        return in_array(strtolower($needle), array_map('strtolower', $haystack));
    }



}
