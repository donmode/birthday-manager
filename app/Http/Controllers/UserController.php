<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Validation;

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

    public function update(User $user){
        return view('users.edit', compact('user'));
    }

    public function show(User $user){
        return view('users.view', compact('user'));
    }
    
    public function store(User $user, Validation $validation){
        $data = $validation->validate();
        if(request()->file('picture_url')){
            $file_name = request()['lastname'].'_'.request()['firstname'].'_'.time().'_'.rand(8888,9999); 
            $path = request()->file('picture_url')->storeAs(
                'public/'.$user->id.'/profile_pictures', $file_name
            );
            $data['picture_url'] = 'storage/'.$user->id."/profile_pictures/".$file_name;
        }
        foreach($data as $key => $datum){
            $user->$key = $datum;
        }
        $saved = $user->save();
        if($saved){
            return redirect('/users/'.$user->id.'/view');
        }else{
            return back();
        }
    }

    public function makeAdmin(){
        $this->authorize('makeAdmin', User::class);
        $User = new User();
        $user = request()->validate([
            'user'=>"required|integer"
        ]);
        $user = $User->where('id', $user['user'])->get()->first();
        if($user->id == 1){
            return back()->with('status',"Sorry! This user's access cannot be revoked!");
        }
        $user->is_admin = !$user->is_admin;
        $user->save();
        return back();
    }

    public function destroy(User $user){
        if($user->id == 1){
            return back()->with('status',"Sorry! This user's record cannot be deleted!");
        }
        $user->delete();
        return back()->with('status', 'Record Deleted Successfully!');
    }
}
