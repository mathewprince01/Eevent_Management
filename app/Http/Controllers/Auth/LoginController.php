<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function login(Request $request){
        $validData = $request->validate([
            'email'    => 'required|email|exists:users,email',
            'password' => 'required'
        ]);
        if(Auth::attempt($validData)){
            $user = Auth::user();
            if($user->role == 'Speaker'){
                return redirect()->route('speaker_index');
            }
            if($user->role == 'Organizer'){
                return redirect()->route('organizer_index');
            }
            return redirect()->route('event.index');
        }
        return back()->with('error', 'Invalid Credentials');
    }
    public function logout(){
        $user = Auth::user();
        $user->logout;
        return redirect('/');
    }
}
