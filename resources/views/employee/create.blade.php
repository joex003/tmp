@extends('layouts.layout')

@section('content')
    <h2 class="mb-2">Create New Employee</h2>
    <form action="{{ route('employee.register') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
    <div class="mt-3">
        <p>Already have an account?</p>
        <form action="{{ route('employee.login.view') }}" method="GET">
            <button type="submit" class="btn btn-link">Login Here</button>
        </form>
    </div>
@endsection