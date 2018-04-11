@extends('layouts.app')

@section('content')

    <div class="col-md-6 col-lg-6 mx-auto">
        @if (Route::has('login'))
            @auth
            <a href="{{ route('companies.create') }}" class="btn btn-primary">Create company</a>
            @endauth
        @endif

        @foreach($companies as $company)
            <ul class="list-group">

                <li class="list-group-item">
                    @auth
                        <a href="{{ 'companies/' . $company->id }}/edit" class="float-right">Edit</a>
                    @endauth
                    <a href="{{ 'companies/' . $company->id }}">{{ $company->name }}</a>
                </li>
                <li class="list-group-item">{{ $company->email }}</li>
                <li class="list-group-item">{{ $company->website }}</li>
                <li class="list-group-item text-right">
                    <img src="{{ asset('storage/app/public/logos/' . $company->logo) }}" style="height: 100px; width: 100px">
                </li>
            </ul>
        @endforeach

        {{ $companies->links() }}

    </div>

@endsection
