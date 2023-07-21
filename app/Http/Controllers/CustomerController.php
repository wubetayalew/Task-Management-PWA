<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function login(){
        if(session('user') === null){
            return view('tasks.login');
        }
        else{
    return redirect(route("task.index"));          
        }
    }
    public function signUp(){        
        if(session('user') === null){
            return view('tasks.signUp');
        }
        else{
            return redirect(route("task.index"));          
        }
    }
    public function logOut(){
        session()->forget('user');
        return view('tasks.login');
    }
    public function register(Request $request){
        $user = $request->validate([
            'name'=> 'required | string',
            'email' => 'required | string | email | unique:users',
            'password' => 'required | min:5 |max:12',   
        ]);
        $user['password'] = hash('sha256', $user['password']);

        $checkNewUser = Customer::where('email', $user['email'])
        ->get();
        if($checkNewUser->count() == 0){
            $newUser = Customer::create($user);
        $user1 = Customer::where('email', $user['email'])
        ->where('password', $user['password'])
        ->get();
        session(['user' => $user1]);
              
    return redirect(route("task.index"));          
        }
        else{
        $error = 'User Is Already Registerd';
        return redirect()->back()->withErrors(['error' => $error]);
        } 
    }  
    public function loginValidate(Request $request){
        $user = $request->validate([
            'email' => 'required | string | email | unique:users',
            'password' => 'required | min:5 |max:12',   
        ]);
        $checkUser = Customer::where('email', $user['email'])
        ->where('password', hash('sha256', $user['password']))
        ->get();
        if($checkUser->count() == 1){
            $user1 = Customer::where('email', $user['email'])
            ->get();
            session(['user' => $user1]);
            return redirect(route("task.index"));     
        }
       else{
            $error = 'Incorrect Password Or Email';
            return redirect()->back()->withErrors(['error' => $error]);
            }
        
        
    }
}