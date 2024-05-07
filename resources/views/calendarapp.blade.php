<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Calendar</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap"
              rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
        <div class="flex flex-col xl:max-h-screen min-h-screen xl:flex-row">
            <div class="grow flex overflow-scroll max-h-screen bg-slate-300">
                <livewire:calendar />
            </div>
            <div class="xl:basis-1/4 overflow-scroll max-h-screen">
                <livewire:events />
            </div>
        </div>
    </body>
</html>
