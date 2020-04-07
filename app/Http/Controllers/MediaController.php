<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Validation;
use App\Media;
use App\Http\Resources\Media as MediaResources;
use App\Http\Requests;


class MediaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['getMedium']]);
    }
    public function index(){
        $media = \App\Media::paginate(20);
        $counter = 0;
        return view('media.index', compact('media', 'counter'));
    }

    public function getMedium($id){
        $medium = Media::findOrFail($id);
        return new MediaResources($medium);
    }

    // public function getMedia(){
    //     //get the records
    //     $media = Media::all();
    //     //return the resource
    //     return MediaResources::collection($media);
    // }

    public function create(){
        return view('media.create');
    }
    public function store(Validation $validation){
        $data = $validation->validate();
        if(request()->file('logo_url')){
            $file_name = request()['name'].'_'.time().'_'.rand(8888,9999); 
            $path = request()->file('logo_url')->storeAs(
                'public/logo/'.request()['name'].'/', $file_name
            );
            $data['logo_url'] = 'storage/logo/'.request()['name'].'/'.$file_name;
        }
        $medium = Media::create($data);
        if($medium){
            return redirect()->route('media')->with('status', 'Social Medium Created!');
        }else{
            return back();
        }
    }

    public function edit(Media $medium){
        return view('media.edit', compact('medium'));
    }

    public function update(Media $medium, Validation $validation){
        $data = $validation->validate();
        if(request()->file('logo_url')){
            $file_name = request()['name'].'_'.time().'_'.rand(8888,9999); 
            $path = request()->file('logo_url')->storeAs(
                'public/logo/'.request()['name'].'/', $file_name
            );
            $data['logo_url'] = 'storage/logo/'.request()['name'].'/'.$file_name;
        }
        foreach($data as $key => $datum){
            $medium->$key = $datum;
        }
        $medium->save();
        return redirect('/media/'.$medium->id.'/view');
    }


    public function show(Media $medium){
        return view('media.view', compact('medium'));
    }
    public function destroy(Media $medium){
        $medium->delete();
        return redirect()->route('media')->with('status', 'Record Deleted Successfully!');
    }
}
