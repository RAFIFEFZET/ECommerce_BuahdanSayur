@extends('admin.master')
@section('title','Admin-Rafif')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Admin')
@section('page-title', 'Admin')
@section('main')
    @include('admin.main')
    <div class="card">
        <div class="card-header">
            <h5>Generate PDF</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('report.pdf') }}" method="GET">
                <div class="form-group row">
                    <label for="start_date" class="col-sm-2 col-form-label">Start Date:</label>
                    <div class="col-sm-4">
                        <input type="date" id="start_date" name="start_date" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="end_date" class="col-sm-2 col-form-label">End Date:</label>
                    <div class="col-sm-4">
                        <input type="date" id="end_date" name="end_date" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Generate PDF</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection