<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function add(){
      
        return view('auth.add-user');
    }
    public function addUser(Request $request){
        $data = $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'password'=>'required|min:6|max:15',
            'role'=>'required|string'
        ],[
            'name.required'=>'يرجي ادخال الاسم',
            'email.required'=>'يرجي ادخال البريد الالكتروني',
            'password.required'=>'يرجي ادخال كلمه المرور',
            'password.min'=>'كلمه المرور لا تقل عن سته احرف او ارقام',
            'password.max'=>'كلمه المرور لا تزيد عن سته احرف او ارقام',
            'role.required'=>'يرجي ادخال اسم نوع المستخدم'
        ]);

        $data['password']=bcrypt($data['password']);
        User::create($data); 
        session()->flash('add');
        return redirect('add-user');
    }
    public function allUsers(){
        $users = User::all();
        return view('users.allUsers',['users'=>$users]);
    }
    public function edit($id){
        $user = User::findOrFail($id);
        return view('users.editUser',['user'=>$user]);
    }

    public function editUser(Request $request , $id){
        $user = User::find($id);
        $data = $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'password'=>'required|min:6|max:15',
            'role'=>'required|string'
        ],[
            'name.required'=>'يرجي ادخال الاسم',
            'email.required'=>'يرجي ادخال البريد الالكتروني',
            'password.required'=>'يرجي ادخال كلمه المرور',
            'password.min'=>'كلمه المرور لا تقل عن سته احرف او ارقام',
            'password.max'=>'كلمه المرور لا تزيد عن سته احرف او ارقام',
            'role.required'=>'يرجي ادخال اسم نوع المستخدم'
        ]);
        $data['password']=bcrypt($data['password']);
        $user->update($data);
        session()->flash('edit');
        return redirect('allUsers');
    }
    public function delete($id){
        $user = User::find($id);
        $user->delete();
        session()->flash('delete');
        return redirect('allUsers');
    }
}
