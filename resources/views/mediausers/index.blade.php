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
                <div class="card-header">
                <span> Users Social Media</span>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                    <table class="table text-center">
                        <thead class="thead-dark" style="width:100%">
                          <tr style="width:100%">
                            <th scope="col">S/N</th>
                            <th scope="col">User</th>
                            <th scope="col">Social Medium Account</th>
                            <th scope="col"  colspan="2">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($media_users as $medium_user)
                          <tr>
                            <td scope="col">{{++$counter}}</td>
                            <td scope="col">
                                <a href='{{"/users/$medium_user->user_id/view"}}' target="_blank" rel="noopener noreferrer">
                                {{$medium_user->user->lastname. " " . $medium_user->user->firstname . " " . $medium_user->user->middlename}}
                                </a>
                            </td>
                            <td scope="col">
                                <a href="{{$medium_user->handle}}" target="_blank" rel="noopener noreferrer">
                                    <img id="image_holder" width="70px" height="50px" style="border-radius: 100%" src="{{ asset($medium_user->medium->logo_url) }}" alt="asset($medium_user->medium->logo_url)">
                                </a>
                            </td>
                            
                            @can('update',   $medium_user)
                            <td scope="col" style="padding: 0.75rem 0; margin: auto 0;">
                              <a href="/mediausers/{{$medium_user->id}}/edit" class='btn btn-sm btn-outline-primary'> Edit </a>                               
                            </td>
                            @endcan
                            @can('delete',   $medium_user)
                              <td scope="col" style="padding: 0.75rem 0; margin: auto 0;">
                                <form style="padding: 0; margin: 0;" action="/mediausers/{{$medium_user->id}}/delete" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class='btn btn-sm btn-outline-danger'> Delete</button>
                                </form>
                              </td>
                            @endcan
                          </tr>
                          @endforeach
                        </tbody>
                      </table>          
                      {{ $media_users->links() }}
                
                  
                
                
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
