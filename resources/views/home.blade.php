@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
                            @can('makeAdmin', App\User::class)
                              <th scope="col">Admin</th>
                              <th scope="col">Action</th>
                            @endcan
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($users as $user)
                          <tr>
                            <td scope="col">{{++$counter}}</td>
                            <td scope="col">{{ucfirst($user->firstname)}}</td>
                            <td scope="col">{{ucfirst($user->lastname)}}</td>
                            <td scope="col">{{ucfirst($user->middlename)}}</td>
                            <td scope="col">{{($user->phone1)?'0'.$user->phone1:''}}</td>
                            <td scope="col">{{($user->phone2)?'0'.$user->phone2:''}}</td>
                            <td scope="col">{{date('d-m-Y', strtotime($user->birthday))}}</td>
                            @can('makeAdmin', App\User::class)
                              <td scope="col">{{($user->is_admin)? "Yes": "No"}}</td>
                              <td scope="col">
                                <form action="/users/make-admin" method="post">
                                    @csrf
                                    <input type="hidden" name="user" value={{$user->id}}>
                                    <button type="submit" class="{{ ($user->is_admin)? 'btn btn-sm btn-outline-danger' : 'btn btn-sm btn-outline-primary' }}"> {{($user->is_admin)? "Revoke Access": "Make Admin"}}</button>
                                </form>
                              </td>
                            @endcan
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
