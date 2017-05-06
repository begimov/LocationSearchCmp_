@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div id="map-canvas" style="width: 100%; height: 500px;"></div>
        </div>
    </div>

    <script type="text/javascript">
    function initMap() {

      var mapOptions = {
        zoom: 4,
        center: new google.maps.LatLng({{$items[0]->location}})
      }
      var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);


      @foreach($items as $item)
      var marker{{$item->id}} = new google.maps.Marker({
        position: new google.maps.LatLng({{$item->location}}),
        map: map,
        title: "{{$item->title}}"
      });
      @endforeach
    }

    </script>


@endsection
