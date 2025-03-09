<?php
global $dbc;
include("includes/header.php");
include("includes/nav.php");
include_once("db/dbconnect.php");
?>
<?php
$speakerQuery =  $dbc->prepare("SELECT speakerId, firstName, lastName FROM speakerTable order by lastName");
$speakerQuery->execute();
$eventQuery =  $dbc->prepare("SELECT eventId, eventName FROM eventTable order by eventName");
$eventQuery->execute();
$locationQuery =  $dbc->prepare("SELECT locationId, venueName FROM locationTable order by venueName");
$locationQuery->execute();
$userQuery =  $dbc->prepare("SELECT userId, firstName, lastName FROM userTable order by userId");
$userQuery->execute();
?>
<main>
    <form>
        <fieldset>
            <legend>
                <a href="admin.php">Edit</a>
                <a href="addSpeaker.php">Add Speaker</a>
                <a href="addEvent.php">Add Event</a>
                <a href="addLocation.php">Add New Location</a>
                <a href="addUser.php">Add User</a>
            </legend>
<?php if($speakerQuery->rowCount() > 0) {?>
            <h2>Edit Speakers</h2>
            <ul>
<?php while ($row = $speakerQuery->fetch()) {
echo "                <li>" . $row['firstName'] . " " . $row['lastName'] .  " (<a href='editSpeaker.php?speakerId=" . $row['speakerId'] . "'>edit</a>)</li>
";}?>
            </ul>
<?php } if($eventQuery->rowCount() > 0) {?>
            <h2>Edit Events</h2>
            <ul>
<?php while ($row = $eventQuery->fetch()) {
echo "                <li>" . $row['eventName'] . " (<a href='editEvent.php?eventId=" . $row['eventId'] . "'>edit</a>)</li>
"; }?>
            </ul>
<?php } if($locationQuery->rowCount() > 0) { ?>
            <h2>Edit Locations</h2>
            <ul>
<?php while ($row = $locationQuery->fetch()) {
echo "                <li>" . $row['venueName'] . " (<a href='editLocation.php?locationId=" . $row['locationId'] . "'>edit</a>)</li>
";}?>
            </ul>
<?php } if($userQuery->rowCount() > 0) { ?>
            <h2>Edit Users</h2>
            <ul>
<?php while ($row = $userQuery->fetch()) {
echo "                <li>" . $row['firstName'] . " " . $row['lastName'] . " (<a href='updateUser.php?userId=" . $row['userId'] . "'>edit</a>)</li>
";}?>
            </ul>
<?php } ?>
        </fieldset>
    </form>
</main>
<?php include("includes/footer.php"); ?>