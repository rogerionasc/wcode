<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    <title inertia>{{ config('app.name', 'WCode') }}</title>--}}
    @routes
    @vite([
    'resources/js/app.js',
    "resources/js/Pages/{$page['component']}.vue",
    ])
    @inertiaHead

</head>
<body>
@inertia
</body>
{{--<script src="../css/dist/js/tabler.js" defer></script>--}}
</html>
