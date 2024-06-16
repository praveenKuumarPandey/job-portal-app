<x-layout>

    <h1 class="my-16 text-center text-4xl font-medium text-slate-500">Sign into your account</h1>
    <x-card class="py-8 px-16">
        <form action="{{ route('auth.store') }}" method="POST">
            @csrf

            <div class="mb-10">
                <x-label for="email" :required="true">E-Mail</x-label>
                <x-text-input name="email" />
            </div>

            <div class="mb-10">
                <x-label for="password" :required="true">Password</x-label>
                <x-text-input name="password" type='password' />
            </div>

            <div class="mb-8 flex justify-between text-sm font-medium">
                <div>
                    <div class=" flex space-x-2 items-center">
                        <input type="checkbox" name="remember" id="remember" class="rounder-sm border border-slate-400">
                        <label for="remember"> Remember me</label>
                    </div>
                </div>
                <div><a href="#" class="text-indigo-600 hover:underline">Forget Password?</a></div>
            </div>

            <x-button class="w-full bg-green-100"> Login</x-button>


        </form>
    </x-card>
</x-layout>