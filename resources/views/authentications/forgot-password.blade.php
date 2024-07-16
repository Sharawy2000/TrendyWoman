<link rel="stylesheet" href="{{asset('css/login_register.css')}}">
<div class="login-container">
    <div class="login-box">
        <form action="{{route('password.phone')}}" method="post">
            @csrf
            <h2>Reset Password</h2>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="string" name="phone_number" id="phone_number" class="form-control" placeholder="Enter your Phone" autofocus required>
                @error('phone_number')
                    <span class="text-danger">{{$message}}</span>  
                @enderror
            </div>
            <button style="margin: 20px 0 0 0" type="submit" class="btn btn-primary">Send code</button>
        </form>
    </div>
</div>
