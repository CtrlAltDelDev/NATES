<?php
include("includes/header.php");
include("includes/nav.php");
include_once("db/dbconnect.php");
?>
<?php
echo '<main>';
echo '    <form method="post" enctype="multipart/form-data" action="db/addSpeakerAction.php">';
echo '        <fieldset>';
echo '            <legend>';
echo '                <a href="admin.php">Edit</a>';
echo '                <a href="addSpeaker.php">Add Speaker</a>';
echo '                <a href="addEvent.php">Add Event</a>';
echo '                <a href="addLocation.php">Add New Location</a>';
echo '                <a href="addUser.php">Add User</a>';
echo '            </legend>';
echo '            <label for="firstName">First Name</label>';
echo '            <input type="text" name="firstName" id="firstName">';

echo '            <label for="lastName">Last Name</label>';
echo '            <input type="text" name="lastName" id="lastName">';

echo '            <label for="email">Email Address</label>';
echo '            <input type="text" name="email" id="email">';

echo '            <label for="phone">Phone Number</label>';
echo '            <input type="text" name="phone" id="phone">';

echo '            <label for="speakerLinks">Links</label>';
echo '            <input type="text" name="speakerLinks" id="speakerLinks">';

echo '            <label for="speakerBio">Speaker Bio</label>';
echo '            <textarea name="speakerBio" id="speakerBio"></textarea>';

echo '            <label for="speakerDetails">Additional Speaker Details</label>';
echo '            <textarea name="speakerDetails" id="speakerDetails"></textarea>';

echo '            <label for="speakerPhoto">Select an Image</label>';
echo '            <input type="file" name="speakerPhoto" id="speakerPhoto" accept="image/jpeg">';

echo '            <label for="photoAlt">Photo Description</label>';
echo '            <input type="text" name="photoAlt" id="photoAlt">';

echo '            <input type="submit" value="Submit">';
echo '        </fieldset>';
echo '    </form>';
echo '</main>';
?>
<?php
include("includes/footer.php");
?>