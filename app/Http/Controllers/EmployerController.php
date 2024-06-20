<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Employer::class);
    }

    public function create()
    {
        return view('employer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        auth()->user()->employer->create([
            ...$request->validate([
                'company_name' => 'required|min:3|unique:employers,company_name',
            ])
        ]);

        return redirect()->route('jobs.index')->with('success', "Successfully created Employer Account");
    }

    public function suggestedCandidates(Employer $employer)
    {
        // dd("job seeker", auth()->user()->jobSeeker->skills());


        $recomendedCandidates = [];
        $employerJobs = auth()->user()->employer->jobs();
        // dd("employer jobs", $employerJobs);


        $employerJobs->each(function ($jobOpen) use (&$recomendedCandidates) {
            // echo $jobOpen->title . " -" . $jobOpen->id . "<br />";
            $skillsRequired = $jobOpen->skills;
            // dd('skill required - ', $skillsRequired);


            $skillsRequired->each(function ($skillRequired) use (&$recomendedCandidates, $jobOpen) {
                // echo "\t  " . $openJob->title . "<br />";
                // dd($recomendedJobs);

                $prospectiveCandidates = $skillRequired->jobSeekers;
                // dd($prospectiveCandidates);

                $prospectiveCandidates->each(function ($activeCandidate) use (&$recomendedCandidates, $skillRequired, $jobOpen) {

                    $recomendedCandidates[$activeCandidate->id]['jobSeeker'] = $activeCandidate;
                    $recomendedCandidates[$activeCandidate->id]['skillMatched'][] = $skillRequired->skill_name;
                    $recomendedCandidates[$activeCandidate->id]['skillMatched'] = array_unique($recomendedCandidates[$activeCandidate->id]['skillMatched']);
                    $recomendedCandidates[$activeCandidate->id]['skillMatchCount'] = count($recomendedCandidates[$activeCandidate->id]['skillMatched']);

                    $recomendedCandidates[$activeCandidate->id]['jobMatched'][$jobOpen->id] = $jobOpen;


                    $recomendedCandidates[$activeCandidate->id]['jobMatchedCount'] = count($recomendedCandidates[$activeCandidate->id]['jobMatched']);


                    // dd($recomendedCandidates);

                });


            });
            // echo "<br />";
        });

        // dd($recomendedCandidates);

        usort($recomendedCandidates, function ($a, $b) {
            return $b['skillMatchCount'] - $a['skillMatchCount'];
        });

        return view('employer.suggestedCandidates', ['recomendedCandidates' => $recomendedCandidates]);

    }

}
