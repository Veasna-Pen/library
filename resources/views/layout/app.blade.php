<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <link href="{{ url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap') }}"
        rel="stylesheet" />
    <link href="{{ asset('css/tailwind.output.css') }}" rel="stylesheet">
    @livewireStyles

    <script src="{{ url('https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js') }}" defer></script>
    <script src="{{ url('js/focus-trap.js') }}"></script>
    <script src="{{ url('js/init-alpine.js') }}"></script>
    @livewireScripts

</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        @include('../includes.sidebar')
        <div class="flex flex-col flex-1 w-full">
            @include('../includes.topbar')
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    {{$slot}}
                </div>
            </main>
        </div>
    </div>
</body>

</html>
