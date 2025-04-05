<?php
session_start();
// Save the message in a temporary variable
$message = "You have been logged out successfully.";
$message_type = "success";

// Clear the session
session_unset();
session_destroy();

// Restart session to set flash message after destroy
$_SESSION["message"] = $message;
$_SESSION["message_type"] = $message_type;

header("Location: login.php");
exit;
