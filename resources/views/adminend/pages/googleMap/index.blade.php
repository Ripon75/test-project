@extends('adminend.layout.default')

@section('title')
    Google Map
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 mt-5">
            <div id="map" style="width: 100%; height:400px;"></div>
        </div>
    </div>
@endsection

@push('scripts')
 <!-- Load the Google Maps API with your API key -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCy_WrsGro8_JsfOE10xzZGlksRUOo0nDs&callback=initMap" async defer></script>

    <script>
        var map;
        var defaultLocation = { lat: -34.397, lng: 150.644 };

        function handleLocationError(browserHasGeolocation) {
            // Show error message
            var errorMessage = browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.';
            alert(errorMessage);
        }

        function getCurrentLatitudeLongitude() {
            // Check if Geolocation is supported by the browser
            if (navigator.geolocation) {
                // Get the current position
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;

                    // Call initMap with current location
                    initMap({ lat: lat, lng: lng });

                }, function() {
                    // Handle Geolocation error
                    handleLocationError(true);
                    // Fall back to default location
                    initMap(defaultLocation);
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false);
                // Fall back to default location
                initMap(defaultLocation);
            }
        }

        function initMap(centerLocation) {
            // Create a new map instance centered at the provided location
            map = new google.maps.Map(document.getElementById('map'), {
                center: centerLocation,
                zoom: 15
            });

            // Add a marker for the provided location
            var marker = new google.maps.Marker({
                position: centerLocation,
                map: map,
                title: 'Current Location'
            });
        }

        // Call getCurrentLatitudeLongitude to initiate obtaining current location
        getCurrentLatitudeLongitude();
    </script>
@endpush
