@extends('base')

@section('title', 'Admin - Permissions Listing')

@section('main')

<div class="card-header">Permissions</div>

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
        <a href="{{ route('permissions.create')}}" class="btn btn-primary mb-3"><i class="fa fa-plus" aria-hidden="true"></i> New Permission</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <td>Name</td>
                <td colspan = 2>Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
            <tr>
                <td>{{$permission->name}}</td>
                <td>
                    <a href="{{ route('permissions.edit',$permission->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('permissions.destroy', $permission->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $permissions->links() }}
    @endsection