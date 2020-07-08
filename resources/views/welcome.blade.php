@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="content">

            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('images/slide.jpg') }}" alt="First slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Title</h5>
                            <p>This is simple text content</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/slide.jpg') }}" alt="Second slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Title</h5>
                            <p>This is simple text content</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/slide.jpg') }}" alt="Third slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Title</h5>
                            <p>This is simple text content</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="jumbotron">
                <div class="container">
                    <h3 class="display-5">{{ config('app.name', 'Laravel') }}</h3>
                    <p>A simple task management web application, with admin intefrace and multiple roles based access control features.A simple task management web application, with admin intefrace and multiple roles based access control features</p>
                    <p><a class="btn btn-primary" href="#" role="button">Learn more &raquo;</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection