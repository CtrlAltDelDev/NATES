<?php
require_once("db/dbconnect.php");
$speakerquery = $dbc -> prepare("SELECT speakerId, firstName, lastName FROM speakerTable ORDER BY lastName");
$speakerquery -> execute();

$locationquery = $dbc -> prepare("SELECT locationId, venueName FROM locationTable ORDER BY venueName");
$locationquery -> execute();
?>
<main>
    <form method="post" action="db/addEventAction.php">
        <fieldset>
            <legend>
                <a href="admin.php">Add Speaker</a>
                <a href="adminEvent.php">Add Event</a>
                <a href="adminLocation.php">Add New Location</a>
                <a href="adminUser.php">Add User</a>
            </legend>
            <label for="eventName">Event Name</label>
            <input type="text" name="eventName" id="eventName">

            <label for="speakerId">Select Speaker</label>
            <select name="speakerId" id="speakerId">
                <option value="NULL">Make A Selection</option>
                <?php
                while ($speaker = $speakerquery -> fetch()) {
                    echo "<option value='{$speaker['speakerId']}'>" . $speaker['firstName'] . " " . $speaker['lastName'] . "</option>";
                }
                ?>
            </select>

            <label for="locationId">Event Location</label>
            <select name="locationId" id="locationId">
                <option value="NULL">Make A Selection</option>
                <?php
                while ($location = $locationquery -> fetch()) {
                    echo "<option value='{$location['locationId']}'>" . $location['venueName'] . "</option>";
                }
                ?>

            </select>

            <label for="eventStart">Event Date</label>
            <input type="datetime-local" name="eventStart" id="eventStart">

            <label for="eventEnd">Event Ends At</label>
            <input type="datetime-local" name="eventEnd" id="eventEnd">

            <label for="eventPrice">Admission Price</label>
            <input type="text" name="eventPrice" id="eventPrice">

            <label for="eventDescription">Event Details</label>
            <textarea name="eventDescription" id="eventDescription"></textarea>
            <input type="submit" value="Submit">
        </fieldset>
    </form>
</main>