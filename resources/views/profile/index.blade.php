@extends('profile.sidebar')
<style>
    .img-account-profile {
        width: 200px;
        height: 200px;
        object-fit: cover;
    }
</style>
@section('content')
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" src="{{ asset($customerprofile->image_profile) }}" alt="">
                    <!-- Profile picture help block-->
                    <div class="small mb-4">{{ $customerprofile->name }}</div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <form>
                        <!-- Form Row -->
                        <div class="mb-3">
                            <!-- Form Group (location)-->
                            <label class="small mb-1" for="inputLocation">Address</label>
                            <textarea style="height: 100px !important;" class="form-control border" id="inputLocation" placeholder="Enter your location" rows="6" disabled>{{ $customerprofile->address1 }}</textarea>
                        </div>
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class="form-control border" id="inputPhone" type="tel" placeholder="Enter your phone number" value="{{ $customerprofile->phone }}" disabled>
                            </div>
                            <!-- Form Group (email)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                <input class="form-control border" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="{{ $customerprofile->email }}" disabled>
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <a href="{{ route('profile.edit', ['profile' => $customerprofile->id]) }}" class="btn btn-primary">Edit Profile</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
