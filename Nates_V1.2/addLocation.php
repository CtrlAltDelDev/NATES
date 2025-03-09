<?php
include("includes/header.php");
include("includes/nav.php");
include_once("db/dbconnect.php");
?>
<?php
echo '<main>';
echo '    <form method="post" action="db/add_location_action.php">';
echo '        <fieldset>';
echo '            <legend>';
echo '                <a href="admin.php">Edit</a>';
echo '                <a href="addUser.php">Add Speaker</a>';
echo '                <a href="addEvent.php">Add Event</a>';
echo '                <a href="addLocation.php">Add New Location</a>';
echo '                <a href="addUser.php">Add User</a>';
echo '            </legend>';

echo '            <label for="venue_name">Enter Venue Name</label>';
echo '            <input type="text" name="venue_name" id="venue_name">';

echo '            <label for="state">Enter State Abbreviation</label>';
echo '            <input type="text" name="state" id="state">';

echo '            <label for="city">Enter City Name</label>';
echo '            <input type="text" name="city" id="city">';

echo '            <label for="street_number">Enter Street Number</label>';
echo '            <input type="text" name="street_number" id="street_number">';

echo '            <label for="street_name">Enter Street Name</label>';
echo '            <input type="text" name="street_name" id="street_name">';

echo '            <label for="suite">Enter Suite Number</label>';
echo '            <input type="text" name="suite" id="suite">';

echo '            <label for="zipcode">Enter Zip Code</label>';
echo '            <input type="text" name="zipcode" id="zipcode">';

echo '            <label for="phone">Location Phone Number</label>';
echo '            <input type="text" name="phone" id="phone">';

echo '            <input type="submit" value="Submit">';
echo '        </fieldset>';
echo '    </form>';
echo '</main>';
?>
<?php
include("includes/footer.php");
?>
