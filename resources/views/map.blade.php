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
        center: {
          lat: 45.05,
          lng: 7.6667
        },
      }
      var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

      var autocomplete = new google.maps.places.Autocomplete(document.getElementById('search-autocomplete'));
      autocomplete.bindTo('bounds', map);

      var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
      });

      var infoWindow = new google.maps.InfoWindow();

      autocomplete.addListener('place_changed', function () {
        var place = autocomplete.getPlace()
        map.setCenter(place.geometry.location)
        map.setZoom(11)
        marker.setIcon({
          url: place.icon,
          size: new google.maps.Size(71, 71),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(17, 34),
          scaledSize: new google.maps.Size(35, 35)
        })
        marker.setPosition(place.geometry.location)
        marker.setVisible(true);
        var lat = place.geometry.location.lat()
        var lng = place.geometry.location.lng()
        $.ajax({
          url: 'mapsearch',
          type: 'get',
          dataType: 'json',
          data: {
            lat: lat,
            lng: lng
          }
        }).done(function (response) {
          var i
          var marker
          var store
          if (response.length !== 0) {
            for (i = 0; i < response.length; i++) {
              store = response[i]
              marker = new google.maps.Marker({
                position: new google.maps.LatLng(store.location[0], store.location[1]),
                map: map
              });
            }
          }
        })
      })
    }
    </script>

@endsection
