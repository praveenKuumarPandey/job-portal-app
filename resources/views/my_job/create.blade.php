<x-layout>

    <x-breadcrumbs :links="['My Jobs' => route('my-jobs.index'), 'Create' => '#']" class="mb-4" />

    <h1 class="w-full text-lg bg-white p-4 text-center  rounded-md font-medium my-4">Create a Job</h1>

    <x-card class="mb-8">
        <form action="{{ route('my-jobs.store') }}" method="post">
            @csrf

            <div class="mb-4 grid grid-cols-2 gap-5">
                <div>
                    <x-label for="title" :required="true"> Job Title</x-label>
                    <x-text-input name="title" placeholder="Enter Job Title" />
                </div>

                <div>
                    <x-label for="location" :required="true"> Job location</x-label>
                    <x-text-input name="location" placeholder="Enter Job location" />
                </div>
                <div class="col-span-2">
                    <x-label for="salary" :required="true"> Salary</x-label>
                    <x-text-input name="salary" type="number" placeholder="Enter salary" />
                </div>

                <div class="col-span-2">
                    <x-label for="description" :required="true"> Description</x-label>
                    <x-text-input name="description" type="textarea" placeholder="Enter Job Description" />
                </div>

                <div>
                    <x-label for="experience" :required="true"> Experience</x-label>
                    <x-radio-list-group
                        :options="array_combine(array_map('ucfirst', \App\Models\Job::$experience), \App\Models\Job::$experience)"
                        name="experience" :value="old('experience')" :allOption="false" />
                </div>

                <div>
                    <x-label for="category" :required="true"> category</x-label>
                    <x-radio-list-group name="category"
                        :options="array_combine(array_map('ucfirst', \App\Models\Job::$category), \App\Models\Job::$category)"
                        :value="old('category')" :allOption="false" />
                </div>

                <div class="col-span-2">
                    <x-button class="w-full bg-green-100">Create Job</x-button>
                </div>
            </div>

        </form>
    </x-card>
</x-layout>