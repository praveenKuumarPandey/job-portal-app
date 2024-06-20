<x-card class="mb-4">


    {{-- {{dd($jobSeeker)}} --}}
    <div class="mb-4 flex justify-between">
        <h2 class="text-lg font-medium">{{$jobSeeker->user->name}}</h2>
        <div>{{ $jobSeeker->user->email}}</div>
    </div>

    <div class="mb-4 flex items-center justify-between text-sm text-slate-500 text-center">
        <div>

            <div> {{ $jobSeeker->education_details}}</div>

        </div>
        <div>
            <div> {{ $jobSeeker->phone}}</div>
            <div>{{ $jobSeeker->address}}</div>
        </div>
    </div>

    {{$slot}}
</x-card>