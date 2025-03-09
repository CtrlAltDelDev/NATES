<?php
include("includes/header.php");
include("includes/nav.php");
include_once("db/dbconnect.php");
?>
<?php
require_once("db/dbconnect.php");
$speakerquery = $dbc -> prepare("SELECT speakerId, firstName, lastName FROM speakerTable ORDER BY lastName");
$speakerquery -> execute();

$locationquery = $dbc -> prepare("SELECT locationId, venueName FROM locationTable ORDER BY venueName");
$locationquery -> execute();
?>
<?php
echo '<main>';
echo '    <form method="post" action="db/addEventAction.php">';
echo '        <fieldset>';
echo '            <legend>';
echo '                <a href="admin.php">Edit</a>';
echo '                <a href="addUser.php">Add Speaker</a>';
echo '                <a href="addEvent.php">Add Event</a>';
echo '                <a href="addLocation.php">Add New Location</a>';
echo '                <a href="addUser.php">Add User</a>';
echo '            </legend>';

echo '            <label for="eventName">Event Name</label>';
echo '            <input type="text" name="eventName" id="eventName">';

echo '            <label for="speakerId">Select Speaker</label>';
echo '            <select name="speakerId" id="speakerId">';
echo '                <option value="NULL">Make A Selection</option>';

        while ($speaker = $speakerquery->fetch()) {
            echo "<option value='{$speaker['speakerId']}'>" . $speaker['firstName'] . " " . $speaker['lastName'] . "</option>";
        }

echo '            </select>';

echo '            <label for="locationId">Event Location</label>';
echo '            <select name="locationId" id="locationId">';
echo '                <option value="NULL">Make A Selection</option>';

        while ($location = $locationquery->fetch()) {
            echo "<option value='{$location['locationId']}'>" . $location['venueName'] . "</option>";
        }

echo '            </select>';

echo '            <label for="eventStart">Event Date</label>';
echo '            <input type="datetime-local" name="eventStart" id="eventStart">';

echo '            <label for="eventEnd">Event Ends At</label>';
echo '            <input type="datetime-local" name="eventEnd" id="eventEnd">';

echo '            <label for="eventPrice">Admission Price</label>';
echo '            <input type="text" name="eventPrice" id="eventPrice">';

echo '            <label for="eventDescription">Event Details</label>';
echo '            <textarea name="eventDescription" id="eventDescription"></textarea>';

echo '            <input type="submit" value="Submit">';
echo '        </fieldset>';
echo '    </form>';
echo '</main>';
?>

<?php
include("includes/footer.php");
?>