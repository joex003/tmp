@extends('layouts.layout')

@section('content')
    <h2 class="mb-4">{{ __('messages.welcome', ['name' => auth()->user()->name]) }}</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex gap-3">
        <form action="{{ route('employee.update.views') }}" method="GET">
            <button type="submit" class="btn btn-warning">Update Info</button>
        </form>

        <form action="{{ route('employee.view-all') }}" method="GET">
            <button type="submit" class="btn btn-warning">View Employees</button>
        </form>

        <form action="{{ route('employee.delete') }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete your account?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Account</button>
        </form>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-secondary">Logout</button>
        </form>
    </div>
@endsection