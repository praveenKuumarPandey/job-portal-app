<x-layout>

    <x-breadcrumbs :links="['Recommended Jobs' => '#']" class="mb-4" />
    @forelse ($recomendedJobs as $recomendedJob)
    <x-job-card :job="$recomendedJob['job']">
        <div class="flex  justify-between text-center">
            <div class="my-4">

                <x-link-button :href="route('jobs.show', $recomendedJob['job'])">
                    see more
                </x-link-button>
            </div>
            <div class="my-4 text-sm font-medium">
                <div>{{implode(', ', $recomendedJob['skillMatched'])}}</div>
                <div>{{ $recomendedJob['skillMatchCount'] ." ". Str::plural('Skill', $recomendedJob['skillMatchCount'])
                    ." Matched"}}
                </div>

            </div>
        </div>

    </x-job-card>
    @empty
    <div class="rounded-md border border-dashed  border-slate-300 p-8">
        <div class="text-center font-medium">
            NO Job To Recommend Now
        </div>
    </div>
    @endforelse


</x-layout>