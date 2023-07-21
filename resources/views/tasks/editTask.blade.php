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
            <label class="cssFont_1">Edit Task</label>
            <br>
            <br>
            <div>
              @if($errors->any())
              
                  @foreach ($errors->all() as $error )
                  <p style="color: red ; text-align:left; font-size: 15px">{{$error}}</p>
                  @endforeach
              
              @endif
          </div>
            
          <form class="login-form" method="post" action="{{route('task.update',['task'=> $task])}}">

            @csrf
            @method('put')
            <input type="text" placeholder="Title" name="title" value="{{$task->title}}"/>
            <input type="text" placeholder="Description" name="description" value="{{$task->description}}"/>
            
            <input type="text" placeholder="Due Date" name="dueDate" value="{{$task->dueDate}}"/>
            <input  style="background-color: green; color: white;" type="submit" value="UPDATE TASK">
            <a href="{{route('task.index')}}" style="text-decoration: none;"> <p style="background-color: red; color: white; padding: 15px;">Cancel</p></a>
           

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