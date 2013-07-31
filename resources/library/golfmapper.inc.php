<?php

/* Class: Marker */
class Marker {
   // Properties
   var $coursename, $champion, $yearplayed, $latitude, $longitude, $description;
   
   // Getter Methods
   function getCoursename() { return $this->coursename; }
   function getChampion() { return $this->champion; }
   function getYearplayed() { return $this->yearplayed; }
   function getLatitude() { return $this->latitude; }
   function getLongitude() { return $this->longitude; }
   function getDescription() { return $this->description; }
   
   // Setter Methods
   function setCoursename($my_coursename) { $this->coursename = $my_coursename; }
   function setChampion($my_champion) { $this->description = $my_champion; }
   function setYearplayed($my_yearplayed) { $this->yearplayed = $my_yearplayed; }
   function setLatitude($my_latitude) { $this->description = $my_latitude; }
   function setLongitude($my_longitude) { $this->longitude = $my_longitude; }
   function setDescription($my_description) { $this->description = $my_description; }
   
   // Constructor Method
   function __construct($my_coursename, $my_champion, $my_yearplayed, $my_latitude, $my_longitude, $my_description) {
     $this->coursename = $my_coursename;
     $this->description = $my_champion;
     $this->yearplayed = $my_yearplayed;
     $this->latitude = $my_latitude;
     $this->longitude = $my_longitude;
     $this->description = $my_description;
   }

}

/* Function: getMarkerInfoFromDB( Database Handle, Where Clause )
 * Returns array of Markers for display.
 * Where Clause can be used to restrict list by a particular field such as
 * WHERE champion = 'Tiger Woods'; WHERE year > 2010; and the like
 */
function getMarkerInfoFromDB ($dbh, $where_clause) {
   $sql_statement = "SELECT ID, year, course_name, champion, latitude, longitude, description "
   		  . "FROM Info $where_clause "
   		  . "Order By year DESC";
   if(!$result = $dbh->query($sql_statement)){ die('Error running query: ' . $dbh->error); }
   $markersArray = array();
   while ($row = $result->fetch_assoc()) {
      // Store row elements
      $myid = $row['ID']; $myyear = $row['year']; $mycourse = $row['course_name'];
      $mychamp = $row['champion']; $mylat = $row['latitude']; $mylong = $row['longitude'];
      $mydesc = $row['description'];
      // Create Marker Object with the row info
      // Check if the course already has a marker
      if ( isset($markersArray[$mycourse]) ) {
         $new_description = $markersArray[$mycourse]->getDescription() . " $mychamp won here in $myyear.";
         $markersArray[$mycourse]->setDescription($new_description);
         continue; // Skip the rest and go to the next row of the dbh return
      }
      
      // Create new Marker object
      $current_marker = new Marker($mycourse,$mychamp,$myyear,$mylat,$mylong,$mydesc);
      // Push new Marker onto marker array
      $markersArray[$mycourse] = $current_marker;
   }
   $result->free();
   // Return array of markers
   return $markersArray;
}

/* Function: getChampionsFromDB( Database Handle )
 * Returns array of Champions for drop down menu.
 */
function getChampionsFromDB ($dbh) {
   $sql_statement = "SELECT DISTINCT champion FROM Info Order By champion";
   if(!$result = $dbh->query($sql_statement)){ die('Error running query: ' . $dbh->error); }
   $championsArray = array();
   while ($row = $result->fetch_assoc()) {
      array_push($championsArray,$row['champion']);
   }
   $result->free();
   // Return array of champions
   return $championsArray;
} 
?>