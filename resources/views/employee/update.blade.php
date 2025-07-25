@extends('layouts.Layout')

@section('content')
    <h2 class="mb-3">{{ __('messages.update_info_title') }}</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('employee.update.submit') }}">
        @csrf
        @method("PUT")

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('messages.name') }}:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', auth()->user()->name) }}"
                required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('messages.email') }}:</label>
            <input type="email" name="email" id="email" class="form-control"
                value="{{ old('email', auth()->user()->email) }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
    </form>
@endsection