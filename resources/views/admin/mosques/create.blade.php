@extends('layouts.app', ['page_title' => 'إضافة مسجد'])
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
                action="{{ route('admin.mosques.store') }}">
                @csrf
                <div class="col-12 col-lg-8 p-0 main-box mx-auto">
                    <div class="col-12 px-0 card-header">
                        <div class="col-12 px-3 py-3">
                            <span class="fas fa-info-circle"></span> إضافة جديد
                        </div>
                    </div>
                    <div class="col-12 p-3 row">
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                اسم المسجد
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="name" required maxlength="255" class="form-control"
                                    value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                Longitude علي الخريطة
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="long" id="long" class="form-control"
                                    value="{{ old('long') }}">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                Latitude علي الخريطة
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="lat" id="lat" class="form-control"
                                    value="{{ old('lat') }}">
                            </div>
                        </div>
                    </div>
                    <div id="map"></div>
                    {{--  <button class="btn btn-success" type="button" onclick="getLocation()">تحديد موقعك</button>  --}}
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
                lat: 24.707263,
                lng: 46.761855
            };
            const map = new google.maps.Map(document.getElementById("map"), {
                center: myLatLng,
                zoom: 18
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                draggable: true,
                map: map,
            });

            const locationButton = document.createElement("button");

            locationButton.textContent = "Pan to Current Location";
            locationButton.classList.add("custom-map-control-button");
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
            locationButton.addEventListener("click", () => {
                // Try HTML5 geolocation.
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            const pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude,
                            };

                            marker.setPosition(pos);
                            map.setCenter(pos);
                            map.setZoom(18);
                        },
                        () => {
                            handleLocationError(true, infoWindow, map.getCenter());
                        }
                    );
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }
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
