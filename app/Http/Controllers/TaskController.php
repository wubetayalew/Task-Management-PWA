<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


class TaskController extends Controller
{ 


   public function index(){
    if(session('user') !== null){
        $tasks = Task::where('isDeleted', false)
             ->where('isDone', false)
             ->where('user', session('user')[0]['email'])
             ->get();
     $tasks = $tasks->reverse();
    return view('tasks.index',['tasks'=>$tasks]);
    }
    else return redirect(route("task.login"));
    
   }
   public function doneTask(){
    if(session('user') !== null){
        $tasks = Task::where('isDone', true)
        ->where('user', session('user')[0]['email'])
        ->get();
    $tasks = $tasks->reverse();
    return view('tasks.doneTask',['tasks'=>$tasks]);
    }
    else return redirect(route("task.login"));

   }
   public function recycleBin(){
    

    if(session('user') !== null){
        $tasks = Task::where('isDeleted', true)
        ->where('user', session('user')[0]['email'])
        ->get();
    $tasks = $tasks->reverse();

    return view('tasks.recycleBin',['tasks'=>$tasks]);
    }
    else return redirect(route("task.login"));

   }
   public function create(){
    return view('tasks.addTask');
   }
   public function store(Request $request){
  
    $data = $request->validate([
        'title'=> 'required | string',
        'description' => 'nullable | string',
        'dueDate' => 'required',
        'user' => 'nullable',
        'isDeleted' => 'nullable',
        'isDone' => 'nullable',
        
    ]);
    $data['user'] = session('user')[0]['email'];


    $newTask = Task::create($data);
    return redirect(route("task.index"));
   

}
Public function edit(Task $task){
    return view('tasks.editTask', ['task' => $task]);
}
Public function update(Task $task,Request $request){
    $data = $request->validate([
        'title'=> 'required | string',
        'description' => 'nullable | string',
        'dueDate' => 'required',
        'user' => 'nullable',
        'isDeleted' => 'nullable',
        'isDone' => 'nullable',
        
    ]);
    $task->update($data);
    return redirect(route("task.index"));     
}
Public function done(Task $task){
    
    $task->update(['isDone' => true]);
    return redirect(route("task.index"));     
}
Public function delete(Task $task){
    
    $task->update(['isDeleted' => true]);
    return redirect(route("task.index"));     
}
Public function undone(Task $task){
    
    $task->update(['isDone' => false]);
    return redirect(route("task.doneTask"));     
}
Public function recover(Task $task){
    
    $task->update(['isDeleted' => false]);
    return redirect(route("task.recycleBin"));     
}
   
Public function deletePermanently(Task $task){
        
    $task->delete();
    return redirect(route("task.recycleBin"));         
}
     
}