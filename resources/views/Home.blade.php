<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @auth

    <h1>Welcome , {{Auth::user()->name}}</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-dropdown-link :href="route('logout')"
                onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-dropdown-link>
    </form>
    <div>
        <a href="{{route('profile.edit')}}">Profile</a>
    </div>

    <div>
        @if (Auth::user()->user_type==='admin')
            <a href="{{route('dashboard')}}">Dashboard, adminstrator {{Auth::user()->name}}</a>
        @endif
    </div>
        
    @endauth

</body>
</html>