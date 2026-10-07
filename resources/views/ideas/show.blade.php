<div>
    <!-- It always seems impossible until it is done. - Nelson Mandela -->
    <h1 class="text-3xl font-bold">{{ $idea->title }}</h1>
    <p class="text-muted-foreground">{{ $idea->description }}</p>
    <p class="text-sm text-muted-foreground">Created at: {{ $idea->created_at->format('M d, Y') }}</p>
</div>
