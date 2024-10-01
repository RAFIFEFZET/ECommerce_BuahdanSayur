@extends('admin.master')

@section('nav')
    @include('admin.nav')
@endsection

@section('page-title', 'Create Employee')
@section('page', 'Create Employee')

@section('main')
    @include('admin.main')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Create New Employee</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form action="{{ route('employees.store') }}" method="POST" class="p-3">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="level" class="form-label">Level</label>
                                <select class="form-select" name="level" id="level" required>
                                    <option value="">Select Level</option>
                                    @if(Auth::guard('admin')->user()->level == 'Owner')
                                        <option value="Manager">Manager</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Employee">Employee</option>
                                        <option value="Courier">Courier</option>
                                    @endif
                                    @if(Auth::guard('admin')->user()->level == 'Manager')
                                        <option value="Admin">Admin</option>
                                        <option value="Employee">Employee</option>
                                        <option value="Courier">Courier</option>
                                    @endif
                                </select>
                                @error('level')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="ms-3 me-3 text-end">
                                <a href="{{ route('employees.index') }}"
                                    class="btn bg-gradient-danger w-15 my-4 mb-2">Cancel</a>
                                <button type="submit" class="btn bg-gradient-success w-15 my-4 mb-2"
                                    id="save">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
