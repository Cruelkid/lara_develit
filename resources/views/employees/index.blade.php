@extends('layouts.app')

@section('content')

    <div class="col-md-6 col-lg-6 mx-auto">
        @if (Route::has('login'))
            @auth
            <a href="{{ route('employees.create') }}" class="btn btn-primary">Create an employee</a>
            @endauth
        @endif

        @foreach($employees as $employee)
            <ul class="list-group">

                <li class="list-group-item">
                    @auth
                    <a href="{{ 'employees/' . $employee->id }}/edit" class="float-right">Edit</a>
                    @endauth
                    <a href="{{ 'employees/' . $employee->id }}">{{ $employee->last_name }} {{ $employee->first_name }}</a>
                </li>
                <li class="list-group-item">{{ $employee->first_name }}</li>
                <li class="list-group-item">{{ $employee->last_name }}</li>
                <li class="list-group-item">{{ $employee->email }}</li>
                <li class="list-group-item">{{ $employee->phone }}</li>
                <li class="list-group-item">Company #{{ $employee->company }}</li>
            </ul>
        @endforeach

        {{ $employees->links() }}

    </div>

@endsection
