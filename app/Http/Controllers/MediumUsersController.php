<?php

namespace App\Http\Controllers;
use App\Validation;
use App\MediumUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MediumUsersController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $this->authorize('viewAny', MediumUsers::class);
        $media_users = \App\MediumUsers::paginate(20);
        $counter = 0;
        return view('mediausers.index', compact('media_users', 'counter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $media = \App\Media::pluck('name', 'id')->toArray();
        return view('mediausers.create', compact('media'));
    }

    public function store(Validation $validation)
    {
        $initial_handle = request()['handle'];
        request()['handle'] = \App\Media::findOrFail(request()['medium_id'])->url.request()['handle'];
        $data = $validation->validate();
        if(!is_array($data)){
            request()['handle'] = $initial_handle;
        }else{
            $data['user_id'] = Auth::user()->id;
            $medium = MediumUsers::create($data);
            if($medium){
                return redirect()->route('users.view', $medium->user_id)->with('status', 'Social Medium Created!');
            }
        }
        return back()->withInput();
    }

    public function edit(MediumUsers $mediumuser){
        $media = \App\Media::pluck('name', 'id')->toArray();
        return view('mediausers.edit', compact('media', 'mediumuser'));
    }

    public function update(MediumUsers $mediumuser, Validation $validation){
        $data = $validation->validate();
        foreach($data as $key => $datum){
            $mediumuser->$key = $datum;
        }
        $saved = $mediumuser->save();
        return redirect()->route('users.view', $mediumuser->user_id)->with('status', 'Record updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MediumUser  $mediumUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(MediumUsers $mediumuser)
    {
        $mediumuser->delete();
        return back()->with('status', 'Record Deleted Successfully!');
    }
}
