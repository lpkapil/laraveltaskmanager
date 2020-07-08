@extends('base')

@section('title', 'Admin - Add New Contact')

@section('main')


<div class="card-header">Add New Contact</div>
<div class="card-body">
    <div>
        @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif

        @if(session()->get('errors'))
        <div class="alert alert-danger">
            {{ session()->get('errors') }}
        </div>
        @endif
    </div>
    <form method="post" action="{{ route('contacts.store') }}">
        @csrf
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" />
        </div>
        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" />
        </div>
        <div class="form-group">
            <label for="about">About:</label>
            <textarea name="about" class="form-control">{{ old('last_name') }}</textarea>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" name="email" value="{{ old('email') }}" />
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" />
        </div>
        <button type="submit" class="btn btn-primary float-right">Add contact</button>
    </form>
</div>
@endsection