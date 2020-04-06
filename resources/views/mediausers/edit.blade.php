@extends('layouts.app')
@section('content')
    <style>
        #urlHolder{
            display: block;
            width: 100%;
            height: calc(1.6em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #f95057;
            background-color: #ccc;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            border-top-right-radius: 0%;
            border-bottom-right-radius: 0%;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        #handle{
            border-top-left-radius: 0%;
            border-bottom-left-radius: 0%
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-10 col-xs-10">
                <div class="card">
                    <div class="card-header">
                        <span>Social Medium</span>
                    </div>
                    <div class="card-body">
                        <form action={{"/mediausers/$mediumuser->id/update"}} method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <select class="form-control" id="medium_id" aria-describedby="medium_idHelp" required  name="medium_id" value="{{ old('medium_id') ? old('medium_id') : $mediumuser->medium_id }}" onchange="showMediumURL(this)">
                            <option value="">Please select social medium</option>
                                @foreach($media as $key => $medium)

                                    <option value="{{$key}}" {{($key == $mediumuser->medium_id) ? "selected" : '' }}>{{$medium}}</option>
                                @endforeach
                            </select>
                            <small id="medium_idHelp" class="form-text text-muted">Kindly enter select Social Medium</small>
                            <div>
                            @error('medium_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="handle">Social Medium Username</label>
                            <input name="handle" type="text" class="form-control" id="handle" aria-describedby="handleHelp" required  value = "{{ (old('handle')) ? old('handle') : $mediumuser->handle }}" >
                            <small id="handleHelp" >Kindly enter your social medium username with no trailing <strong>'/'</strong> e.g.   https://www.facebook.com/elonmusk </small>
                            <div>
                            @error('handle')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    let handle = document.getElementById('handle');

    handle.addEventListener('focus', ()=>{
        let medium = document.getElementById('medium_id');
        let urlHolder = document.getElementById('urlHolder');

        if(urlHolder.innerHTML==='https://'){
            if(medium.value!==''){
                showMediumURL(medium)
            }else{
                alert("Please select Social Medium");
                medium.focus();
            }
        }
    })

    function showMediumURL(medium){
        let id = medium.value;
        let urlHolder = document.getElementById('urlHolder');
        let handle = document.getElementById('handle');
        fetch('/api/media/'+id)
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            let url = data.data.url;
            urlHolder.innerHTML = url;
            handle.setAttribute('placeholder', 'elonmusk');
        })
        .catch((error) => {
        console.error('Error:', error);
        });
}

</script>
@endsection