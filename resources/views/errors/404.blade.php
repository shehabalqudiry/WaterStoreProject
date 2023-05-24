@extends('layouts.guest')
@section('hero')
<div class="col-md-12 col-lg-12 col-xs-12 text-center">
    <div class="contents">
        <h1 class="head-title">Welcome to <span class="year">{{ $settings->website_name }}</span></h1>
        <p>{{ $settings->website_bio }}
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
    <!-- Start Content -->
    <div class="error section-padding">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
              <div class="error-content">
                <div class="error-message">
                  <h2>404</h2>
                  <h3><span>Ooooops!</span> Something Went Wrong...</h3>
                </div>
                <form class="form-error-search">
                  <input type="search" name="search" class="form-control" placeholder="Search Here">
                  <button class="btn btn-common btn-search" type="button">Search Now</button>
                </form>
                <div class="description">
                  <span>Or Goto <a href="/">Homepage</a></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Content -->
@endsection
