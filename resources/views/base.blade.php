<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('partials.head')
</head>
<body>

<header class="pb-5">
    @include('partials.navbar')
</header>

<div class="container mt-5">
    <div id="vueApp">
        @yield('content')
    </div>
</div>

<footer class="container py-5">
    @include('partials.footer')
</footer>

@include('partials.scripts')

@yield('script')

</body>
</html>
