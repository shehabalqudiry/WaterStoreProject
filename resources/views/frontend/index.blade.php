{{-- @php
    $json = json_decode(file_get_contents('ar.json'));
    $content = [];
    foreach ($json as $key => $value) {
        $content[] = "\"$key\":\"$key\",";
    }
    file_put_contents('en.json', $content);

@endphp --}}
@extends('frontend.layouts.app')

@section('hero')
<div class="col-md-12 col-lg-12 col-xs-12 text-center">
    <div class="contents">
        <h1 class="head-title">{{ __('Welcome To') }}<span class="year">{{ settings()->website_name ?? __('Website Name') }}</span></h1>
        <p>{{ __($settings->website_bio) }}
            <br> Or Search For
            Property, Jobs And More</p>
        <div class="search-bar">
            <fieldset>
                <form class="search-form">
                    <div class="form-group tg-inputwithicon">
                        <i class="lni-tag"></i>
                        <input type="text" name="customword" class="form-control"
                            placeholder="What are you looking for">
                    </div>
                    <div class="form-group tg-inputwithicon">
                        <i class="lni-map-marker"></i>
                        <div class="tg-select">
                            <select>
                                <option value="none">All Locations</option>
                                <option value="none">New York</option>
                                <option value="none">California</option>
                                <option value="none">Washington</option>
                                <option value="none">Birmingham</option>
                                <option value="none">Chicago</option>
                                <option value="none">Phoenix</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group tg-inputwithicon">
                        <i class="lni-layers"></i>
                        <div class="tg-select">
                            <select>
                                <option value="none">Select Categories</option>
                                <option value="none">Mobiles</option>
                                <option value="none">Electronics</option>
                                <option value="none">Training</option>
                                <option value="none">Real Estate</option>
                                <option value="none">Services</option>
                                <option value="none">Training</option>
                                <option value="none">Vehicles</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-common" type="button"><i
                            class="lni-search"></i></button>
                </form>
            </fieldset>
        </div>
    </div>
</div>
@endsection


@section('content')
<section class="trending-cat section-padding">
    <div class="container">
        <h1 class="section-title">Product Categories</h1>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <a href="category.html">
                    <div class="box">
                        <div class="icon">
                            <img class="img-fluid" src="{{ asset('frontend') }}/img/category/img-1.png"
                                alt="">
                        </div>
                        <h4>Vehicle</h4>
                        <strong>189 Ads</strong>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <a href="category.html">
                    <div class="box">
                        <div class="icon">
                            <img class="img-fluid" src="{{ asset('frontend') }}/img/category/img-2.png"
                                alt="">
                        </div>
                        <h4>Laptops</h4>
                        <strong>255 Ads</strong>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <a href="category.html">
                    <div class="box">
                        <div class="icon">
                            <img class="img-fluid" src="{{ asset('frontend') }}/img/category/img-3.png"
                                alt="">
                        </div>
                        <h4>Mobiles</h4>
                        <strong>127 Ads</strong>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <a href="category.html">
                    <div class="box">
                        <div class="icon">
                            <img class="img-fluid" src="{{ asset('frontend') }}/img/category/img-4.png"
                                alt="">
                        </div>
                        <h4>Electronics</h4>
                        <strong>69 Ads</strong>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <a href="category.html">
                    <div class="box">
                        <div class="icon">
                            <img class="img-fluid" src="{{ asset('frontend') }}/img/category/img-5.png"
                                alt="">
                        </div>
                        <h4>Computer</h4>
                        <strong>172 Ads</strong>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <a href="category.html">
                    <div class="box">
                        <div class="icon">
                            <img class="img-fluid" src="{{ asset('frontend') }}/img/category/img-6.png"
                                alt="">
                        </div>
                        <h4>Real Estate</h4>
                        <strong>150 Ads</strong>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <a href="category.html">
                    <div class="box">
                        <div class="icon">
                            <img class="img-fluid" src="{{ asset('frontend') }}/img/category/img-7.png"
                                alt="">
                        </div>
                        <h4>Home Appliances</h4>
                        <strong>249 Ads</strong>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <a href="category.html">
                    <div class="box">
                        <div class="icon">
                            <img class="img-fluid" src="{{ asset('frontend') }}/img/category/img-8.png"
                                alt="">
                        </div>
                        <h4>Jobs</h4>
                        <strong>14 9Ads</strong>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>


