<x-layout.layout>
    <x-form.form title="Login" description="Sign in to your account">
        <form action="{{ url('/login') }}" method="POST" class="mt-5 grid w-full max-w-md gap-5 p-8 rounded-lg shadow-md">
            @csrf
            <x-form.field name="email" label="Email" type="email" />
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
            <x-form.field name="password" label="Password" type="password" />
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
            <button type="submit" class="btn w-full h-14">Login</button>
        </form>
    </x-form.form>
</x-layout.layout>
