<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light">

    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center py-4">

        <div class="mb-4">
            <a href="/" class="text-decoration-none">
                <x-application-logo class="d-block" style="width: 80px; height: 80px;" />
            </a>
        </div>

        <div class="card shadow-sm border-0" style="width: 100%; max-width: 450px;">
            <div class="card-body p-4">
                {{ $slot }}
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

