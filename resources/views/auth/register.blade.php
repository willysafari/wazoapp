<x-layout.layout>
    <x-form.form title="Register" description="Create a new account">
        <form action="{{ url('/register') }}" method="POST" class="mt-5 grid w-full max-w-md gap-5 p-8 rounded-lg shadow-md">
            @csrf
            <x-form.field name="name" label="Name" />
            <x-form.field name="email" label="Email" type="email" />
            <x-form.field name="password" label="Password" type="password" />
            <x-form.field name="password_confirmation" label="Confirm Password" type="password" />
            <button type="submit" class="btn w-full h-14">Register</button>
        </form>
    </x-form.form>
</x-layout.layout>
