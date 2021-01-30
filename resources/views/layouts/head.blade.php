<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="author" content="Ahmed Adel">
{!! SEOMeta::generate(true) !!}
{{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
<style>
    [x-cloak] {
        display: none;
    }
</style>
{{-- <link rel="preconnect" href="https://fonts.gstatic.com"> --}}
{{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="preload" as='style'
    onload="this.onload=null; this.rel='stylesheet'"> --}}

<script>
    function prefersDark() {
        return JSON.parse(localStorage.getItem('dark-theme')) || (!!window.matchMedia && window.matchMedia(
            '(prefers-color-scheme: dark)').matches)
    }
    if (prefersDark()) {
        document.documentElement.classList.add('theme-dark')
    } else {
        document.documentElement.classList.remove('theme-dark')
    }

</script>

<link rel="stylesheet" href="{{ mix('css/app.css') }}">

{{-- <script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.5.x/dist/component.min.js" defer>
</script> --}}
<script src="{{ mix('js/app.js') }}" defer></script>
