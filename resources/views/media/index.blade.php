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
                <span>Social Media</span>
                
                <div class="text-right"><a href="{{route('media.create')}}" class="btn btn-sm btn-dark">Add Medium</a></div>
                </div>
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
                            <th scope="col">Logo</th>
                            <th scope="col">Social Medium</th>
                            <th scope="col">URL</th>
                            <th scope="col"  colspan="3">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($media as $medium)
                          <tr>
                            <td scope="col">{{++$counter}}</td>
                            <td scope="col">
                        <img id="image_holder" width="70px" height="50px" style="border-radius: 100%" src="{{ asset($medium->logo_url) }}" alt="asset($medium->logo_url)">
                            </td>
                            <td scope="col">{{ucfirst($medium->name)}}</td>
                            <td scope="col">
                                <a href="{{$medium->url}}" target="_blank" rel="noopener noreferrer">{{$medium->url}}</a>
                            </td>
                            
                            @can('view',   $medium)
                            <td scope="col" style="padding: 0.75rem 0; margin: auto 0;"> 
                              <a href="/media/{{$medium->id}}/view" class='btn btn-sm btn-outline-info'> View </a>                               
                            </td>
                            @endcan
                            @can('update',   $medium)
                            <td scope="col" style="padding: 0.75rem 0; margin: auto 0;">
                              <a href="/media/{{$medium->id}}/edit" class='btn btn-sm btn-outline-primary'> Edit </a>                               
                            </td>
                            @endcan
                            @can('delete',   $medium)
                              <td scope="col" style="padding: 0.75rem 0; margin: auto 0;">
                                <form style="padding: 0; margin: 0;" action="/media/{{$medium->id}}/delete" method="post">
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
                      {{ $media->links() }}
                
                  
                
                
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
