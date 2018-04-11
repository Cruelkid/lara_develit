@extends('layouts.app')

@section('content')
    <div class="col-md-6 col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                {{ $company->name }}
            </div>
            <ul class="list-group">
                <li class="list-group-item">{{ $company->name }}</li>
                <li class="list-group-item">{{ $company->email }}</li>
                <li class="list-group-item">{{ $company->website }}</li>
                <li class="list-group-item text-center">
                    <img src="{{ asset('storage/app/public/logos/' . $company->logo) }}">
                </li>
            </ul>
        </div>
        <div class="mx-auto text-center">
            <a href="{{ route('companies.index') }}" class="btn btn-secondary">Go back</a>
        </div>
    </div>
@endsection