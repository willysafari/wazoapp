<x-layout.layout>
    <div class="flex flex-col items-center justify-center">
        <header class="py-8 md:py-12 flex flex-col items-center justify-center text-center">
            <h1 class="text-3xl font-bold">{{ $idea->title }}</h1>
            <p class="text-muted-foreground text-sm mt-2">{{ $idea->description }}</p>
        </header>
        <div class="mt-10 text-muted-foreground w-0 md:w-1/2">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <x-form.card>
                    <h3 class="text-foreground text-lg">Status</h3>
                    <div class="mt-1">
                        <x-cardStatus status="{{ $idea->status->label() }}">
                            {{ $idea->status->label() }}
                        </x-cardStatus>
                    </div>
                    <div class="mt-4">{{ $idea->created_at->diffForHumans() }}</div>
                </x-form.card>
            </div>
        </div>
    </div>
</x-layout.layout>
