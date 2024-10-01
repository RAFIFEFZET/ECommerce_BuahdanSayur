@extends('admin.master')

@section('nav')
    @include('admin.nav')
@endsection

@section('page-title', 'Edit Employee')
@section('page', 'Edit Employee')

@section('main')
    @include('admin.main')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Edit Employee</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="p-3">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $employee->name) }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $employee->email) }}" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                                <small class="text-muted">Leave blank to keep the current password</small>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="level" class="form-label">Level</label>
                                <select name="level" id="level" class="form-control" required>
                                    <option value="">Select Level</option>
                                    <option value="Admin" {{ $employee->level == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="Manager" {{ $employee->level == 'Manager' ? 'selected' : '' }}>Manager</option>
                                    <option value="Employee" {{ $employee->level == 'Employee' ? 'selected' : '' }}>Employee</option>
                                    <option value="Courier" {{ $employee->level == 'Courier' ? 'selected' : '' }}>Courier</option>
                                </select>
                                @error('level')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="ms-3 me-3 text-end">
                                <a href="{{ route('employees.index') }}" class="btn bg-gradient-danger w-15 my-4 mb-2">Cancel</a>
                                <button type="submit" class="btn bg-gradient-success w-15 my-4 mb-2" id="save">Save</button> 
                            </div>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
