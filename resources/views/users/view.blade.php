@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @can('update', $user, App\User::class)

                <div class="card-header">
                    <div class="pr-2 text-right">
                        <a href="/mediausers/create" class="btn btn-sm btn-dark">Add Social Medium Account</a>
                    </div>
                </div>
                @endcan

                <div class="card-header">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="d-flex flex-column justify-content-between ml-5">
                        <div>
                            <img width="150px" height="150px" style="border-radius: 100%" src="{{ ($user->picture_url) ? asset($user->picture_url) : asset('storage/no-picture.png')}}" alt="{{asset('storage/no-picture.png')}}">
                        </div>
                        <div class="font-weight-bold text-xl-left">{{ucfirst($user->lastname). " " . ucfirst($user->firstname). " " . ucfirst($user->middlename)}}</div>
                    </div>
                    <div class="d-flex justify-content-end text-right">
                        @can('makeAdmin', App\User::class)
                            <div class="pr-2">
                                <form style="padding: 0; margin: 0;" action="/users/{{$user->id}}/delete" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class='btn btn-sm btn-outline-danger'> Delete</button>
                                </form>
                            </div>
                        @endcan

                        @can('update', $user, App\User::class)
                            <div class="pr-2">
                                <a href="/users/{{$user->id}}/edit" class="btn btn-sm btn-dark">Edit Profile</a>
                            </div>
                        @endcan
                    </div>
                </div>                
                <div class="card-body">
                        <div class="row">
                                <span class="col-sm-3 font-weight-bold text-right">{{"Birthday:"}}</span>
                                <span class="col-sm-9">{{date('d-m-Y', strtotime($user->birthday))}}</span>
                        </div>
                        <div class="row">
                                <span class="col-sm-3 font-weight-bold text-right">{{"Email:"}}</span>
                                <span class="col-sm-9"> {{$user->email}}</span>
                        </div>
                        @if($user->address)
                        <div class="row">
                                <span class="col-sm-3 font-weight-bold text-right">{{"Address:"}}</span>
                                <span class="col-sm-9  text-capitalize"> {{$user->address}}</span>
                        </div>
                        @endif
                        <div class="row">
                                <span class="col-sm-3 font-weight-bold text-right">{{"Phone Number:"}}</span>
                                <span class="col-sm-9"> {{$user->phone1}}</span>
                        </div>
                        @if($user->phone2)
                        <div class="row">
                                <span class="col-sm-3 font-weight-bold text-right">{{"Alt. Phone Number:"}}</span>
                                <span class="col-sm-9"> {{$user->phone2}}</span>
                        </div>
                        @endif
                    <!-- </div>  -->
                </div>


                {{-- for social medium account related to the user --}}
                @if(!empty($user->medium_users->toArray()))
                        <div class ="card">
                            <div class="card-header">
                                <div class="font-weight-bold text-md-left pl-5 text-uppercase">Social Media Account(s)</div>
                            </div>
                            @foreach($user->medium_users as $medium_user)
                                <div class="card-body">
                                    @include('mediausers.view', ['medium_user', $medium_user])
                                </div>
                            @endforeach
                        </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
