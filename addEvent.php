<?php
global $dbc;
include("includes/header.php");
include("includes/nav.php");
include_once("db/dbconnect.php");
?>

<?php
require_once("db/dbconnect.php");
$speaker_query = $dbc->prepare("SELECT speaker_id, first_name, last_name FROM speaker_table ORDER BY last_name");
$speaker_query->execute();

$location_query = $dbc->prepare("SELECT location_id, venue_name FROM location_table ORDER BY venue_name");
$location_query->execute();
?>

<?php
echo '<main>';
echo '    <form method="post" action="db/add_event_action.php">';
                include("includes/adminNav.php"); // <fieldset> // <legend>// nav area

echo '            <label for="event_name">Event Name</label>';
echo '            <input type="text" name="event_name" id="event_name">';

echo '            <label for="speaker_id">Select Speaker</label>';
echo '            <select name="speaker_id" id="speaker_id">';
echo '                <option value="NULL">Make A Selection</option>';

while ($speaker = $speaker_query->fetch()) {
    echo "<option value='{$speaker['speaker_id']}'>" . $speaker['first_name'] . " " . $speaker['last_name'] . "</option>";
}

echo '            </select>';

echo '            <label for="location_id">Event Location</label>';
echo '            <select name="location_id" id="location_id">';
echo '                <option value="NULL">Make A Selection</option>';

while ($location = $location_query->fetch()) {
    echo "<option value='{$location['location_id']}'>" . $location['venue_name'] . "</option>";
}

echo '            </select>';

echo '            <label for="event_start">Event Date</label>';
echo '            <input type="datetime-local" name="event_start" id="event_start">';

echo '            <label for="event_end">Event Ends At</label>';
echo '            <input type="datetime-local" name="event_end" id="event_end">';

echo '            <label for="event_price">Admission Price</label>';
echo '            <input type="text" name="event_price" id="event_price">';

echo '            <label for="event_description">Event Details</label>';
echo '            <textarea name="event_description" id="event_description"></textarea>';

echo '            <input type="submit" value="Submit">';
echo '        </fieldset>';
echo '    </form>';
echo '</main>';
?>

<?php
include("includes/footer.php");
?>
