<?php
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "You must be logged in to access this page!.";
    $_SESSION['message_type'] = "error";
    header("Location: login.php?action=login");
    exit;
}
?>
<fieldset>
    <legend>
        <a href="admin.php">Edit</a>
        <a href="addSpeaker.php">Add Speaker</a>
        <a href="addEvent.php">Add Event</a>
        <a href="addLocation.php">Add New Location</a>
        <a href="addUser.php">Add User</a>
    </legend>