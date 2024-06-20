<x-layout>

    <h1 class="my-16 text-center text-4xl font-medium text-slate-500">Register</h1>
    <x-card class="py-8 px-16">
        <div class=" my-2 p-2 text-center space-x-2 text-lg font-medium bold text-slate-700">
            Job Seeker Registration. <div class="text-sm font-medium"> Employer? <a
                    class="text-indigo-500 hover:underline" href="{{ route('auth.employer-register')}}">Register
                    Here</a></div>

        </div>
        <form action="{{ route('auth.save-user') }}" method="POST" class="grid grid-cols-2 space-x-3">
            @csrf

            <div class="mb-6 ">
                <x-label for="name" :required="true">Name</x-label>
                <x-text-input name="name" />
            </div>
            <div class="mb-6 ">
                <x-label for="email" :required="true">E-Mail</x-label>
                <x-text-input name="email" />
            </div>
            <div class="mb-6 col-span-2">
                <x-label for="password" :required="true">Password</x-label>
                <x-text-input name="password" type='password' />
            </div>

            <div class="mb-6 col-span-2">
                <x-label for="skills" :required="true">Skills</x-label>

                <select size="3" multiple name="skills[]" id="skills"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ">
                    @foreach($skills as $skill)
                    <option value="{{ $skill->id }}">{{ $skill->skill_name }}</option>
                    @endforeach
                </select>
                @error('skills')
                <div class="mt-1 text-xs text-red-500">
                    {{ $message}}
                </div>
                @enderror
            </div>

            <div class="mb-6">
                <x-label for="phone" :required="true">phone</x-label>
                <x-text-input name="phone" />
            </div>

            <div class="mb-6">
                <x-label for="education_details" :required="true">Education</x-label>
                <x-text-input name="education_details" />
            </div>
            <div class="mb-6 col-span-2">
                <x-label for="address">Address</x-label>
                <x-text-input name="address" />
            </div>

            <x-button class="w-full col-span-2 bg-green-100"> Sign Up</x-button>


        </form>
    </x-card>
</x-layout>