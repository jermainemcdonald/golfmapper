<?php
   $marker_array = getMarkerInfoFromDB($db,$filterby);
   print "<script type=\"text/javascript\"";
   print " src=\"https://maps.googleapis.com/maps/api/js?key=" . $config['apikeys']['googlemaps'] . "&sensor=false\">";
   print "</script>\n";
   print "<script type=\"text/javascript\">";
   $gmapsprint = '
      function initialize() {
         var mapOptions = { 
            zoom: 8, 
            mapTypeId: google.maps.MapTypeId.ROADMAP 
         };
         var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
         /* Set marker positions, titles, and texts for each championship course */
         var posArray = []; var titleArray = []; var contentArray = [];';
   
   // Create array of markers from fo in DB
   //$marker_array = getMarkerInfoFromDB($db,$filterby);
   foreach ($marker_array as $curr_marker) {
      $gmapsprint .=  "         posArray.push( new google.maps.LatLng("
                  . $curr_marker->getLatitude() . ", " . $curr_marker->getLongitude() . "));\n"
      		  . "         titleArray.push('" . $curr_marker->getCoursename() . "');\n"
      		  . "         contentArray.push('<p>" . $curr_marker->getDescription() . "</p>');\n";
   }
   $gmapsprint .= "
      var bounds = new google.maps.LatLngBounds();
         for (var i=0; i < posArray.length; ++i) {
            var marker = new google.maps.Marker({ position: posArray[i], map: map });
            marker.setTitle(titleArray[i]);
            marker.infoWindow = new google.maps.InfoWindow({ content: contentArray[i] });
            google.maps.event.addListener(marker,'click', function(){ this.infoWindow.open(map,this); });
            bounds.extend(posArray[i]);
         }
         map.fitBounds(bounds);
      }
      google.maps.event.addDomListener(window, 'load', initialize);";
   print $gmapsprint;
   
   print "</script>\n<div id='map-canvas'></div>";
   print $myfooter;
?>