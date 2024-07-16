<link rel="stylesheet" href="{{asset('css/login_register.css')}}">
<div class="login-container">
    <div class="login-box">
        <form action="{{route('code.verify')}}" method="post">
            @csrf
            <h2>Verify Code</h2>
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
