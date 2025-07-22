@extends('layouts.layout')

@section('content')
    <h2 class="mb-4">{{ __('messages.welcome', ['name' => auth()->user()->name]) }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex gap-3">
        <form action="{{ route('employee.update.views') }}" method="GET">
            <button type="submit" class="btn btn-warning">{{ __('messages.update_info') }}</button>
        </form>

        <form action="{{ route('employee.view-all') }}" method="GET">
            <button type="submit" class="btn btn-warning">{{ __('messages.view_employees') }}</button>
        </form>

        <form action="{{ route('employee.delete') }}" method="POST"
            onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">{{ __('messages.delete_account') }}</button>
        </form>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-secondary">{{ __('messages.logout') }}</button>
        </form>
    </div>
@endsection