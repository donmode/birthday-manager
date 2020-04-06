<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-3">
            <div class="card">            
                <div class="card-body">
                        <div class="row">
                                <span class="col-sm-3 font-weight-bold text-right">{{"Social Medium:"}}</span>
                                <span class="col-sm-9 tets-capitalize">{{$medium_user->medium->name}}</span>
                        </div>
                        <div class="row">
                                <span class="col-sm-3 font-weight-bold text-right">{{"Handle:"}}</span>
                                <span class="col-sm-9"> <a href="{{$medium_user->handle}}">{{$medium_user->handle}}</a></span>
                        </div>
                    <!-- </div>  -->
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-start text-left">
                        @can('delete', $medium_user)
                            <div class="pr-2">
                                <form style="padding: 0; margin: 0;" action="/mediausers/{{$medium_user->id}}/delete" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class='btn btn-sm btn-outline-danger'> Delete</button>
                                </form>
                            </div>
                        @endcan
                        @can('update', $user, $medium_user)
                            <div class="pr-2">
                                <a href="/mediausers/{{$medium_user->id}}/edit" class="btn btn-sm btn-dark">Edit</a>
                            </div>
                        @endcan
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>