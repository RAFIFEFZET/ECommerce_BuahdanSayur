@extends('profile.sidebar')

@section('content')
<div class="container-xl px-4 mt-4">
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <img class="img-account-profile rounded-circle mb-2" src="{{ asset($profile->image_profile ? 'storage/' . $profile->image_profile : 'default.jpg') }}" alt="">
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <form method="POST" action="{{ route('profile.update', ['profile' => $profile->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="file" name="image_profile" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Username</label>
                            <input class="form-control border" id="inputUsername" type="text" placeholder="Enter your username" name="name" value="{{ $profile->name }}">
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputLocation">Location</label>
                            <textarea style="height: 100px !important;" class="form-control border" id="inputLocation" placeholder="Enter your location" rows="6" name="address1">{{ $profile->address1 }}</textarea>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class="form-control border" id="inputPhone" type="tel" placeholder="Enter your phone number" name="phone" value="{{ $profile->phone }}">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                <input class="form-control border" id="inputEmailAddress" type="email" placeholder="Enter your email address" name="email" value="{{ $profile->email }}">
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
