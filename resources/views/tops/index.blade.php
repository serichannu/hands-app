<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>


</head>
<div class="d-flex justify-content-end">
    <a href="{{ route('logout') }}"
        onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
        {{ __('Log Out') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
</body>
</html>
