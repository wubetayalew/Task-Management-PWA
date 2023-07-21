<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#0A6522">
  <title>Task Managment App</title>
  {{-- <link rel="stylesheet" type="text/css" href="b.css"> --}}
  <link href="{{ asset('css/b.css') }}" rel="stylesheet">
  <link href="{{ asset('manifest.webmanifest') }}" rel="manifest">

</head>

<body>
  <div class="app-bar">
    <button id="drawer-toggle" onclick="toggleDrawer()">☰</button>
    
    <h1 >Done Tasks</h1>
  </div>
  @if ($tasks->count() == 0)
  <div class="empty-task-container">
    <div class="empty-task-message">
      <i class="fas fa-check-circle"></i>
      <p>No Tasks Are Marked As Done</p>
    </div>
  </div>
@endif

  @foreach ($tasks as $task)
  <div class="centered-div">
   <div class="card">
      <h2 class="card-title" style="text-align: left;">{{$task->title}}</h2>
      <p class="card-description" style="text-align: left;">{{$task->description}}</p>
      <p class="card-due-date"style="text-align: left;">{{$task->dueDate}}</p>
      <div class="card-actions">
         <form action="{{route('task.undone',['task'=>$task])}}"  method="post">
           @csrf
           @method('put')
            <input type="submit" value="Undone Task" style="background-color: green; color: white; padding: 10px; border: 2px solid green;
               border-radius: 5px; margin-left: 20px;">
         </form>
      </div>
   </div>
</div>
  @endforeach 
  
  <div class="drawer" id="drawer">
    
    <div class="drawer-header">
      <button id="drawer-close" onclick="toggleDrawer()">×</button>
    </div>
    <div class="drawer-content">
      <p style="text-align: left; color: white;">{{session('user')[0]['name']
      }}</p>
     <p style="text-align: left; color: white;">{{session('user')[0]['email']
      }}</p>
        
    <a href="{{route('task.index')}}" style="text-decoration: none; text-align: left;"><h2 style="color: white; font-size: medium ">📝 MY TASKS</h2></a>
    <a href="{{route('task.doneTask')}}" style="text-decoration: none; text-align: left;"><h2 style="color: white; font-size: medium ">✅ Done Task</h2></a>
    <a href="{{route('task.recycleBin')}}" style="text-decoration: none; text-align: left;"><h2 style="color: white; font-size: medium ">🗑️ Recycle Bin</h2></a>
    <a href="{{route('task.logOut')}}" style="text-decoration: none; text-align: left;">
      <h2 style="color: white; font-size: medium ">➜Log Out</h2>
   </a>
  </div>
  {{-- <script src="script.js"></script> --}}
  <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
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