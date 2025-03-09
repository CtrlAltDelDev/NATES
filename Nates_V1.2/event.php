<?php include 'includes/header.php'; ?>
<?php include 'includes/nav.php'; ?>
<?php include 'includes/heroSlide.php'; ?>
<?php
global $dbc;
require_once("db/dbconnect.php");

$event_id = $_GET['event'];
$speaker_event_query =  $dbc->prepare(
    "SELECT
        e.event_id,
        e.event_name,
        e.event_description,
        DATE_FORMAT(e.event_start, '%m/%d/%Y') AS start_date,
        DATE_FORMAT(e.event_start, '%h:%i %p') AS start_time,
        DATE_FORMAT(e.event_end, '%h:%i %p') AS end_time,
        e.location_id,
        e.event_price,
        s.speaker_bio,
        s.speaker_details,
        s.speaker_id,
        s.first_name,
        s.last_name,
        s.speaker_photo,
        s.photo_alt,
        l.venue_name
    FROM event_table e
    INNER JOIN speaker_table s ON e.speaker_id = s.speaker_id
    INNER JOIN location_table l ON e.location_id = l.location_id
    WHERE e.event_id = :event_id");
$speaker_event_query->bindParam("event_id", $event_id);
$speaker_event_query->execute();
?>

<main>
    <div class="speaker-container">
        <figure id="photo">
            <?php
            while ($event = $speaker_event_query->fetch(PDO::FETCH_ASSOC)) {
                echo "<img src='db/{$event['speaker_photo']}' alt='{$event['photo_alt']}'>";
                echo "<figcaption>" . $event['photo_alt'] . "</figcaption></figure>";
                echo "        <div class='speaker' id='bio'>";
                echo "            <h1>" .$event['event_name'] . "</h1>";
                echo "            <p>Join Us at " . $event['venue_name'] . "</p>";
                echo "            <p> Featuring Special Guest " . $event['first_name'] . " " . $event['last_name'] . "</p>";
                echo "            <p> The event will be held on " . $event['start_date'] . " at " . $event['start_time'] . " and ends at " . $event['end_time'] . "</p>";
                echo "            <p>This event will cost $" . $event['event_price'] . "</p>";
                echo "            <h4>Event Description</h4>";
                echo "            <p>" . $event['event_description'] . "</p>";
                echo "        </div>";
                echo "    </div>";
                echo "    <div id='details'>";
                echo "        <h2>About " . $event['first_name'] . "</h2>";
                echo "        <p>" . $event['speaker_bio'] . "</p>";
                echo "        <p>" . $event['speaker_details'] . "</p>";
                echo "    </div>";
                echo "</main>";
            }
            ?>
            <?php include 'includes/footer.php'; ?>
