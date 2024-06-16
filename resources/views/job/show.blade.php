<x-layout>

    <x-breadcrumbs class="mb-4" :links="['Job' => route('jobs.index'), $job->title => '#']" />

    <x-job-card :job="$job">
        <p>{!! nl2br(e($job->description)) !!}</p>

        @can('apply', $job)
        <div class="my-2">
            <x-link-button :href="route('job.application.create', $job)">
                Apply
            </x-link-button>
        </div>
        @else
        <div class="text-center text-sm font-medium text-slate-500 my-2"> You have already Applied!
        </div>
        @endcan
    </x-job-card>

    <x-card class="mb-4">
        <h2 class="mb-4 text-lg font-medium">
            More {{ $job->employer->company_name }} Jobs
        </h2>
        <div class="text-sm text-slate-500">

            @foreach ($job->employer->jobs as $emplrJob)
            <div class="mb-4 flex justify-between">
                <div>
                    <div class="text-slate-700"><a href="{{ route('jobs.show', $emplrJob)}}">{{ $emplrJob->title }}</a>
                    </div>
                    <div class="text-xs">
                        {{ $emplrJob->created_at->diffForHumans() }}
                    </div>
                </div>
                <div class="text-xs">
                    ${{ number_format($emplrJob->salary) }}
                </div>
            </div>


            @endforeach
        </div>
    </x-card>

</x-layout>