
<x-layout>
    <div>
        <header class="py-8 md:py-12 flex flex-col items-center justify-center text-center">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a plan.</p>
        </header>

        <div class="mt-10 text-muted-foreground w-0 md:w-2/3 lg:w-1/2 mx-auto">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($ideas as $idea)
                    <x-form.card>
                        <h3 class="text-foreground text-lg">{{ $idea->title }}</h3>

                        <div class="mt-5 line-clamp-3">{{ $idea->description }}</div>
                        <div class="mt-4">{{ $idea->created_at->diffForHumans() }}</div>
                    </x-form.card>
                @empty
                    <x-form.card>
                        <p>No ideas at this time.</p>
                    </x-form.card>
                @endforelse
            </div>
        </div>
    </div>
</x-layout>

