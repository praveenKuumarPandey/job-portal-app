<x-layout>

    <x-breadcrumbs :links="['My Jobs'=> route('my-jobs.index'), $job->title => '#']" class="mb-4" />


    <x-job-card :job="$job">
        <p>{!! nl2br(e($job->description)) !!}</p>

    </x-job-card>

    <x-card class="mb-4">
        <h2 class="mb-4 text-lg font-medium">
            Job Application
        </h2>
        <div class="text-sm text-slate-500">

            @forelse ($job->jobApplications as $jobApplication)
            <div class="mb-4 flex justify-between">
                <div>
                    <div class="text-slate-700"><a
                            href="{{ route('job.application.show', ['job'=> $job, 'application'=> $jobApplication])}}">{{
                            $jobApplication->user->name }}</a>
                    </div>
                    <div class="text-xs">
                        {{ $jobApplication->created_at->diffForHumans() }}
                    </div>
                </div>
                <div class="text-xs">
                    ${{ number_format($jobApplication->expected_salary) }}
                </div>
            </div>
            @empty
            <div class="text-center font-medium">
                No Job Application recived yet.
            </div>

            @endforelse
        </div>
    </x-card>

</x-layout>