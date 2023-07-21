<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#0A6522">
    <title>Task Managment App</title>
    {{-- <link rel="stylesheet" href="b.css"> --}}
    <link href="{{ asset('css/b.css') }}" rel="stylesheet">
    <link href="{{ asset('manifest.webmanifest') }}" rel="manifest">
</head>
<body>
    <div class="login-page">
        
        <div class="form">
            <label class="cssFont_1">Sign Up</label>
            <br>
            <br>
            <div>
              @if($errors->any())
              
                  @foreach ($errors->all() as $error )
                  <p style="color: red ; text-align:left; font-size: 15px">{{$error}}</p>
                  @endforeach
              
              @endif
          </div>
          <form class="login-form" method="post" action="{{route('task.register')}}">

            @csrf
            @method('post')
            <input type="text" placeholder="Name" name="name"/>
            <input type="text" placeholder="Email" name="email"/>
            <input type="password" placeholder="Password" name="password"/>
            <input  style="background-color: green; color: white;" type="submit" value="SIGN UP">
            <p class="message">Already registered? <a href="{{route('task.login')}}">Sign In</a></p>
          </form>
        </div>
      </div>
    
</body>
</html>
<script src="{{ asset('/sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>