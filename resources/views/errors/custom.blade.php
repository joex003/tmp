@extends('layouts.layout')
@section('content')
    <div class="text-center">
        <h1 class="display-4 text-danger">An error occurred</h1>
        <p class="lead">{{ $message }}</p>
        <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Go Back</a>
    </div>
@endsection