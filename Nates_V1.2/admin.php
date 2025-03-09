<?php
global $dbc;
include("includes/header.php");
include("includes/nav.php");
include_once("db/dbconnect.php");
?>
<?php
$speaker_query =  $dbc->prepare("SELECT speaker_id, first_name, last_name FROM speaker_table ORDER BY last_name");
$speaker_query->execute();
$event_query =  $dbc->prepare("SELECT event_id, event_name FROM event_table ORDER BY event_name");
$event_query->execute();
$location_query =  $dbc->prepare("SELECT location_id, venue_name FROM location_table ORDER BY venue_name");
$location_query->execute();
$user_query =  $dbc->prepare("SELECT user_id, first_name, last_name FROM user_table ORDER BY user_id");
$user_query->execute();
?>
<main>
    <form>
        <fieldset>
            <legend>
                <a href="admin.php">Edit</a>
                <a href="addUser.php">Add Speaker</a>
                <a href="addEvent.php">Add Event</a>
                <a href="addLocation.php">Add New Location</a>
                <a href="addUser.php">Add User</a>
            </legend>
            <?php if ($speaker_query->rowCount() > 0) { ?>
                <h2>Edit Speakers</h2>
                <ul>
                    <?php while ($row = $speaker_query->fetch()) {
                        echo "                <li>" . $row['first_name'] . " " . $row['last_name'] .  " (<a href='editSpeaker.php?speaker_id=" . $row['speaker_id'] . "'>edit</a>)</li>
";}?>
                </ul>
            <?php } if ($event_query->rowCount() > 0) { ?>
                <h2>Edit Events</h2>
                <ul>
                    <?php while ($row = $event_query->fetch()) {
                        echo "                <li>" . $row['event_name'] . " (<a href='editEvent.php?event_id=" . $row['event_id'] . "'>edit</a>)</li>
"; }?>
                </ul>
            <?php } if ($location_query->rowCount() > 0) { ?>
                <h2>Edit Locations</h2>
                <ul>
                    <?php while ($row = $location_query->fetch()) {
                        echo "                <li>" . $row['venue_name'] . " (<a href='editLocation.php?location_id=" . $row['location_id'] . "'>edit</a>)</li>
";}?>
                </ul>
            <?php } if ($user_query->rowCount() > 0) { ?>
                <h2>Edit Users</h2>
                <ul>
                    <?php while ($row = $user_query->fetch()) {
                        echo "                <li>" . $row['first_name'] . " " . $row['last_name'] . " (<a href='updateUser.php?user_id=" . $row['user_id'] . "'>edit</a>)</li>
";}?>
                </ul>
            <?php } ?>
        </fieldset>
    </form>
</main>
<?php include("includes/footer.php"); ?>
