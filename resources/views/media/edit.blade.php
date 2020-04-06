@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div>
                        <img id="image_holder" width="150px" height="150px" style="border-radius: 100%" src="{{asset($medium->logo_url)}}" alt="{{asset($medium->logo_url)}}">
                    </div>

                    <form action="/media/{{$medium->id}}/update" method="POST" enctype="multipart/form-data">
                        <div class="form-group mt-2">
                            <!-- <label for="picture_url">Upload Picture</label> -->
                            <input data-preview="#preview" aria-describedby="logo_urlHelp" name="logo_url"  type="file" id="logo_url" onchange="readURL(this);">
                            <small class="form-text text-muted" id="logo_urlHelp">Upload social medium logo here (image size must not exceed 500kb / 512 kilobytes) </small>
                            <div>@error('logo_url')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror</div>
                        </div>
                        <div class="form-group">
                            <label for="name">Social Medium Name</label>
                            <div>@error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror</div>
                            <input name="name" type="text" class="form-control" id="name" required aria-describedby="nameHelp" value = "{{ (old('name')) ? old('name') : $medium->name }}">
                            <small id="nameHelp" >Kindly enter social medium name</small>
                            
                        </div>
                        <div class="form-group">
                            <label for="url">Social Medium URL</label>
                            <div>@error('url')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror</div>
                            <input name="url" type="text" class="form-control" id="url" required aria-describedby="nameHelp" value = "{{ (old('url')) ? old('url') : $medium->url }}">
                            <small id="urlHelp" >Kindly enter valid social medium url  with a trailing <strong> '/' </strong> e.g. https://facebook.com/ </small>
                            
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        @csrf
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    function readURL(input) {
        console.log(input);
        if (input.files && input.files[0]) {
            console.log(input.files);
            var reader = new FileReader();
            var image_holder = document.getElementById('image_holder');
            if (input.files[0]['size'] > 1034000) {
                alert("File is too big!");
                input.setAttribute('value', '');
            } else {
                // image/
                if(input.files[0]['type'].includes('image/')){
                    reader.onload = function (e) {
                        image_holder.setAttribute('src', e.target.result);
                        image_holder.setAttribute('width', 150);
                        image_holder.setAttribute('height', 150);
                        input.setAttribute('value', input.files[0]);
                    }
                }else{
                    alert("Wrong Format!");
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
@endsection
