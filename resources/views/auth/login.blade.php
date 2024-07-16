<link rel="stylesheet" href="{{asset('css/login_register.css')}}">

<div class="login-container">
    <div class="login-box">
        <h2>Login</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="input-group">
                <input type="text" name="phone_number" value="{{old('phone_number')}}" required>
                <label>Phone Number</label>
                @error('phone_number')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group">
                <input type="password" name="password" required>
                <label>Password</label>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group">
                @if (Route::has('password.request'))
                    <a  href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                @endif
            </div>
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>
            <button style="margin: 20px 0 20px 0" type="submit">Login</button>
            <div class="" style="">

                @if (Route::has('register'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
                            {{ __('Need an account?') }}
                        </a>
                @endif
            </div>
        </form>
    </div>
</div>

