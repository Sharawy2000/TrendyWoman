<link rel="stylesheet" href="{{asset('css/login_register.css')}}">
<div class="login-container">
    <div class="login-box">
        <form action="{{route('phone-verify')}}" method="post">
            @csrf
            <h2>Verify Phone</h2>

            <input type="hidden" name="phone_number" value="{{ Session::get('phone_number')}}">

            <div class="form-group">
                <label for="code">Code</label>
                <input style="margin: 20px 0 0 0" type="string" name="code" id="code" class="form-control" required autofocus>
                @error('code')
                    <span class="text-danger">{{$message}}</span>  
                @enderror
            </div>
            <button style="margin: 20px 0 0 0" type="submit" class="btn btn-primary">Verify</button>
        </form>
    </div>
</div>