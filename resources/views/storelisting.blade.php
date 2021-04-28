@extends('layouts.app')

@section('title', 'Home')

@section('content')

<?php
use App\Store;
$stores = Store::orderByDesc('id')->paginate(6);
?>

<main id="main">

    <!-- ======= Blog Section ======= -->
    <section class="hero-section inner-page">
      <div class="wave">

        <svg width="1920px" height="265px" viewBox="0 0 1920 265" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
              <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,667 L1017.15166,667 L0,667 L0,439.134243 Z" id="Path"></path>
            </g>
          </g>
        </svg>

      </div>

      <div class="container">
        <div class="row align-items-center">
          <div class="col-12">
            <div class="row justify-content-center">
              <div class="col-md-7 text-center hero-text">
                <h1 data-aos="fade-up" data-aos-delay="">All Stores</h1>
                <p class="mb-5" data-aos="fade-up" data-aos-delay="100">Find stores selling products and services.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>

    <section class="section">
      <div class="container">
        <div class="row mb-5">
          <?php
            foreach($stores as $store):
          ?>
          <div class="col-md-4">
            <div class="post-entry">
              <a href="{{ config('app.url').$store->store_name }}" class="d-block mb-4" target="_blank">
                  @empty($store->store_logo)
                    <img src="{{ '/demo_images/shop_black.png' }}" class="img-fluid">
                  @else
                    <img src="{{ '/storage/'.$store->store_logo }}" class="img-fluid">
                  @endempty
              </a>
              <div class="post-text">
                @if($store->store_status == 1)
                  <p class="post-meta" style="color: green">&#9673; Online now</p>
                @else
                  <p class="post-meta" style="color: red">&#9673; Currently offline</p>
                @endif
                <span class="post-meta">Selling from: {{ $store->created_at }}</span>
                <h3><a href="{{ config('app.url').$store->store_name }}" target="_blank">{{ ucfirst($store->store_name) }}</a></h3>
                <p>{{ $store->store_description }}</p>
                <p><a href="{{ config('app.url').$store->store_name }}" class=" btn btn-primary btn-sm" target="_blank">Visit Store</a></p>
              </div>
            </div>
          </div>
          <?php
            endforeach;
          ?>

        </div>

        <div class="row">
          <div class="col-12 text-center">
            {{ $stores->links() }}
          </div>
        </div>
      </div>

    </section>

    <!-- ======= CTA Section ======= -->
    <section class="section cta-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 mr-auto text-center text-md-left mb-5 mb-md-0">
            <h2>Starts Publishing Your Apps</h2>
          </div>
          <div class="col-md-5 text-center text-md-right">
            <p><a href="#" class="btn"><span class="icofont-brand-apple mr-3"></span>App store</a> <a href="#" class="btn"><span class="icofont-ui-play mr-3"></span>Google play</a></p>
          </div>
        </div>
      </div>
    </section><!-- End CTA Section -->

  </main><!-- End #main -->
@endsection