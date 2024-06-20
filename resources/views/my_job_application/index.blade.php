<x-layout>

    <x-breadcrumbs class="mb-4" :links="['My Job Application' => '#']" />
    @forelse ($applications as $application)
    <x-job-card :job="$application->job">

        <div class="flex item-center justify-between text-xs text-slate-500">
            <div>
                <div>
                    Applied {{ $application->created_at->diffForHumans() }}
                </div>

                <div>
                    Other {{ Str::plural('Applicant', $application->job->job_applications_count - 1) . " - "
                    .$application->job->job_applications_count -1 }}
                </div>
                <div class="flex space-x-2 items-center ">
                    Your asking Salary &#x20b9 {{ number_format($application->expected_salary) }}
                </div>
                <div>
                    Average asking salary &#x20b9 {{
                    number_format($application->job->job_applications_avg_expected_salary) }}
                </div>
            </div>


            <div>

                @if ($application->status == 'accept')
                <div>
                    Accepted
                </div>
                @elseif($application->status == 'reject')
                <div>
                    Reject
                </div>
                @elseif($application->status == 'under_review')
                <div>
                    Under Review
                </div>
                @else
                <form action="{{ route('my-job-applications.destroy', ['my_job_application' => $application] )}}"
                    method="post">
                    @csrf
                    @method('DELETE')
                    <x-button>Cancel</x-button>

                </form>
                @endif
            </div>
        </div>

    </x-job-card>
    @empty
    <div class="rounded-md border border-dashed border-slate-400 p-10">

        <div class="text-center font-medium">
            You have not applied to any Job
        </div>
        <div class="text-center">
            Go find some jobs <a class="text-indigo-600 hover:underline" href="{{ route('jobs.index')}}"> click here</a>
        </div>
    </div>

    @endforelse

</x-layout>