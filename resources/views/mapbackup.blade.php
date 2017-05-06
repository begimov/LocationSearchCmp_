@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
          <div class="search form-group">
            <h4 class="title">Поиск ближайших акций</h4>
            <p>Укажите ваше местоположение и мы покажем вам ближайшие акции</p>
            <input type="text" id="search-autocomplete" class="form-control" name="" value="">
          </div>
            <div id="map-canvas" style="width: 100%; height: 500px;"></div>
        </div>
    </div>

    <script type="text/javascript">
    function initMap() {
      var mapOptions = {
        zoom: 11,
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

      var autocomplete = new google.maps.places.Autocomplete(document.getElementById('search-autocomplete'));
      autocomplete.bindTo('bounds', map);
    }
    </script>

@endsection
