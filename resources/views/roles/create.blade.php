@extends('base')

@section('title', 'Admin - Add New Role')

@section('main')


<div class="card-header">Add New Role</div>
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
    <form method="post" action="{{ route('roles.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" />
        </div>
        
        <div class="form-group">
            <label for="password">Permissions:</label><br><br>
            @foreach($role->allpermissions as $k => $permission)
            <input type="checkbox" name="permission_ids[]" value="{{$k}}">
            <label for="permission_ids">{{$permission}}</label><br>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary float-right">Add Role</button>
    </form>
</div>
@endsection