@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    
                    <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Middle Name</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Alternative Phone Number</th>
                            <th scope="col">Birthday</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($users as $user)
                          <tr>
                            <th scope="col">{{++$counter}}</th>
                            <th scope="col">{{ucfirst($user->firstname)}}</th>
                            <th scope="col">{{ucfirst($user->lastname)}}</th>
                            <th scope="col">{{ucfirst($user->middlename)}}</th>
                            <th scope="col">{{($user->phone1)?'0'.$user->phone1:''}}</th>
                            <th scope="col">{{($user->phone2)?'0'.$user->phone2:''}}</th>
                            <th scope="col">{{date('d-m-Y', strtotime($user->birthday))}}</th>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>          
                      {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
