@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="d-flex flex-column justify-content-between ml-5">
                        <div>
                            <img width="150px" height="150px" style="border-radius: 100%" src="{{asset($medium->logo_url)}}" alt="{{asset($medium->logo_url)}}">
                        </div>
                        <div class="font-weight-bold text-xl-left mt-5">{{ucfirst($medium->name)}}</div>
                        <div class="font-weight-bold text-xl-left mt-5"><a href="{{$medium->url}}" target="_blank" rel="noopener noreferrer">{{$medium->url}}</a></div>
                        

                    </div>
                    <div class="d-flex justify-content-end text-right">
                        @can('delete', $medium)
                            <div class="pr-2">
                                <form style="padding: 0; margin: 0;" action="/media/{{$medium->id}}/delete" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class='btn btn-sm btn-outline-danger'> Delete</button>
                                </form>
                            </div>
                        @endcan

                        @can('update', $medium)
                            <div class="pr-2">
                                <a href="/media/{{$medium->id}}/edit" class="btn btn-sm btn-dark">Edit</a>
                            </div>
                        @endcan
                    </div>
                </div>                
                
            </div>
        </div>
    </div>
</div>
@endsection
