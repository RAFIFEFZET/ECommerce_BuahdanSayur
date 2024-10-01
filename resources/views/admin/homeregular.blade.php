@extends('admin.master')
@section('title','Admin-Rafif')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Admin')
@section('page-title', 'Admin')
@section('main')
    @include('admin.main')
    @include('admin.dashboardregular')
@endsection