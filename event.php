<?php include 'includes/header.php'; ?>
<?php include 'includes/nav.php'; ?>
<?php include 'includes/heroSlide.php'; ?>
<?php
global $dbc;
require_once("db/dbconnect.php");

$eventId = $_GET['event'];
$speakerEventquery =  $dbc->prepare(
    "SELECT
        e.eventId,
        e.eventName,
        e.eventDescription,
        DATE_FORMAT(e.eventStart, '%m/%d/%Y') AS startDate,
        DATE_FORMAT(e.eventStart, '%h:%i %p') AS startTime,
        DATE_FORMAT(e.eventEnd, '%h:%i %p') AS endTime,
        e.locationID,
        e.eventPrice,
        s.speakerBio,
        s.speakerDetails,
        s.speakerId,
        s.firstName,
        s.lastName,
        s.speakerPhoto,
        s.photoAlt,
        l.venueName
    FROM eventTable e
    INNER JOIN speakerTable s ON e.speakerId = s.speakerId
    INNER JOIN locationTable l ON e.locationID = l.locationId
    WHERE e.eventId = :eventId");
$speakerEventquery->bindParam("eventId", $eventId);
$speakerEventquery->execute();
?>


<main>
    <div class="speaker-container">
        <figure id="photo">
            <?php
            while ($event = $speakerEventquery->fetch(PDO::FETCH_ASSOC)) {
                echo "<img src='db/{$event['speakerPhoto']}' alt='{$event['photoAlt']}'>";
                echo "<figcaption>" . $event['photoAlt'] . "</figcaption></figure>";
                echo "        <div class='speaker' id='bio'>";
                echo "            <h1>" .$event['eventName'] . "</h1>";
                echo "            <p>Join Us at " . $event['venueName'] . "</p>";
                echo "            <p> Featuring Special Guest " . $event['firstName'] . " " . $event['lastName'] . "</p>";
                echo "            <p> The event will be held on " . $event['startDate'] . " at " . $event['startTime'] . " and ends at " . $event['endTime'] . "</p>";
                echo "            <p>This event will cost $" . $event['eventPrice'] . "</p>";
                echo "            <h4>Event Description</h4>";
                echo "            <p>" . $event['eventDescription'] . "</p>";
                echo "        </div>";
                echo "    </div>";
                echo "    <div id='details'>";
                echo "        <h2>About " . $event['firstName'] . "</h2>";
                echo "        <p>" . $event['speakerBio'] . "</p>";
                echo "        <p>" . $event['speakerDetails'] . "</p>";
                echo "    </div>";
                echo "</main>";
            }
            ?>
<?php include 'includes/footer.php'; ?>
