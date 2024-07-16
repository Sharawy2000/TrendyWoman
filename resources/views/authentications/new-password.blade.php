<link rel="stylesheet" href="{{asset('css/login_register.css')}}">
<div class="login-container">
    <div class="login-box">
        <form action="{{route('reset-password')}}" method="post">
            @csrf
            <h2>Reset Password</h2>

            <input type="hidden" name="phone_number" value="{{ Session::get('phone_number')}}">

            <div class="form-group">
                <label for="password">New Password</label>
                <input style="margin: 20px 0 0 0" type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required autofocus>
                @error('password')
                    <span class="text-danger">{{$message}}</span>  
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input style="margin: 20px 0 0 0" type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Enter your password" required autofocus>
            </div>
            <button style="margin: 20px 0 0 0" type="submit" class="btn btn-primary">Reset</button>

        </form>
    </div>
</div>
