<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('partials._header')

    <body>

        @include('partials._navbar')

        @include('partials._messages')

        <div class="main mt-5">
            @yield('content')
        </div>

        @include('partials._footer')

    </body>
</html>
