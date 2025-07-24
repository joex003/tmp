@extends('layouts.Layout')

@section('content')
    <h2 class="mb-2">{{ __('messages.login') }}</h2>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('messages.email') }}</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('messages.password') }}</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.login') }}</button>
    </form>
@endsection