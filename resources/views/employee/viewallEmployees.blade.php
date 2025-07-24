@extends('layouts.Layout')

@section('content')
    <h2 class="mb-4">{{ __('messages.allemployees') }}</h2>

    @if($employees->isEmpty())
        <p>No employees found.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.email') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $employees->links('pagination::bootstrap-5') }}
        </div>
    @endif
@endsection