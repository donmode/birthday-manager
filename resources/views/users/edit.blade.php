@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header">
                    <div>
                        <img id="image_holder" width="150px" height="150px" style="border-radius: 100%" src="{{ ($user->picture_url) ? asset($user->picture_url) : asset('storage/no-picture.png')}}" alt="{{asset('storage/no-picture.png')}}">
                    </div>

                    <form action="/users/{{$user->id}}/store" method="POST" enctype="multipart/form-data">
                        <div class="form-group mt-2">
                            <!-- <label for="picture_url">Upload Picture</label> -->
                            <input data-preview="#preview" aria-describedby="picture_urlHelp" name="picture_url" type="file" id="picture_url" onchange="readURL(this);">
                            <small class="form-text text-muted" id="picture_urlHelp">Upload your profile picture here (image size must not exceed 1MB / 1024 kilobytes) </small>
                            @error('picture_url')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                </div>

                <div class="card-body">

                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input name="firstname" type="text" class="form-control" id="firstname" required aria-describedby="firstnameHelp" value = "{{ (old('firstname')) ? old('firstname') : $user->firstname }}">
                            <small id="firstnameHelp" >Kindly enter your first name</small>
                            @error('firstname')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="middlename">Middle Name</label>
                            <input name="middlename" type="text"  class="form-control" id="middlename" aria-describedby="middlenameHelp" value = "{{ (old('middlename')) ? old('middlename') : $user->middlename }}">
                            <small id="middlenameHelp" class="form-text text-muted">Kindly enter your middle name</small>
                            @error('middlename')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input name="lastname" type="text" class="form-control"   id="lastname" required aria-describedby="lastnameHelp" value = "{{ (old('lastname')) ? old('lastname') : $user->lastname }}">
                            <small id="lastnameHelp" class="form-text text-muted">Kindly enter your last name</small>
                            @error('lastname')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="phone1">Phone Number (+)</label>
                            <input name="phone1" type="text" class="form-control" id="phone1"   required aria-describedby="phone1Help" value = "{{ (old('phone1')) ? old('phone1') : $user->phone1 }}">
                            <small id="phone1Help" class="form-text text-muted">Kindly enter your primary mobile number</small>
                            @error('phone1')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone2">Alternative Phone Number (+)</label>
                            <input name="phone2" type="text" class="form-control"   id="phone2" aria-describedby="phone2Help" value = "{{ (old('phone2')) ? old('phone2') : $user->phone2 }}">
                            <small id="phone2Help" class="form-text text-muted">Kindly enter your alternative mobile number</small>
                            @error('phone2')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" class="form-control" id="address" required aria-describedby="addressHelp" value = "{{ (old('address')) ? old('address') : $user->address }}">
                            {{ (old('address')) ? old('address') : $user->address }}
                            </textarea>
                            <small id="addressHelp" class="form-text text-muted">Kindly enter your address</small>
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
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
