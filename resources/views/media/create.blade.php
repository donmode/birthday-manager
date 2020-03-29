@extends('layouts.app')
@section('content')
    <div class="page-header">
        <h2> Create Social Medium </h2>
    </div>
    <form action="/create-media" method="POST">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter Social Medium Name" name="name">
    </div>
    <div class="form-group">
        <label for="logo">Upload Logo</label>
        <input type="file" class="form-control-file" name="logo" id="logo" placeholder="Choose Logo">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Submit</button>
    </form>

@endsection