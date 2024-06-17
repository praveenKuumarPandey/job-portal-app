<x-layout>

    <h1 class="my-16 text-center text-4xl font-medium text-slate-500">Register</h1>
    <x-card class="py-8 px-16">
        <form action="{{ route('auth.save-user') }}" method="POST">
            @csrf

            <div class="mb-10">
                <x-label for="name" :required="true">Name</x-label>
                <x-text-input name="name" />
            </div>
            <div class="mb-10">
                <x-label for="email" :required="true">E-Mail</x-label>
                <x-text-input name="email" />
            </div>

            <div class="mb-10">
                <x-label for="password" :required="true">Password</x-label>
                <x-text-input name="password" type='password' />
            </div>



            <x-button class="w-full bg-green-100"> Sign Up</x-button>


        </form>
    </x-card>
</x-layout>