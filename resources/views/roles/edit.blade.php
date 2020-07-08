@extends('base')

@section('title', 'Admin - Edit Role')

@section('main')

<div class="card-header">Edit Role: {{ $role->name }}</div>
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
    <form method="post" action="{{ route('roles.update', $role->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value="{{ $role->name }}" />
        </div>
        <div class="form-group">
            <label for="name">Permissions:</label><br><br>
            @foreach($role->allpermissions as $k => $permission)
            <input type="checkbox" name="permission_ids[]" value="{{$k}}" <?php echo (in_array($k, $role->permissions->pluck('id')->toArray()) ? 'checked': '')?>>
            <label for="permission_ids">{{$permission}}</label><br>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary float-right">Update</button>
    </form>
</div>
@endsection