@extends('layouts.app')

@section('title', 'Home')

@section('content')


<main id="main">

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
                <h1 data-aos="fade-up" data-aos-delay="">Get in touch</h1>
                <p class="mb-5" data-aos="fade-up" data-aos-delay="100">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>

    <section class="section">
      <div class="container">
        <div class="row mb-5 align-items-end">
          <div class="col-md-6" data-aos="fade-up">

            <h2>Contact Form</h2>
            <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam necessitatibus incidunt ut officiis explicabo inventore.</p>
          </div>

        </div>

        <div class="row">
          <div class="col-md-4 ml-auto order-2" data-aos="fade-up">
            <ul class="list-unstyled">
              <li class="mb-3">
                <strong class="d-block mb-1">Address</strong>
                <span>203 Fake St. Mountain View, San Francisco, California, USA</span>
              </li>
              <li class="mb-3">
                <strong class="d-block mb-1">Phone</strong>
                <span>+1 232 3235 324</span>
              </li>
              <li class="mb-3">
                <strong class="d-block mb-1">Email</strong>
                <span>youremail@domain.com</span>
              </li>
            </ul>
          </div>

          <div class="col-md-6 mb-5 mb-md-0" data-aos="fade-up">
            <form action="#" method="post" role="form" class="php-email-form">

              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" id="name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-6 form-group">
                  <label for="name">Email</label>
                  <input type="email" class="form-control" name="email" id="email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-12 form-group">
                  <label for="name">Subject</label>
                  <input type="text" class="form-control" name="subject" id="subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-12 form-group">
                  <label for="name">Message</label>
                  <textarea class="form-control" name="message" cols="30" rows="10" data-rule="required" data-msg="Please write something for us"></textarea>
                  <div class="validate"></div>
                </div>

                <div class="col-md-12 mb-3">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>

                <div class="col-md-6 form-group">
                  <input type="submit" class="btn btn-primary d-block w-100" value="Send Message">
                </div>
              </div>

            </form>
          </div>

        </div>
      </div>
    </section>

    <!-- ======= Testimonials Section ======= -->
    <section class="section border-top border-bottom">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-4">
            <h2 class="section-heading">Review From Our Users</h2>
          </div>
        </div>
        <div class="row justify-content-center text-center">
          <div class="col-md-7">
            <div class="owl-carousel testimonial-carousel">
              <div class="review text-center">
                <p class="stars">
                  <span class="icofont-star"></span>
                  <span class="icofont-star"></span>
                  <span class="icofont-star"></span>
                  <span class="icofont-star"></span>
                  <span class="icofont-star muted"></span>
                </p>
                <h3>Excellent App!</h3>
                <blockquote>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius ea delectus pariatur, numquam
                    aperiam dolore nam optio dolorem facilis itaque voluptatum recusandae deleniti minus animi,
                    provident voluptates consectetur maiores quos.</p>
                </blockquote>

                <p class="review-user">
                  <img src="assets/img/person_1.jpg" alt="Image" class="img-fluid rounded-circle mb-3">
                  <span class="d-block">
                    <span class="text-black">Jean Doe</span>, &mdash; App User
                  </span>
                </p>

              </div>

              <div class="review text-center">
                <p class="stars">
                  <span class="icofont-star"></span>
                  <span class="icofont-star"></span>
                  <span class="icofont-star"></span>
                  <span class="icofont-star"></span>
                  <span class="icofont-star muted"></span>
                </p>
                <h3>This App is easy to use!</h3>
                <blockquote>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius ea delectus pariatur, numquam
                    aperiam dolore nam optio dolorem facilis itaque voluptatum recusandae deleniti minus animi,
                    provident voluptates consectetur maiores quos.</p>
                </blockquote>

                <p class="review-user">
                  <img src="assets/img/person_2.jpg" alt="Image" class="img-fluid rounded-circle mb-3">
                  <span class="d-block">
                    <span class="text-black">Johan Smith</span>, &mdash; App User
                  </span>
                </p>

              </div>

              <div class="review text-center">
                <p class="stars">
                  <span class="icofont-star"></span>
                  <span class="icofont-star"></span>
                  <span class="icofont-star"></span>
                  <span class="icofont-star"></span>
                  <span class="icofont-star muted"></span>
                </p>
                <h3>Awesome functionality!</h3>
                <blockquote>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius ea delectus pariatur, numquam
                    aperiam dolore nam optio dolorem facilis itaque voluptatum recusandae deleniti minus animi,
                    provident voluptates consectetur maiores quos.</p>
                </blockquote>

                <p class="review-user">
                  <img src="assets/img/person_3.jpg" alt="Image" class="img-fluid rounded-circle mb-3">
                  <span class="d-block">
                    <span class="text-black">Jean Thunberg</span>, &mdash; App User
                  </span>
                </p>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Testimonials Section -->

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