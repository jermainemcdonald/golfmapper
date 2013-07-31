<?php      
   // load up your config file  
   require_once("resources/config.php");
   require_once("resources/library/golfmapper.inc.php");
   
   // Connect to database
   $db = new mysqli($config['db']['host'], $config['db']['username'], $config['db']['password'], $config['db']['dbname']);
   if($db->connect_errno > 0){ die('Unable to connect to database [' . $db->connect_error . ']'); }
?>  

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" 
      content="This page maps the locations of all the U.S. Open Golf Championships played in the 21st century." />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<title>Locations of U.S. Open Golf Championships Since 2000</title>

<link rel="STYLESHEET" href="css/golfmapper.css" type="text/css" />
<script src="js/golfmapper.js" type="text/javascript"></script>
</head>
<body>
<div id="container">
<div id="selectionpanel">
   <p>This page shows the locations and winners of each U.S. Open Golf Championship played from 2000 to this year.</p>
</div>
<div id="content">
<?php      
   require_once("golfmapper.php");
?>
</div>
<div id="footer">
Produced by Jermaine McDonald for http://golftracker.jermainemcdonald.com ©2013
</div>
</div>
</body>
</html>
<?php $db->close(); ?>