<?php
include("includes/header.php");
include("includes/nav.php");
include_once("db/dbconnect.php");
?>
<?php
echo '<main>';
echo '    <form method="post" enctype="multipart/form-data" action="db/add_speaker_action.php">';
echo '        <fieldset>';
echo '            <legend>';
echo '                <a href="admin.php">Edit</a>';
echo '                <a href="addUser.php">Add Speaker</a>';
echo '                <a href="addEvent.php">Add Event</a>';
echo '                <a href="addLocation.php">Add New Location</a>';
echo '                <a href="addUser.php">Add User</a>';
echo '            </legend>';
echo '            <label for="first_name">First Name</label>';
echo '            <input type="text" name="first_name" id="first_name">';

echo '            <label for="last_name">Last Name</label>';
echo '            <input type="text" name="last_name" id="last_name">';

echo '            <label for="email">Email Address</label>';
echo '            <input type="text" name="email" id="email">';

echo '            <label for="phone">Phone Number</label>';
echo '            <input type="text" name="phone" id="phone">';

echo '            <label for="speaker_links">Links</label>';
echo '            <input type="text" name="speaker_links" id="speaker_links">';

echo '            <label for="speaker_bio">Speaker Bio</label>';
echo '            <textarea name="speaker_bio" id="speaker_bio"></textarea>';

echo '            <label for="speaker_details">Additional Speaker Details</label>';
echo '            <textarea name="speaker_details" id="speaker_details"></textarea>';

echo '            <label for="speaker_photo">Select an Image</label>';
echo '            <input type="file" name="speaker_photo" id="speaker_photo" accept="image/jpeg">';

echo '            <label for="photo_alt">Photo Description</label>';
echo '            <input type="text" name="photo_alt" id="photo_alt">';

echo '            <input type="submit" value="Submit">';
echo '        </fieldset>';
echo '    </form>';
echo '</main>';
?>
<?php
include("includes/footer.php");
?>
