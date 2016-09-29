<!DOCTYPE html>
<html>
  <head>
    <title>Map sederhana</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYZQVhUYLQ4FocL7BlvZ-s472PZooWd6c"></script>
    <script>
      map = new google.maps.Map(document.getElementById('map'), {
	center: {lat: -7.33432572, lng: 112.6365496},
	zoom: 10
      });
@foreach ($datamaps as $datamap)
      new google.maps.Marker({position: new google.maps.LatLng({{ $datamap->langitude }}, {{ $datamap->longitude }}), icon:'http://maps.google.com/mapfiles/ms/icons/blue-dot.png', title: '{{ $datamap->name }}', map: map });
@endforeach
      
    </script>
  </body>
</html>