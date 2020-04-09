@extends('layouts.app')

@section('content')
<style>
.table td, .table th{
  vertical-align: text-bottom;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                    <table class="table text-center">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col"></th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Middle Name</th>
                            <th scope="col">Birthday</th>
                            @can('makeAdmin', App\User::class)
                              <th scope="col">Admin</th>
                              <th scope="col" colspan=4>Actions</th>
                            @endcan

                            @cannot('makeAdmin', App\User::class)
                                <th scope="col" colspan=2>Actions</th>
                            @endcannot
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($users as $user)
                          <tr>
                            <td scope="col">
                        <img id="image_holder" width="40px" height="40px" style="border-radius: 100%" src="{{ ($user->picture_url) ? asset($user->picture_url) : asset('storage/no-picture.png')}}" alt="{{asset('storage/no-picture.png')}}">
                            </td>
                            <td scope="col">{{ucfirst($user->firstname)}}</td>
                            <td scope="col">{{ucfirst($user->lastname)}}</td>
                            <td scope="col">{{ucfirst($user->middlename)}}</td>
                            <!-- <td scope="col">{{($user->phone1)?'0'.$user->phone1:''}}</td>
                            <td scope="col">{{($user->phone2)?'0'.$user->phone2:''}}</td> -->
                            <td scope="col">{{date(" M j ", strtotime($user->birthday))}}</td>
                            @can('makeAdmin', App\User::class)
                              <td scope="col">{{($user->is_admin)? "Yes": "No"}}</td>
                              <td scope="col" style="padding: 0.75rem 0; margin: auto 0;">
                                <form style="padding: 0;" action="/users/make-admin" method="post">
                                    @csrf
                                    <input type="hidden" name="user" value={{$user->id}}>
                                    <button type="submit" class="{{ ($user->is_admin)? 'btn btn-sm btn-outline-warning' : 'btn btn-sm btn-outline-secondary' }}"> {{($user->is_admin)? "Revoke Access": "Grant Access"}}</button>
                                </form>
                              </td>
                              <td scope="col" style="padding: 0.75rem 0; margin: auto 0;">
                                <form style="padding: 0; margin: 0;" action="/users/{{$user->id}}/delete" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class='btn btn-sm btn-outline-danger'> Delete</button>
                                </form>
                              </td>
                            @endcan
                            <td scope="col" style="padding: 0.75rem 0; margin: auto 0;">
                              <a href="/users/{{$user->id}}/view" class='btn btn-sm btn-outline-info'> View </a>                               
                            </td>
                            @can('update', $user, App\User::class)
                              <td scope="col" style="padding: 0.75rem 0; margin: auto 0;"  >
                                <a href="{{'/users/' .$user->id .'/edit'}}" class='btn btn-sm btn-outline-primary'> Edit </a>                               
                              </td>
                            @endcan
                            @cannot('update', $user, App\User::class)
                              <td scope="col" style="margin: auto 0">
                              </td>
                            @endcannot
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
</div>
@endsection
