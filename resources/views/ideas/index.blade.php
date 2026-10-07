<x-layout>
    <div class="items-center justify-center flex flex-col">
        <header class="py-8 md:py-12 flex flex-col items-center justify-center text-center">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a plan.</p>
        </header>
        <div>
            <a href="/ideas" class="btn {{ request()->has('status') ? 'btn-outlined' : '' }}">All <span>{{ $statusCounts->get('all') }}</span></a>
            @foreach (App\IdeaStatus::cases() as $status)
                <a href="/ideas?status={{ $status->value }}" class="btn {{ request('status') === $status->value ? 'btn-primary' : 'btn-outlined' }}">
                    {{ $status->label() }} <span class="ml-1 text-muted-foreground">({{ $statusCounts->get($status->value) }})</span>
                </a>
            @endforeach
        </div>
        <div class="mt-10 text-muted-foreground w-0 md:w-1/2">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($ideas as $idea)
                    <x-form.card href="{{ route('ideas.show', $idea) }}">
                        <h3 class="text-foreground text-lg">{{ $idea->title }}</h3>
                        <div class="mt-1">
                            <x-cardStatus status="{{ $idea->status->label() }}">
                                {{ $idea->status->label() }}
                            </x-cardStatus>
                        </div>
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
