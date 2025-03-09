<?php include 'includes/header.php'; ?>
<?php include 'includes/nav.php'; ?>
<?php include 'includes/heroSlide.php'; ?>
<?php include 'includes/speakerEventQuery.php'; ?>
<main>
    <h1> Get To Know Our Speakers</h1>
    <?php
    while($event = $speakerEventquery->fetch()) {
        echo "    <div class = 'speakers-container-item'>";
        echo "<img src='db/{$event['speakerPhoto']}' alt='{$event['photoAlt']}'>";
        echo "<p>"
            . "About  " . $event["firstName"] . " " . $event['lastName']  . " <a href='speaker.php?speakerId=" . $event['eventId'] . "'>Get Speaker Details</a>" ."</p>";
        echo "    </div>";
    }
    ?>
</main>
<?php include 'includes/footer.php'; ?>

