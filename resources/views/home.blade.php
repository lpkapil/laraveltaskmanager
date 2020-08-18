@extends('layouts.app')

@section('title', 'Admin - Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            @include('sidebar')
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <p>Logged in User Name: <strong>{{ Auth::user()->name }}</strong></p>
                    <p>Logged in User Email: <strong>{{ Auth::user()->email }}</strong></p>
                    <p>Logged in User Roles: <strong>{{ Auth::user()->roles->pluck('name') }}</strong></p>
                    <?php if(in_array('admin', Auth::user()->roles->pluck('slug')->toArray())): ?>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <div class="card text-white bg-primary">
                                <div class="card-body">
                                    <h5 class="card-title">Users</h5>
                                    <p class="card-text"><i class="fa fa-users fa-3x" aria-hidden="true"></i> {{ $users }}</p>
                                    <!--<a href="#" class="btn btn-primary">Go somewhere</a>-->
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card text-white bg-primary">
                                <div class="card-body">
                                    <h5 class="card-title">Roles</h5>
                                    <p class="card-text"><i class="fa fa-cogs fa-3x" aria-hidden="true"></i> {{ $roles }}</p>
                                    <!--<a href="#" class="btn btn-primary">Go somewhere</a>-->
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card text-white bg-primary">
                                <div class="card-body">
                                    <h5 class="card-title">Contacts</h5>
                                    <p class="card-text"><i class="fa fa-cogs fa-3x" aria-hidden="true"></i> {{ $contacts }}</p>
                                    <!--<a href="#" class="btn btn-primary">Go somewhere</a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
