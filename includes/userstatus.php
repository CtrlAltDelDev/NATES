<?php
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
$_SESSION['message'] = "You must be logged in to access this page!.";
$_SESSION['message_type'] = "error";
header("Location: login.php?action=login");
exit;
}
?>