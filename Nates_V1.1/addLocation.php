<?php
include("includes/header.php");
include("includes/nav.php");
include_once("db/dbconnect.php");
?>
<?php
echo '<main>';
echo '    <form method="post" action="db/addLocationAction.php">';
echo '        <fieldset>';
echo '            <legend>';
echo '                <a href="admin.php">Edit</a>';
echo '                <a href="addUser.php">Add Speaker</a>';
echo '                <a href="addEvent.php">Add Event</a>';
echo '                <a href="addLocation.php">Add New Location</a>';
echo '                <a href="addUser.php">Add User</a>';
echo '            </legend>';

echo '            <label for="venueName">Enter Venue Name</label>';
echo '            <input type="text" name="venueName" id="venueName">';

echo '            <label for="state">Enter State Abbreviation</label>';
echo '            <input type="text" name="state" id="state">';

echo '            <label for="city">Enter City Name</label>';
echo '            <input type="text" name="city" id="city">';

echo '            <label for="streetNumber">Enter Street Number</label>';
echo '            <input type="text" name="streetNumber" id="streetNumber">';

echo '            <label for="streetName">Enter Street Name</label>';
echo '            <input type="text" name="streetName" id="streetName">';

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