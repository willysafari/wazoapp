<x-layout>
    <div class="items-center justify-center flex flex-col">
        <header class="py-8 md:py-12 flex flex-col items-center justify-center text-center">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a plan.</p>
        </header>

        <!-- Fixed w-0 -> w-full -->
        <x-form.card x-data @click="$dispatch('open-modal', { name: 'create-idea' })" is="button"
            class="mt-10 cursor-pointer h-32 w-full md:w-1/2 text-left">
            <p>What's the idea?</p>
        </x-form.card>

        <div class="mt-10 flex gap-x-2 flex-wrap justify-center">
            <a href="/ideas" class="btn {{ request()->has('status') ? 'btn-outlined' : '' }}">All
                <span>{{ $statusCounts->get('all') }}</span></a>
            @foreach (App\IdeaStatus::cases() as $status)
                <a href="/ideas?status={{ $status->value }}"
                    class="btn {{ request('status') === $status->value ? 'btn-primary' : 'btn-outlined' }}">
                    {{ $status->label() }} <span
                        class="ml-1 text-muted-foreground">({{ $statusCounts->get($status->value) }})</span>
                </a>
            @endforeach
        </div>

        <!-- Fixed w-0 -> w-full -->
        <div class="mt-10 text-muted-foreground w-full md:w-1/2">
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
                    <x-form.card is="a">
                        <p>No ideas at this time.</p>
                    </x-form.card>
                @endforelse
            </div>
        </div>

        <div>
            {{-- Fixed listener check and added escape key / background click support --}}
            <x-cards.modal name="create-idea" title="Create new idea" class="w-full md:w-1/2">
                <form
                    x-data="{
                        status: 'pending',
                        newLink: '',
                        links: [],
                        addLink() {
                            const link = this.newLink.trim();

                            if (!link || !this.$refs.linkInput.reportValidity()) {
                                return;
                            }

                            this.links.push(link);
                            this.newLink = '';
                        }
                    }"
                    action="{{ route('ideas.store') }}" method="POST">
                    @csrf
                    <div class="flex flex-col gap-6 mt-2">
                        <x-form.field name="title" label="Title" type="text" placeholder="Your idea title" />
                        <div class="flex gap-x-3">
                            @foreach (App\IdeaStatus::cases() as $status)
                                <button type="button" @click="status = @js($status->value)" class="btn flex-1 h-10"
                                    :class="status === @js($status->value)? '': 'btn-outlined'">
                                    {{ $status->label() }}
                                </button>
                                <input type="hidden" name="status" class="input" :value="status">
                            @endforeach
                        </div>
                        <x-form.error name="status" />
                        <x-form.field name="description" label="Description" type="textarea"
                            placeholder="Your idea description of your ideas" />

                        {{-- <button type="submit" class="btn btn-primary mt-3">Save</button> --}}
                    </div>
                    <fieldset class="space-y-3">
                        <legend class="label">Links</legend>

                        <div class="flex gap-x-2 items-center">
                            <input x-model="newLink" x-ref="linkInput" @keydown.enter.prevent="addLink()"
                                type="url" id="new-link" placeholder="https://example.com" autocomplete="url"
                                class="input flex-1" spellcheck="false">

                            <button type="button" @click="addLink()">
                                <x-icons.close class="rotate-45" />
                            </button>
                        </div>

                        <ul class="space-y-2">
                            <template x-for="(link, index) in links" :key="index">
                                <li class="flex items-center justify-between gap-2">
                                    <span x-text="link" class="break-all"></span>
                                    <input type="hidden" name="links[]" :value="link">
                                    <button type="button" @click="links.splice(index, 1)" class="text-sm underline">
                                        Remove
                                    </button>
                                </li>
                            </template>
                        </ul>
                    </fieldset>
                    <div>
                        <div class="flex justify-end gap-x-5">
                            <button type="button" @click="show = false" variant="secondary"
                                class="btn btn-secondary">Cancel</button>
                            <button type="submit" class="btn">Create</button>
                        </div>
                    </div>
                </form>
            </x-cards.modal>
        </div>
    </div>
</x-layout>
