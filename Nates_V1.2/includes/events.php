<?php include 'includes/speakerEventQuery.php'; ?>
<main id="event-container">
    <?php
    if($speakerEventquery->rowCount() > 0){
      echo  "<h1>Check out our upcoming events</h1>";

    }else{
        echo "<h1>Check Back Soon For Upcoming Events...</h1>";

    }
    ?>
    <ul>
        <?php
        while($event = $speakerEventquery->fetch()) {
            echo "<li>";
            echo "<img class='speaker-thumb' src='db/{$event['speaker_photo']}' alt='{$event['photo_alt']}'>";
            echo "<p>" . "<span style='font-weight: bold;'> " . $event["event_name"] . ": </span>"
                . "Featuring special guest " . $event["first_name"] . " " . $event['last_name'] . " at "
                . $event["venue_name"] . " on " . $event["start"] . " <a href='event.php?event=" . $event['event_id'] . "'>Get Event Details</a>" . "</p>";
            echo "</li>";

        }
        ?>
        <!--
        <li><img class="speaker-thumb" src="images/Speaker1_rounded_thumbnail.png" alt="thumbnail image of speaker"> <p>See speaker page for information on upcoming speakers</p></li>
        -->
    </ul>
</main>
