<x-layout>


    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('jobs.index')]" />

    <x-card class="mb-4 text-sm" x-data="">
        <form x-ref="filters" id="filter-form" action="{{ route('jobs.index') }}" method="GET">

            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <div class="mb-1 font-semibold"> Search</div>
                    <x-text-input name="Search" value="{{ request('Search') }}" placeholder="Search for any text"
                        formRef="filters">
                    </x-text-input>

                </div>
                <div>
                    <div class="mb-1 font-semibold"> Salary</div>
                    <div class="flex space-x-2">
                        <x-text-input name="min_salary" value="{{ request('min_salary') }}" placeholder="From"
                            formRef="filters">
                        </x-text-input>
                        <x-text-input name="max_salary" value="{{ request('max_salary') }}" placeholder="To"
                            formRef="filters">
                        </x-text-input>
                    </div>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Experience</div>


                    <x-radio-list-group name="experience" :options="array_combine(
                        array_map('ucfirst', \App\Models\Job::$experience),
                        \App\Models\Job::$experience,
                    )" />





                </div>
                <div>
                    <div class="mb-1 font-semibold">Category</div>
                    <x-radio-list-group name="category" :options="array_combine(
                        array_map('ucfirst', \App\Models\Job::$category),
                        \App\Models\Job::$category,
                    )" />


                </div>
            </div>
            <x-button class="w-full"> Filter</x-button>

        </form>
    </x-card>

    @foreach ($jobs as $job)
        <x-job-card :job="$job">
            <div class="my-2">

                <x-link-button :href="route('jobs.show', $job)">
                    see more
                </x-link-button>
            </div>
        </x-job-card>
    @endforeach
</x-layout>
