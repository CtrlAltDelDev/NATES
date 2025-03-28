<?php
session_start();
include("includes/header.php");
include("includes/nav.php");
include_once("db/dbconnect.php");
?>
<?php include("includes/flashMessage.php"); ?>

<?php
echo '<main>';
echo '    <form method="post" enctype="multipart/form-data" action="db/addSpeakerAction.php">';

include("includes/adminNav.php"); // fieldset // legend // nav area

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
echo '            <input type="file" name="speaker_photo" id="speaker_photo" accept=".png, .jpg, .jpeg, .gif">';

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
