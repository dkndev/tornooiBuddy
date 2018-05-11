<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('partials.head')
    {{--TODO REMOVE STYLE TO STYLE SHEET--}}
    <style>
        #hoverMsgWapper {
            padding: 0 10px 5px;
            border-radius:  0 0 20px 20px;
            top: 0;
            left: 25%;
            width: 50%;
            background-color: #343a40;
            color: white;
            position: absolute;
            z-index: 100;
            overflow: hidden;
            white-space: nowrap;
        }
        #hoverMsgWapper a {
            color: red;
        }

    </style>
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
