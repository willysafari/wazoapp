<x-layout>
    <div class="py-8 max-w-4xl mx-auto">
        <div class="flex justify-between">
            <a href="{{ route('ideas.index') }}" class="flex items-center gap-x-2 text-sm font-medium btn btn-outlined">
                <x-icons.arrow-back />
                Back to Ideas
            </a>
            <div class="flex items-center gap-x-2">
                <a href="{{ route('ideas.edit', $idea) }}" class="btn btn-outlined">Edit</a>
                <form action="{{ route('ideas.destroy', $idea) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this idea?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outlined text-red-500">Delete</button>
                </form>
            </div>
        </div>

        <div class="mt-5">
            <h1 class="font-bold text-4xl">{{ $idea->title }}</h1>
            <div class="mt-2">
                <x-cardStatus status="{{ $idea->status->label() }}">
                    {{ $idea->status->label() }}
                </x-cardStatus>
                {{-- code time --}}
                <span class="ml-4 text-muted-foreground">{{ $idea->created_at->diffForHumans() }}</span>
            </div>
            <x-form.card class="mt-6">
                <div class="text-foreground max-w-none cursor-pointer">{{ $idea->description }}</div>
            </x-form.card>
        </div>
        @if ($idea->links->count())
            <div class="mt-6">
                <h3 class="font-bold text-xl mt-6">Links</h3>
                <div>
                    @foreach ($idea->links as $link)
                        <x-form.card :href="$link" target="_blank" class="text-primary font-medium flex gap-x-3 items-center">{{ $link }}</x-form.card>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-layout>
