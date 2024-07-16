<link rel="stylesheet" href="{{asset('css/login_register.css')}}">
<div class="login-container">
    <div class="login-box">
        <form action="{{route('reset-password')}}" method="post">
            @csrf

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input style="margin: 20px 0 0 0" type="string" name="phone_number" id="phone_number" class="form-control" placeholder="Enter your Phone" required autofocus>
                @error('phone_number')
                    <span class="text-danger">{{$message}}</span>  
                @enderror
            </div>

            {{-- <input type="hidden" name="token" value="{{ $token }}"> --}}

            <div class="form-group">
                <label for="password">Password</label>
                <input style="margin: 20px 0 0 0" type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required autofocus>
                @error('password')
                    <span class="text-danger">{{$message}}</span>  
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input style="margin: 20px 0 0 0" type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Enter your password" required autofocus>
            </div>
            <button style="margin: 20px 0 0 0" type="submit" class="btn btn-primary">Reset Password</button>

        </form>
    </div>
</div>
