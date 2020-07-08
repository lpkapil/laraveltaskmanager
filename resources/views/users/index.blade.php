@extends('base')

@section('title', 'Admin - Users Listing')

@section('main')

<div class="card-header">Users</div>

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
        <a href="{{ route('users.create')}}" class="btn btn-primary mb-3"><i class="fa fa-plus" aria-hidden="true"></i> New User</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <td>Name</td>
                <td>Email</td>
                <td>Email Verified</td>
                <td>Roles</td>
                <td colspan = 2>Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{!empty($user->email_verified_at) ? 'Yes': 'No'}}</td>
                <td>{{ implode(", ", $user->roles->pluck('name')->toArray()) }}</td>
                <td>
                    <a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('users.destroy', $user->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
    @endsection