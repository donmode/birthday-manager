@extends('layouts.app')

@section('content')
<style>

        .plusBox{
            display: block;
            width: 100%;
            height: calc(1.6em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            font-weight: 400;
            line-height: 1.6;
            color: black;
            background-color: #ccc;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            border-top-right-radius: 0%;
            border-bottom-right-radius: 0%;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .numberBox{
            border-top-left-radius: 0%;
            border-bottom-left-radius: 0%
        }
</style>

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
                            
                            <label for="phone1">Phone Number </label>

                            <div class="row  pl-3 pr-3">
                                <span class="col-md-1 col-lg-1 col-xs-1 col-sm-1 plusBox text-right">+</span>
                                <input name="phone1" type="text" class="col-md-11 col-lg-11 col-xs-11 col-sm-11 form-control numberBox" id="phone1"   required aria-describedby="phone1Help" value = "{{ (old('phone1')) ? old('phone1') : $user->phone1 }}">
                            </div>

                            <small id="phone1Help" class="form-text text-muted">Kindly enter your primary mobile number</small>
                            @error('phone1')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone2">Alternative Phone Number</label>
                            
                            
                            <div class="row  pl-3 pr-3">
                                <span class="col-md-1 col-lg-1 col-xs-1 col-sm-1 plusBox text-right">+</span>
                                <input name="phone2" type="text" class="col-md-11 col-lg-11 col-xs-11 col-sm-11 numberBox form-control"   id="phone2" aria-describedby="phone2Help" value = "{{ (old('phone2')) ? old('phone2') : $user->phone2 }}">
                            </div>
                            
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
