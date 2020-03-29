<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::paginate(20);
        $counter = 0;
        return view('home', compact('users', 'counter'));
    }

    public function makeAdmin(){
        $this->authorize('makeAdmin', User::class);
        $User = new \App\User();
        $user = request()->validate([
            'user'=>"required|integer"
        ]);
        $user = $User->where('id', $user['user'])->get()->first();
        $user->is_admin = !$user->is_admin;
        $user->save();
        return back();
    }
}
