<x-layout>

    <x-breadcrumbs :links="[
        'My Jobs' => route('my-jobs.index'),
        $job->title => route('my-jobs.show', ['my_job' => $job]),
        'Job Application-' . $jobApplication->user->name => '#',
    ]" class="mb-4" />




    <x-job-seeker-card :jobSeeker="$jobApplication->user->jobSeeker">

        <div class="flex item-center justify-between text-xs text-slate-500">
            <div class="my-2 flex flex-col space-y-2 font-medium">


                <div class="flex space-x-2 items-center ">
                    Expected Salary &#x20b9 {{ number_format($jobApplication->expected_salary) }}
                </div>
                <div>
                    Average asking salary &#x20b9
                    {{ number_format($jobApplication->job->job_applications_avg_expected_salary) }}
                </div>
                <div>
                    Applied {{ $jobApplication->created_at->diffForHumans() }}
                </div>
            </div>
            {{-- {{ dd($jobApplication->status)}} --}}
            <div class="flex space-x-2 my-4 items-end">
                @if ($jobApplication->status == 'accept')
                    <div>
                        Accepted
                    </div>
                @elseif($jobApplication->status == 'reject')
                    <div>
                        Denied
                    </div>
                @else
                    <div class="text-center my-2">
                        <div class="mb-4">
                            Viewed
                        </div>
                        <div class="flex space-x-2">
                            <div>
                                <x-link-button :href="route('job.application.updateState', [
                                    'job' => $job,
                                    'application' => $jobApplication,
                                    'status' => 'accept',
                                ])">
                                    Accept
                                </x-link-button>
                            </div>
                            <div>
                                <x-link-button :href="route('job.application.updateState', [
                                    'job' => $job,
                                    'application' => $jobApplication,
                                    'status' => 'reject',
                                ])">
                                    Deny
                                </x-link-button>
                            </div>
                        </div>

                    </div>
                @endif

            </div>
        </div>
    </x-job-seeker-card>

    <x-card class="mb-4">
        <h2 class="mb-4 text-lg font-medium">
            Candidate Skills
        </h2>
        <div class="text-sm text-slate-500">
            @forelse($jobApplication->user->jobSeeker->skills as $skill)
                <div class="flex justify-between text-center font-medium my-2 p-3">
                    <div>{{ $skill->skill_name }}</div>
                    <div>{{ $skill->description }}</div>
                </div>

            @empty

                <div>
                    No Skill to display
                </div>
            @endforelse
        </div>
    </x-card>
</x-layout>
