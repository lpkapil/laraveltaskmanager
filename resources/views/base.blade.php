@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                @yield('main')
            </div>
        </div>
    </div>
</div>
@endsection
