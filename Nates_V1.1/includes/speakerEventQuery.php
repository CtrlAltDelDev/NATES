<?php
global $dbc;
require_once("db/dbconnect.php");

// $speakerEventquery = $dbc->prepare("SELECT eventId, speakerId, eventName, eventDescription, DATE_FORMAT(eventStart, '%m/%d/%Y %h:%i %p') AS start, DATE_FORMAT(eventEnd, '%m/%d/%Y %h:%i %p') AS end, locationID, eventPrice FROM eventTable ORDER BY eventStart");

$speakerEventquery =  $dbc->prepare(
    "SELECT
        e.eventId,
        e.eventName,
        e.eventDescription,
        DATE_FORMAT(e.eventStart, '%m/%d/%Y %h:%i %p') AS start,
        DATE_FORMAT(e.eventEnd, '%m/%d/%Y %h:%i %p') AS end,
        e.locationID,
        e.eventPrice,
        s.speakerId,
        s.firstName,
        s.lastName,
        s.speakerPhoto,
        s.photoAlt,
        l.venueName
    FROM speakerTable s
    LEFT JOIN eventTable e ON e.speakerId = s.speakerId
    LEFT JOIN locationTable l ON e.locationID = l.locationId
    ORDER BY e.eventStart");
$speakerEventquery->execute();
?>