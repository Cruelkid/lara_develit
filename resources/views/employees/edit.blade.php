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

        <form id="delete-form" action="{{ route('employees.destroy', [$employee->id]) }}"
              method="post" style="display: none;">
            <input type="hidden" name="_method" value="delete">
            {{ csrf_field() }}
        </form>
    </div>
    @endauth

    </br>

    <form method="POST" action="{{ route('employees.update', [$employee->id]) }}" class="col-md-6 col-lg-6 mx-auto" id="edit-form">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put">
        <div class="form-group">
            <label for="first_name">First name</label>
            <input type="text" class="form-control" name="first_name" value="{{ $employee->first_name }}" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last name</label>
            <input type="text" class="form-control" name="last_name" value="{{ $employee->last_name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" value="{{ $employee->email }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" name="phone" value="{{ $employee->phone }}" required>
        </div>

        <div class="mx-auto text-center">
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Go back</a>
            @auth
            <button type="submit" class="btn btn-primary">
                Save
            </button>
            @endauth
        </div>
    </form>

@endsection