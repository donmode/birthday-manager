@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-8 col-xs-8">
                <div class="card">
                    <div class="card-header">
                        <span>Social Medium</span>
                    </div>
                    <div class="card-body">
                        <form action="/media/store" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" aria-describedby="nameHelp" required placeholder="Enter Social Medium Name" name="name" value="{{old('name')}}">
                            <small id="nameHelp" class="form-text text-muted">Kindly enter social medium name</small>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="url">Social Medium URL</label>
                            <input name="url" type="text" class="form-control" id="url" aria-describedby="nameHelp" required placeholder="Enter Social Medium Name"  value = "{{ old('url')}}">
                            <small id="urlHelp" >Kindly enter valid social medium url  with a trailing <strong>'/'</strong> e.g. https://facebook.com/</small>
                            @error('url')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="logo_url">Upload Logo</label>
                            <input type="file" class="form-control-file" name="logo_url" required aria-describedby="logo_urlHelp" id="logo_url" placeholder="Choose Logo">
                            <small id="logo_urlHelp" class="form-text text-muted">Kindly upload Social Medium Logo</small>
                            @error('logo_url')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection