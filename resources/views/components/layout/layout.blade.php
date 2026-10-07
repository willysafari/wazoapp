<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>WazoApp</title>
</head>

<body>
    <div class="min-h-screen bg-background text-foreground">
        <x-navigation.nav />
        @session('success')
            <div x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 3000)"
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative w-2xl float-right"
            x-transition.duration.opacity.500ms
             x-show="show"
             role="alert">
               {{ $value }}
            </div>
        @endsession
        <main>
            {{ $slot }}
        </main>


    </div>
</body>

</html>
