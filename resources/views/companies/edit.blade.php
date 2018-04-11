@extends('layouts.app')

@section('content')

    @auth
        <div class="col-md-6 col-lg-6 mx-auto">
             <a href="#" class="btn btn-danger"
               onclick="
                    var result = confirm('Are you sure you want to delete?');
                    if (result) {
                        event.preventDefault();
                        document.getElementById('delete-form').submit();
                    }"
            >Delete</a>

            <form id="delete-form" action="{{ route('companies.destroy', [$company->id]) }}"
                  method="post" style="display: none;">
                <input type="hidden" name="_method" value="delete">
                {{ csrf_field() }}
            </form>
        </div>
    @endauth

    </br>

    <form method="POST" action="{{ route('companies.update', [$company->id]) }}" enctype="multipart/form-data" class="col-md-6 col-lg-6 mx-auto" id="edit-form">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $company->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" value="{{ $company->email }}" required>
        </div>

        <div class="form-group">
            <label for="website">Website</label>
            <input type="text" class="form-control" name="website" value="{{ $company->website }}" required>
        </div>

        <div class="form-group">
            <img src="{{ asset('storage/app/public/logos/' . $company->logo) }}">
        </div>

        <div class="form-group">
            <label for="name">Logo</label>
            <input type="file" class="form-control" name="logo">
        </div>

        <div class="mx-auto text-center">
            <a href="{{ route('companies.index') }}" class="btn btn-secondary">Go back</a>
            @auth
                <button type="submit" class="btn btn-primary">
                    Save
                </button>
            @endauth
        </div>
    </form>

@endsection