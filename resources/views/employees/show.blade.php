@extends('layouts.app')

@section('content')
    <div class="col-md-6 col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                {{ $employee->last_name }} {{ $employee->first_name }}
            </div>
            <ul class="list-group">
                <li class="list-group-item">{{ $employee->first_name }}</li>
                <li class="list-group-item">{{ $employee->last_name }}</li>
                <li class="list-group-item">{{ $employee->email }}</li>
                <li class="list-group-item">{{ $employee->phone }}</li>
            </ul>
        </div>
        <div class="mx-auto text-center">
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Go back</a>
        </div>
    </div>
@endsection