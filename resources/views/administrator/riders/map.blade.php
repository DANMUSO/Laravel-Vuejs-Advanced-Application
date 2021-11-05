@extends('layouts.administrator')
@section('content')
<section class="content">
<div class="right_col" role="main">
          <div class="">
          <div class="clearfix"></div>
            <script>
              function initMap() {
                  var map;
                  var bounds = new google.maps.LatLngBounds();
                  var mapOptions = {
                      mapTypeId: 'roadmap'
                  };
                                  
                  // Display a map on the web page
                  map = new google.maps.Map(document.getElementById("map"), mapOptions);
                  map.setTilt(50);
                      
                  // Multiple markers location, latitude, and longitude
                  var markers = [
                    <?php 
                    foreach($map as $m){
                      echo '["'.$m->distance.'Km','",'.$m->lat.','.$m->lng.'],';
                    }   
                     ?>
                  ];
                                      
                  // Info window content
                  var infoWindowContent = [
                    <?php 
                    foreach($map as $m){
                      ?>
                    ['<div class="info_content" style="width:250px">' +
                    '<p><b>Name: <?php echo $m->riders->firstname;?>  <?php echo $m->riders->lastname;?> </b> </p>' +
                    '<p><b>Mobile No: <?php echo $m->riders->phone;?> </b> </p>' +
                    '<p><b>Number Plate: <?php echo $m->riders->numberplate;?> </b> </p>' +
                    '<p><img src="<?php echo $m->riders->image;?>" style="width:25%"/></p>'+'</div>'],
                    <?php
                    }   
                     ?>
                  ];
                      
                  // Add multiple markers to map
                  var infoWindow = new google.maps.InfoWindow(), marker, i;
                  
                  // Place each marker on the map  
                  for( i = 0; i < markers.length; i++ ) {
                      var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                      bounds.extend(position);
                      marker = new google.maps.Marker({
                          position: position,
                          map: map,
                          title: markers[i][0]
                      });
                      
                      // Add info window to marker    
                      google.maps.event.addListener(marker, 'click', (function(marker, i) {
                          return function() {
                              infoWindow.setContent(infoWindowContent[i][0]);
                              infoWindow.open(map, marker);
                          }
                      })(marker, i));

                      // Center the map to fit all markers on the screen
                      map.fitBounds(bounds);
                  }

                  // Set zoom level
                  var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
                      this.setZoom(12);
                      google.maps.event.removeListener(boundsListener);
                  });
                  
              }

              // Load initialize function
              google.maps.event.addDomListener(window, 'load', initMap);
              </script>
            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Riders Current Locations
                    
                    </h2>
                    <div id="map"></div>
                    <div class="clearfix"></div>
                  </div>
                 
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
          </div>
        </div>
   
      <!-- /.container-fluid -->
    </section>

@endsection