<section class="featured section-padding">
    <div class="container">
        <h1 class="section-title">Latest Products</h1>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                <x-ad />
            </div>
        </div>
    </div>
</section>


<section class="featured-lis section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
                <h3 class="section-title">Featured Products</h3>
                <div id="new-products" class="owl-carousel">
                    <div class="item">
                        <div class="product-item">
                            <div class="carousel-thumb">
                                <img class="img-fluid" src="{{ asset('frontend') }}/img/product/img1.jpg"
                                    alt="">
                                <div class="overlay">
                                </div>
                                <span class="price">$ 89.00</span>
                            </div>
                            <div class="product-content">
                                <h3 class="product-title"><a href="ads-details.html">Beats Headphone</a></h3>
                                <a href="#"><i class="lni-bookmark"></i> New York</a>
                                <a href="#"><i class="lni-map-marker"></i> California</a>
                                <div class="icon">
                                    <i class="lni-heart"></i>
                                </div>
                                <div class="card-text">
                                    <div class="meta">
                                        <div class="float-left">
                                            <span class="icon-wrap">
                                                <i class="lni-star-filled"></i>
                                                <i class="lni-star-filled"></i>
                                                <i class="lni-star"></i>
                                                <i class="lni-star"></i>
                                            </span>
                                            <span class="count-review">
                                                <span>1</span> Reviews
                                            </span>
                                        </div>
                                        <div class="float-right">
                                            <span class="btn-product bg-red"><a href="#">New</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="product-item">
                            <div class="carousel-thumb">
                                <img class="img-fluid" src="{{ asset('frontend') }}/img/product/img2.jpg"
                                    alt="">
                                <div class="overlay">
                                </div>
                                <span class="price">$ 89.00</span>
                            </div>
                            <div class="product-content">
                                <h3 class="product-title"><a href="ads-details.html">Coffee Maker</a></h3>
                                <a href="#"><i class="lni-bookmark"></i> Delaware</a>
                                <a href="#"><i class="lni-map-marker"></i> Xyz</a>
                                <div class="icon">
                                    <i class="lni-heart"></i>
                                </div>
                                <div class="card-text">
                                    <div class="meta">
                                        <div class="float-left">
                                            <span class="icon-wrap">
                                                <i class="lni-star-filled"></i>
                                                <i class="lni-star-filled"></i>
                                                <i class="lni-star-filled"></i>
                                                <i class="lni-star"></i>
                                            </span>
                                            <span class="count-review">
                                                <span>1</span> Reviews
                                            </span>
                                        </div>
                                        <div class="float-right">
                                            <span class="btn-product bg-yellow"><a href="#">Sale</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="product-item">
                            <div class="carousel-thumb">
                                <img class="img-fluid" src="{{ asset('frontend') }}/img/product/img3.jpg"
                                    alt="">
                                <div class="overlay">
                                </div>
                                <span class="price">$ 49.00</span>
                            </div>
                            <div class="product-content">
                                <h3 class="product-title"><a href="ads-details.html">Gaming PC</a></h3>
                                <a href="#"><i class="lni-bookmark"></i> New York</a>
                                <a href="#"><i class="lni-map-marker"></i> California</a>
                                <div class="icon">
                                    <i class="lni-heart"></i>
                                </div>
                                <div class="card-text">
                                    <div class="meta">
                                        <div class="float-left">
                                            <span class="icon-wrap">
                                                <i class="lni-star-filled"></i>
                                                <i class="lni-star-filled"></i>
                                                <i class="lni-star"></i>
                                                <i class="lni-star"></i>
                                            </span>
                                            <span class="count-review">
                                                <span>1</span> Reviews
                                            </span>
                                        </div>
                                        <div class="float-right">
                                            <span class="btn-product bg-red"><a href="#">New</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="product-item">
                            <div class="carousel-thumb">
                                <img class="img-fluid" src="{{ asset('frontend') }}/img/product/img4.jpg"
                                    alt="">
                                <div class="overlay">
                                </div>
                                <span class="price">$ 11.99</span>
                            </div>
                            <div class="product-content">
                                <h3 class="product-title"><a href="ads-details.html">Apple IPhone</a></h3>
                                <a href="#"><i class="lni-bookmark"></i> New York</a>
                                <a href="#"><i class="lni-map-marker"></i> California</a>
                                <div class="icon">
                                    <i class="lni-heart"></i>
                                </div>
                                <div class="card-text">
                                    <div class="meta">
                                        <div class="float-left">
                                            <span class="icon-wrap">
                                                <i class="lni-star-filled"></i>
                                                <i class="lni-star-filled"></i>
                                                <i class="lni-star-filled"></i>
                                                <i class="lni-star"></i>
                                            </span>
                                            <span class="count-review">
                                                <span>1</span> Reviews
                                            </span>
                                        </div>
                                        <div class="float-right">
                                            <span class="btn-product bg-yellow"><a href="#">Sele</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="product-item">
                            <div class="carousel-thumb">
                                <img class="img-fluid" src="{{ asset('frontend') }}/img/product/img5.jpg"
                                    alt="">
                                <div class="overlay">
                                </div>
                                <span class="price">$ 99.00</span>
                            </div>
                            <div class="product-content">
                                <h3 class="product-title"><a href="ads-details.html">MacBook Pro</a></h3>
                                <a href="#"><i class="lni-bookmark"></i> New York</a>
                                <a href="#"><i class="lni-map-marker"></i> California</a>
                                <div class="icon">
                                    <i class="lni-heart"></i>
                                </div>
                                <div class="card-text">
                                    <div class="meta">
                                        <div class="float-left">
                                            <span class="icon-wrap">
                                                <i class="lni-star-filled"></i>
                                                <i class="lni-star-filled"></i>
                                                <i class="lni-star"></i>
                                                <i class="lni-star"></i>
                                            </span>
                                            <span class="count-review">
                                                <span>1</span> Reviews
                                            </span>
                                        </div>
                                        <div class="float-right">
                                            <span class="btn-product bg-red"><a href="#">New</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="product-item">
                            <div class="carousel-thumb">
                                <img class="img-fluid" src="{{ asset('frontend') }}/img/product/img6.jpg"
                                    alt="">
                                <div class="overlay">
                                </div>
                                <span class="price">$ 89.00</span>
                            </div>
                            <div class="product-content">
                                <h3 class="product-title"><a href="ads-details.html">iPad Pro</a></h3>
                                <a href="#"><i class="lni-bookmark"></i> New York</a>
                                <a href="#"><i class="lni-map-marker"></i> California</a>
                                <div class="icon">
                                    <i class="lni-heart"></i>
                                </div>
                                <div class="card-text">
                                    <div class="meta">
                                        <div class="float-left">
                                            <span class="icon-wrap">
                                                <i class="lni-star-filled"></i>
                                                <i class="lni-star-filled"></i>
                                                <i class="lni-star-filled"></i>
                                                <i class="lni-star"></i>
                                            </span>
                                            <span class="count-review">
                                                <span>1</span> Reviews
                                            </span>
                                        </div>
                                        <div class="float-right">
                                            <span class="btn-product bg-yellow"><a href="#">Sale</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="product-item">
                            <div class="carousel-thumb">
                                <img class="img-fluid" src="{{ asset('frontend') }}/img/product/img7.jpg"
                                    alt="">
                                <div class="overlay">
                                </div>
                                <span class="price">$ 19.00</span>
                            </div>
                            <div class="product-content">
                                <h3 class="product-title"><a href="ads-details.html">Mobiles</a></h3>
                                <a href="#"><i class="lni-bookmark"></i> New York</a>
                                <a href="#"><i class="lni-map-marker"></i> California</a>
                                <div class="icon">
                                    <i class="lni-heart"></i>
                                </div>
                                <div class="card-text">
                                    <div class="meta">
                                        <div class="float-left">
                                            <span class="icon-wrap">
                                                <i class="lni-star-filled"></i>
                                                <i class="lni-star-filled"></i>
                                                <i class="lni-star"></i>
                                                <i class="lni-star"></i>
                                            </span>
                                            <span class="count-review">
                                                <span>1</span> Reviews
                                            </span>
                                        </div>
                                        <div class="float-right">
                                            <span class="btn-product bg-red"><a href="#">New</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="product-item">
                            <div class="carousel-thumb">
                                <img class="img-fluid" src="{{ asset('frontend') }}/img/product/img8.jpg"
                                    alt="">
                                <div class="overlay">
                                </div>
                                <span class="price">$ 123.00</span>
                            </div>
                            <div class="product-content">
                                <h3 class="product-title"><a href="ads-details.html">Nexus Phone</a></h3>
                                <a href="#"><i class="lni-bookmark"></i> New York</a>
                                <a href="#"><i class="lni-map-marker"></i> California</a>
                                <div class="icon">
                                    <i class="lni-heart"></i>
                                </div>
                                <div class="card-text">
                                    <div class="meta">
                                        <div class="float-left">
                                            <span class="icon-wrap">
                                                <i class="lni-star-filled"></i>
                                                <i class="lni-star-filled"></i>
                                                <i class="lni-star-filled"></i>
                                                <i class="lni-star-filled"></i>
                                            </span>
                                            <span class="count-review">
                                                <span>1</span> Reviews
                                            </span>
                                        </div>
                                        <div class="float-right">
                                            <span class="btn-product bg-yellow"><a href="#">Sale</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="services section-padding">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-lg-4 col-xs-12">
                <div class="services-item wow fadeInRight" data-wow-delay="0.2s">
                    <div class="icon">
                        <i class="lni-book"></i>
                    </div>
                    <div class="services-content">
                        <h3><a href="#">Full Documented</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis
                            repellat rerum assumenda facere.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 col-xs-12">
                <div class="services-item wow fadeInRight" data-wow-delay="0.4s">
                    <div class="icon">
                        <i class="lni-leaf"></i>
                    </div>
                    <div class="services-content">
                        <h3><a href="#">Clean & Modern Design</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis
                            repellat rerum assumenda facere.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 col-xs-12">
                <div class="services-item wow fadeInRight" data-wow-delay="0.6s">
                    <div class="icon">
                        <i class="lni-cog"></i>
                    </div>
                    <div class="services-content">
                        <h3><a href="#">Great Features</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis
                            repellat rerum assumenda facere.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 col-xs-12">
                <div class="services-item wow fadeInRight" data-wow-delay="0.8s">
                    <div class="icon">
                        <i class="lni-spray"></i>
                    </div>
                    <div class="services-content">
                        <h3><a href="#">Completely Customizable</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis
                            repellat rerum assumenda facere.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 col-xs-12">
                <div class="services-item wow fadeInRight" data-wow-delay="1s">
                    <div class="icon">
                        <i class="lni-emoji-smile"></i>
                    </div>
                    <div class="services-content">
                        <h3><a href="#">User Friendly</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis
                            repellat rerum assumenda facere.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 col-xs-12">
                <div class="services-item wow fadeInRight" data-wow-delay="1.2s">
                    <div class="icon">
                        <i class="lni-layout"></i>
                    </div>
                    <div class="services-content">
                        <h3><a href="#">Awesome Layout</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis
                            repellat rerum assumenda facere.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="counter-section section-padding">
    <div class="container">
        <div class="row">

            <div class="col-md-3 col-sm-6 work-counter-widget text-center">
                <div class="counter">
                    <div class="icon"><i class="lni-layers"></i></div>
                    <div class="counterUp">12090</div>
                    <p>Regular Ads</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 work-counter-widget text-center">
                <div class="counter">
                    <div class="icon"><i class="lni-map"></i></div>
                    <div class="counterUp">350</div>
                    <p>Locations</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 work-counter-widget text-center">
                <div class="counter">
                    <div class="icon"><i class="lni-user"></i></div>
                    <div class="counterUp">23453</div>
                    <p>Reguler Members</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 work-counter-widget text-center">
                <div class="counter">
                    <div class="icon"><i class="lni-briefcase"></i></div>
                    <div class="counterUp">250</div>
                    <p>Premium Ads</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="special-offer section-padding">
    <div class="container">
        <h1 class="section-title">Daily Deals</h1>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <a href="ads-details.html">
                    <div class="special-product">
                        <img src="{{ asset('frontend') }}/img/gallery/img-1.jpg" alt="">
                        <div class="product-text">
                            <h3>Special Offer</h3>
                            <div class="offer-details">
                                <h5 class="price">$ 1400</h5>
                                <h4>Buy IphoneX</h4>
                                <p>with special gift</p>
                            </div>
                            <div class="icon-footer">
                                <a href="#"><i class="icon-arrow-right-circle"></i></a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <a href="ads-details.html">
                    <div class="special-product">
                        <img src="{{ asset('frontend') }}/img/gallery/img-2.jpg" alt="">
                        <div class="product-text">
                            <h3>Special Offer</h3>
                            <div class="offer-details">
                                <h5 class="price">$ 850</h5>
                                <h4>Buy Galaxy Note 8</h4>
                                <p>with special gift</p>
                            </div>
                            <div class="icon-footer">
                                <a href="#"><i class="icon-arrow-right-circle"></i></a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-lg-12 col-md-6 col-sm-12">
                        <a href="ads-details.html">
                            <div class="special-product mb-30">
                                <img class="img-fluid" src="{{ asset('frontend') }}/img/gallery/img-3.jpg"
                                    alt="">
                                <div class="product-text">
                                    <p class="text">Colorful Outdoor <br> Mattresses That Connect to Each Other
                                    </p>
                                    <div class="icon-footer">
                                        <h5 class="price">$ 76</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-12 col-md-6 col-sm-12">
                        <a href="ads-details.html">
                            <div class="special-product">
                                <img class="img-fluid" src="{{ asset('frontend') }}/img/gallery/img-5.jpg"
                                    alt="">
                                <div class="product-text">
                                    <p class="text">Handmade Hardwood & <br> Rope Toys from Monroe Workshop</p>
                                    <div class="icon-footer">
                                        <h5 class="price">$ 50</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="testimonial section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="testimonials" class="owl-carousel">
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="img-thumb">
                                <img src="{{ asset('frontend') }}/img/testimonial/img1.png" alt="">
                            </div>
                            <div class="content">
                                <h2><a href="#">John Doe</a></h2>
                                <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Explicabo quidem, excepturi facere magnam illum, at accusantium doloremque odio.
                                </p>
                                <h3>Developer at of <a href="#">xyz company</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="img-thumb">
                                <img src="{{ asset('frontend') }}/img/testimonial/img2.png" alt="">
                            </div>
                            <div class="content">
                                <h2><a href="#">Jessica</a></h2>
                                <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Explicabo quidem, excepturi facere magnam illum, at accusantium doloremque odio.
                                </p>
                                <h3>Developer at of <a href="#">xyz company</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="img-thumb">
                                <img src="{{ asset('frontend') }}/img/testimonial/img3.png" alt="">
                            </div>
                            <div class="content">
                                <h2><a href="#">Johnny Zeigler</a></h2>
                                <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Explicabo quidem, excepturi facere magnam illum, at accusantium doloremque odio.
                                </p>
                                <h3>Developer at of <a href="#">xyz company</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="img-thumb">
                                <img src="{{ asset('frontend') }}/img/testimonial/img1.png" alt="">
                            </div>
                            <div class="content">
                                <h2><a href="#">John Doe</a></h2>
                                <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Explicabo quidem, excepturi facere magnam illum, at accusantium doloremque odio.
                                </p>
                                <h3>Developer at of <a href="#">xyz company</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="img-thumb">
                                <img src="{{ asset('frontend') }}/img/testimonial/img2.png" alt="">
                            </div>
                            <div class="content">
                                <h2><a href="#">Jessica</a></h2>
                                <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Explicabo quidem, excepturi facere magnam illum, at accusantium doloremque odio.
                                </p>
                                <h3>Developer at of <a href="#">xyz company</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="subscribes section-padding">
    <div class="container">
        <div class="row wrapper-sub">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <p>Join our 10,000+ subscribers and get access to the latest templates, freebies, announcements and
                    resources!</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <form>
                    <div class="subscribe">
                        <input class="form-control" name="email" placeholder="Your email here" required=""
                            type="email">
                        <button class="btn btn-common" type="submit">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>



@endsection
