
    @props([
      'title','description'
    ])
    <div class="flex flex-col items-center justify-center px-4 py-12">
        <h1 class="text-4xl font-bold text-primary">{{ $title }}</h1>
        <p class="mt-4 text-lg text-muted-foreground">{{ $description }}</p>
           {{ $slot }}
    </div>

