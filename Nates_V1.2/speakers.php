<?php include 'includes/header.php'; ?>
<?php include 'includes/nav.php'; ?>
<?php include 'includes/heroSlide.php'; ?>
<?php include 'includes/speakerEventQuery.php'; ?>
<main>
    <h1> Get To Know Our Speakers</h1>
    <?php
    while ($event = $speakerEventquery->fetch()) {
        echo "    <div class='speakers-container-item'>";
        echo "<img src='db/{$event['speaker_photo']}' alt='{$event['photo_alt']}'>";
        echo "<p>"
            . "About " . $event["first_name"] . " " . $event['last_name']  . " <a href='speaker.php?event=" . $event['event_id'] . "'>Get Speaker Details</a>" ."</p>";
        echo "    </div>";
    }
    ?>
</main>
<?php include 'includes/footer.php'; ?>
