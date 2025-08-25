<!-- resources/views/layouts/front.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Profil Instansi')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

@include('partials.navbar') <!-- Navbar publik -->

<main>
    @yield('content')
</main>

@include('partials.footer') <!-- Footer publik -->

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
