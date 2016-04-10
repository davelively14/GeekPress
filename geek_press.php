<?php

/*
 * Plugin Name: GeekPress
 * Plugin URI: https://github.com/davelively14/GeekPress
 * Description: This is a template tag plugin for WordPress that will connect with BandsInTown (BIT) API.
 * Version: 0.1
 * Author: Dave Lively
 */

// CONTENT
// Change these constants to adjust the content to be displayed in the returned
// HTML code for given functions.
//

// DEFAULTS
// These constants set defaults for many of the functions.
//
// Sets the default city for geographic searches
define('DEFAULT_CITY_STR', 'Atlanta');
// Sets the default state for geographic searches
define('DEFAULT_STATE_STR', 'GA');
// Sets the default URL parameter to identify affiliation
define('DEFAULT_AFIL_ID', '?aid=11390');
// Sets the default client ID parameter
define('DEFAULT_CLIENT_ID', '?client_id=Mjk3NjA3N3wxNDYwMjQ3OTc5');

// SYSTEM CONSTANTS
// Don't change these. These are SeatGeek API specific
//
define('URL_PERFORMERS_STR', 'https://api.seatgeek.com/2/performers?');
//
define('URL_EVENT_STR', 'https://api.seatgeek.com/2/events/');

function get_events_performer($query) {
  $query_url = prep_string($query);
  $raw_json = file_get_contents(URL_PERFORMERS_STR."q=".$query_url.DEFAULT_CLIENT_ID);
  printf(URL_PERFORMERS_STR."q=".$query_url.DEFAULT_CLIENT_ID."\n");
  return json_decode($raw_json, true);
}

function get_event($query) {
  $raw_json = file_get_contents(URL_EVENT_STR.$query.DEFAULT_CLIENT_ID);
  printf(URL_EVENT_STR.$query.DEFAULT_CLIENT_ID."\n");
  return $raw_json;
  // return json_decode($raw_json, true);
}

function prep_string($string) {
  //Lower case everything
  $string = strtolower($string);
  //Make alphanumeric (removes all other characters)
  $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
  //Clean up multiple dashes or whitespaces
  $string = preg_replace("/[\s-]+/", " ", $string);
  //Convert whitespaces and underscore to dash
  $string = preg_replace("/[\s_]/", "-", $string);
  return $string;
}

printf(get_event("2932833")."\n");

?>
