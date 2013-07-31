<?php

/*
	The important thing to realize is that the config file should be included in every
	page of your project, or at least any page you want access to these settings.
	This allows you to confidently use these settings throughout a project because
	if something changes such as your database credentials, or a path to a specific resource,
	you'll only need to update it here.
*/

/* To get dbname use --> $config["db"]["dbname"] */
$config = array(
	"db" => array(
			"dbname"   => "jermaine_golfmapper",
			"username" => "jermaine_testing",
			"password" => "t3st4m@c",
			"host"     => "localhost",
			"port"     => "",
			"driver"   => "mysql",
			"prefix" => "",	
	),
	"urls" => array(
			"baseUrl" => "http://golfmapper.jermainemcdonald.com"
	),
	"paths" => array(
			"resources" => "resources",
			"images" => array(
					"content" => $_SERVER["DOCUMENT_ROOT"] . "/golfmapper/images/content",
					"layout" => $_SERVER["DOCUMENT_ROOT"] . "/golfmapper/images/layout"
		)
	),
	"apikeys" => array (
			"googlemaps" => "AIzaSyAm0gbpW8v6umD4syb_BLWSVn2ZF-Sc2us"
	)
);

/*
	Creating constants for heavily used paths makes things a lot easier.
	ex. require_once(LIBRARY_PATH . "Paginator.php")
*/
defined("LIBRARY_PATH")
	or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));
	
defined("TEMPLATES_PATH")
	or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));

/*	Error reporting.	*/
ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRCT);

?>