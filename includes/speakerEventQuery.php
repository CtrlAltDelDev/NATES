<?php
global $dbc;
require_once("db/dbconnect.php");

$speakerEventquery =  $dbc->prepare(
    "SELECT
           e.event_id,
    e.event_name,
    e.event_description,
    DATE_FORMAT(e.event_start, '%m/%d/%Y %h:%i %p') AS start,
    DATE_FORMAT(e.event_end, '%m/%d/%Y %h:%i %p') AS end,
    e.location_id,
    e.event_price,
    s.speaker_id,
    s.first_name,
    s.last_name,
    s.speaker_photo,
    s.photo_alt,
    l.venue_name
FROM speaker_table s
    LEFT JOIN event_table e ON e.speaker_id = s.speaker_id
    LEFT JOIN location_table l ON e.location_id = l.location_id
    ORDER BY e.event_start");
$speakerEventquery->execute();
?>