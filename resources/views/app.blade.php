<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
{{--    <title inertia>{{ config('app.name', 'WCode') }}</title>--}}
    <title>WCode</title>
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
</html>
