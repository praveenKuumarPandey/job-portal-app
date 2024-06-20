<x-layout>

    <x-breadcrumbs class="mb-4"
        :links="['Suggested Candidates' => route('employer.suggestedCandidates'), $jobSeeker->user->name => '#']" />

    <x-job-seeker-card :jobSeeker="$jobSeeker">

    </x-job-seeker-card>

    <x-card class="mb-4">
        <h2 class="mb-4 text-lg font-medium">
            Candidate Skills
        </h2>
        <div class="text-sm text-slate-500">
            @forelse($jobSeeker->skills as $skill)

            <div class="flex justify-between text-center font-medium my-2 p-3">
                <div>{{$skill->skill_name}}</div>
                <div>{{$skill->description}}</div>
            </div>

            @empty

            <div>
                No Skill to display
            </div>

            @endforelse
        </div>
    </x-card>

</x-layout>