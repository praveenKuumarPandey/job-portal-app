<x-layout>
    <h1 class="my-16 text-center text-4xl font-medium text-slate-500">Register</h1>
    <x-card class="py-10 px-16">

        <div class=" my-2 p-2 text-center space-x-2 text-lg font-medium bold text-slate-700">
            Job Seeker Registration. <div class="text-sm font-medium"> Job Seeker? <a
                    class="text-indigo-500 hover:underline" href="{{ route('auth.register')}}">Register
                    Here</a></div>

        </div>

        <form action="{{ route('auth.save-employer')}}" method="post" class="grid grid-cols-2 space-x-3">
            @csrf


            <div class="mb-6 ">
                <x-label for="name" :required="true">Contact Name</x-label>
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
                <x-label for="company_name" :required="true">Company Name</x-label>
                <x-text-input name="company_name" />
            </div>
            <x-button class="w-full col-span-2 bg-green-100">Create</x-button>
        </form>
    </x-card>
</x-layout>