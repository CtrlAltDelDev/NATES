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
            if(isset($event['eventId'])) {
                echo "<li>";
                echo "<img class='speaker-thumb' src='db/{$event['speakerPhoto']}' alt='{$event['photoAlt']}'>";
                echo "<p>" . "<span style='font-weight: bold;'> " . $event["eventName"] . ": </span>"
                    . "Featuring special guest " . $event["firstName"] . " " . $event['lastName'] . " at "
                    . $event["venueName"] . " on " . $event["start"] . " <a href='event.php?event=" . $event['eventId'] . "'>Get Event Details</a>" . "</p>";
                echo "</li>";
            }
        }
        ?>
        <!--
        <li><img class="speaker-thumb" src="images/Speaker1_rounded_thumbnail.png" alt="thumbnail image of speaker"> <p>See speaker page for information on upcoming speakers</p></li>
        -->
    </ul>
</main>
