<x-layout.layout>
    <div class="flex min-h-screen flex-col items-center justify-center px-4 py-12">
        <h1 class="text-4xl font-bold text-primary">Welcome to WAzoApp</h1>
        <p class="mt-4 text-lg text-muted-foreground">Your journey starts here.</p>
        <form action="POST" class="mt-8 grid w-full max-w-md gap-5">
            <div class="grid gap-2">
                <label for="name" class="label">Name</label>
                <input type="text" name="name" id="name" class="input" required>
            </div>
            <div class="grid gap-2">
                <label for="email" class="label">Email</label>
                <input type="email" name="email" id="email" class="input" required>
            </div>
            <div class="grid gap-2">
                <label for="password" class="label">Password</label>
                <input type="password" name="password" id="password" class="input" required>
            </div>
            <div class="grid gap-2">
                <label for="password_confirmation" class="label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="input" required>
            </div>
            <button type="submit" class="btn w-full">Register</button>
        </form>
    </div>
</x-layout.layout>
