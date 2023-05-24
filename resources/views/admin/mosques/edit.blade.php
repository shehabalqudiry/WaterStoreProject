@extends('layouts.app', ['page_title' => 'تعديل المسجد'])
@section('styles')
    <style>
        /* Set the size of the div element that contains the map */
        #map {
            height: 400px;
            /* The height is 400 pixels */
        }
    </style>
@endsection
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 ">

            <form id="validate-form" class="row" enctype="multipart/form-data" method="POST"
                action="{{ route('admin.mosques.update', $mosque->id) }}">
                @csrf
                @method('PUT')
                <div class="col-12 col-lg-8 p-0 main-box mx-auto">
                    <div class="col-12 px-0 card-header">
                        <div class="col-12 px-3 py-3">
                            <span class="fas fa-info-circle"></span> تعديل
                        </div>
                    </div>
                    <div class="col-12 p-3 row">
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                اسم المسجد
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="name" required maxlength="190" class="form-control"
                                    value="{{ $mosque->name }}">
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                Longitude علي الخريطة
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="long" id="long" required class="form-control"
                                    value="{{ $mosque->long }}">
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                Latitude علي الخريطة
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="lat" id="lat" required class="form-control"
                                    value="{{ $mosque->lat }}">
                            </div>
                        </div>
                    </div>
                    <div id="map"></div>

                    <div class="row text-center">
                        <div class="col-12 p-3">
                            <button class="btn btn-success" id="submitEvaluation">حفظ</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        function initMap() {
            const myLatLng = {
                lat: {{ $mosque->lat }},
                lng: {{ $mosque->long }}
            };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 5,
                center: myLatLng,
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                draggable: true,
                map: map,
            });
            google.maps.event.addListener(map, "idle", function() {
                marker.setPosition(map.getCenter());
                document.getElementById("lat").value = map.getCenter().lat().toFixed(6);
                document.getElementById("long").value = map.getCenter().lng().toFixed(6);
            });

            google.maps.event.addListener(marker, "dragend", function(mapEvent) {
                map.panTo(mapEvent.latLng);
            });
        }

        window.initMap = initMap;
    </script>

    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key=AIzaSyCrsTVja4leOLfOxV6EfP1oSyQv_bpj7yg&callback=initMap"></script>
@endsection
