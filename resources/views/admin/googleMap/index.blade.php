@extends('admin.layout.default')

@section('title')
    Product list
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div id="map" style="width: 100%; height:300px;"></div>
        </div>
    </div>
@endsection

@push('scripts')
     <!-- Load the Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcH7h8OxJRiVuSAbNlVRVLDi-k8DyCnks&callback=initMap" async defer></script>

    <script>
        // Initialize the map
        function initMap() {
            // Create a new map instance
            var map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: -34.397, lng: 150.644 },
                zoom: 8
            });
        }
    </script>
@endpush
