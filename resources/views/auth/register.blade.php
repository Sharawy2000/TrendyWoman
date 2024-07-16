<link rel="stylesheet" href="{{asset('css/login_register.css')}}">

<div class="login-container">
    <div class="login-box">
        <h2>Register</h2>
        <form action="{{route('register')}}" method="post">
            @csrf
            <div class="input-group">
                <input type="text" name="name" value="{{old('name')}}">
                <label for="name">Name</label>
                @error('name') 
                    <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="input-group">
                <input type="email" name="email" value="{{old('email')}}">
                <label for="email">E-mail</label>
                @error('email') 
                    <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="input-group">
                <input type="password" name="password">
                <label for="password">Password</label>
                @error('password') 
                    <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="input-group">
                <input type="password" name="password_confirmation">
                <label for="password_confirmation">Re-Password</label>
                @error('password_confirmation') 
                    <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="input-group">
                <input type="text" name="phone_number" value="{{old('phone_number')}}">
                <label for="phone_number">Phone Number</label>
                @error('phone_number') 
                    <span class="error">{{$message}}</span>
                @enderror
            </div>
            <button style="margin-bottom:20px" type="submit">SignUp</button>
            <div class="input-group">

                @if (Route::has('login'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                            {{ __('Have an account?') }}
                        </a>
                @endif
            </div>
        </form>
    </div>
</div>
