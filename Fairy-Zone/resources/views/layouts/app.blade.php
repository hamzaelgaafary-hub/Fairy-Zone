<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Fairy Zone' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Page Content --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Footer
    @include('components.footer')--}}

</body>

</html>