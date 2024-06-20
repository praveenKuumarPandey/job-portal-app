<x-layout>

    <x-breadcrumbs :links="['Suggested Candidates' => '#']" class="mb-4" />
    @forelse ($recomendedCandidates as $recomendedCandidate)
    <x-job-seeker-card :jobSeeker="$recomendedCandidate['jobSeeker']">
        <div class="flex  justify-between text-center">

            <div class="my-4 text-sm font-medium text-slate-500">
                <div>{{implode(', ', $recomendedCandidate['skillMatched'])}}</div>
                <div>{{ $recomendedCandidate['skillMatchCount'] ." ". Str::plural('Skill',
                    $recomendedCandidate['skillMatchCount'])
                    ." Matched"}}
                </div>
                <div class="my-4">
                    <x-link-button class="" :href="route('job-seeker.show', $recomendedCandidate['jobSeeker'])">
                        View Candidate
                    </x-link-button>
                </div>

            </div>
            <div clas="my-4 text-sm font-medium">


                <div class="my-2 font-medium text-sm text-slate-500">Suggested for {{
                    $recomendedCandidate['jobMatchedCount'] ." ".
                    Str::plural('Job',
                    $recomendedCandidate['jobMatchedCount'])
                    }}
                </div>
                <div class=" my-2 space-x-2 font-medium text-sm text-slate-500">
                    @foreach($recomendedCandidate['jobMatched']
                    as $jobMatched)
                    <div>{{$jobMatched->title}}</div>
                    @endforeach
                </div>


            </div>
        </div>

    </x-job-seeker-card>
    @empty
    <div class="rounded-md border border-dashed  border-slate-300 p-8">
        <div class="text-center font-medium">
            NO Candidate To Recommend Now
        </div>
    </div>
    @endforelse


</x-layout>