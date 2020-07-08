@extends('base')

@section('title', 'Admin - Roles Listing')

@section('main')

<div class="card-header">Roles</div>

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

    <div>
        <a href="{{ route('roles.create')}}" class="btn btn-primary mb-3"><i class="fa fa-plus" aria-hidden="true"></i> New Role</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <td>Name</td>
                <!--<td>Permissions</td>-->
                <td colspan = 2>Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{$role->name}}</td>
                <!--<td>{{ implode(", ", $role->permissions->pluck('name')->toArray()) }}</td>-->
                <td>
                    <a href="{{ route('roles.edit',$role->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('roles.destroy', $role->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $roles->links() }}
    @endsection