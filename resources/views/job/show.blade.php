<x-layout>

    <x-breadcrumbs class="mb-4" :links="['Job' => route('jobs.index'), $job->title => '#']" />

    <x-job-card :job="$job">
        <p>{!! nl2br(e($job->description)) !!}</p>
        @auth
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
        @else
            <div class="text-center text-sm font-medium text-slate-500 my-2">
                Login to Apply <a class="text-indigo-400 hover:underline" href="{{ route('auth.create') }}">click here</a>
            </div>
        @endauth
        @if ($job->skills)
            {{-- {{ dd($job->skills) }} --}}
            <div>Skill Required: </div>
            <div class="my-2 flex space-x-2 text-center font-medium flex-wrap text-sm">
                @foreach ($job->skills as $skill)
                    <x-tag class="w-1/6 my-1">{{ $skill->skill_name }}</x-tag>
                @endforeach
            </div>
        @endif
    </x-job-card>

    @if ($recommendedCourses)
        <x-card class="mb-4">
            <h2 class="mb-4 text-lg font-medium"> Recomended Course to Brige the Gap</h2>

            <div class="text-sm text-slate-500">
                @foreach ($recommendedCourses as $course)
                    <div class="mb-4 flex justify-between text-sm font-medium text-slate-500">
                        <div>
                            <div class="text-slate-700">
                                {{-- {{ route('jobs.show', $course) }} --}}
                                <a href="#">{{ $course->course_name }}</a>
                            </div>
                            <div class="text-xs">
                                {{ $course->created_at && $course->created_at->diffForHumans() }}
                            </div>
                            <div class="text-xs">
                                Covers {{ $course->missing_skills_count }} missing skills
                            </div>
                            <div class="text-xs flex space-x-2">
                                @foreach ($course->missing_skills as $skill)
                                    <div>{{ $skill->skill_name }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <div class="text-xs">
                                {{ $course->educationalInstitution->name }}
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </x-card>
    @endif


    <x-card class="mb-4">
        <h2 class="mb-4 text-lg font-medium">
            More {{ $job->employer->company_name }} Jobs
        </h2>
        <div class="text-sm text-slate-500">

            @foreach ($job->employer->jobs as $emplrJob)
                @if ($job->id !== $emplrJob->id)
                    <div class="mb-4 flex justify-between">
                        <div>
                            <div class="text-slate-700"><a
                                    href="{{ route('jobs.show', $emplrJob) }}">{{ $emplrJob->title }}</a>
                            </div>
                            <div class="text-xs">
                                {{ $emplrJob->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <div class="text-xs">
                            <x-rupee-symbol>{{ number_format($emplrJob->salary) }} </x-rupee-symbol>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </x-card>

</x-layout>
