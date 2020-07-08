@extends('base')

@section('title', 'Admin - Edit Permission')

@section('main')


<div class="card-header">Edit Permission: {{ $permission->name }}</div>
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
    <form method="post" action="{{ route('permissions.update', $permission->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value="{{ $permission->name }}" />
        </div>
        <button type="submit" class="btn btn-primary float-right">Update</button>
    </form>
</div>
@endsection