@extends('base')

@section('title', 'Admin - Contacts Listing')

@section('main')

<div class="card-header">Contacts</div>

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
        <a href="{{ route('contacts.create')}}" class="btn btn-primary mb-3"><i class="fa fa-plus" aria-hidden="true"></i> New contact</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>About</td>
                <td>Email</td>
                <td>Phone</td>
                <td colspan = 2>Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{$contact->id}}</td>
                <td>{{$contact->first_name}} {{$contact->last_name}}</td>
                <td>{{$contact->about}}</td>
                <td>{{$contact->email}}</td>
                <td>{{$contact->phone}}</td>
                <td>
                    <a href="{{ route('contacts.edit',$contact->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('contacts.destroy', $contact->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $contacts->links() }}
    @endsection