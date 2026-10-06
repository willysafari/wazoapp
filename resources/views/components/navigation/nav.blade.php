<nav class="border-b border-border  px-6">
    <div class="max-w-7xl mx-auto h-16 flex items-center justify-between">
        <div>
            <a href="#">
                <img src="{{ asset('images/logo.png') }}" alt="WAzoApp Logo" class="h-8 w-auto">
            </a>
        </div>
        @auth
            <div class="flex items-center space-x-4">
                <a href="#" class="text-primary">Home</a>
                <a href="#" class="text-muted-foreground">About</a>
                <a href="#" class="text-muted-foreground">Contact</a>
                <form action="{{ url('/logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-muted-foreground btn">Logout</button>
                </form>
            </div>
        @endauth
        @guest
            <div class="flex items-center space-x-4">
                <a href="/login" class="text-muted-foreground">
                    <button class="btn">Login</button>
                </a>
                <a href="/register" class="text-muted-foreground">
                    <button class="btn">Sign Up</button>
                </a>
            </div>
        @endguest
    </div>
</nav>
