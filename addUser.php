<?php
global $dbc;
include("includes/header.php");
include("includes/nav.php");
include_once("db/dbconnect.php");
?>
<?php
if (isset($_GET['user_id'])) {
    $get_records_query = $dbc->prepare("SELECT * FROM `user_table` WHERE user_id = :user_id");
    $get_records_query->bindParam(':user_id', $_GET['user_id']);
    $get_records_query->execute();
}
?>
<?php
echo '<main>';
echo '    <form method="post" action="db/add_user_action.php">';
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

echo '            <label for="phone">Phone Number</label>';
echo '            <input type="text" name="phone" id="phone">';

echo '            <label for="email">Email</label>';
echo '            <input type="text" name="email" id="email">';

echo '            <label for="password">Password</label>';
echo '            <input type="password" name="password" id="password">';

echo '            <label for="role">User Role</label>';
echo '            <select name="role" id="role">';
echo '                <option value="Admin">Admin</option>';
echo '                <option value="User">User</option>';
echo '            </select>';
echo '            <br>';
echo '            <input type="submit" value="Submit">';
echo '        </fieldset>';
echo '    </form>';
echo '</main>';
?>
<?php include("includes/footer.php"); ?>
