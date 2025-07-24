@extends('layouts.Layout')

@section('content')
    <h2 class="mb-2">{{ __('messages.create_new_employee') }}</h2>
    <form action="{{ route('employee.register') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('messages.name') }}:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('messages.email') }}:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('messages.password') }}:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.register') }}</button>
    </form>
    <div class="mt-3">
        <p>{{ __('messages.already_have_account') }}</p>
        <form action="{{ route('employee.login.view') }}" method="GET">
            <button type="submit" class="btn btn-link">{{ __('messages.login_here') }}</button>
        </form>
    </div>
@endsection