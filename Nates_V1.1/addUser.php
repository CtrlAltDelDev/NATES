<?php
global $dbc;
include("includes/header.php");
include("includes/nav.php");
include_once("db/dbconnect.php");
?>
<?php
if (isset($_GET['userId'])) {
    $getRecordsQuery = $dbc->prepare("SELECT * FROM `userTable` WHERE userId = :userId");
    $getRecordsQuery->bindParam(':userId', $_GET['userId']);
    $getRecordsQuery->execute();
}

?>
<?php
echo '<main>';
echo '    <form method="post" action="db/addUserAction.php">';
echo '        <fieldset>';
echo '            <legend>';
echo '                <a href="admin.php">Edit</a>';
echo '                <a href="addUser.php">Add Speaker</a>';
echo '                <a href="addEvent.php">Add Event</a>';
echo '                <a href="addLocation.php">Add New Location</a>';
echo '                <a href="addUser.php">Add User</a>';
echo '            </legend>';
echo '            <label for="firstName">First Name</label>';
echo '            <input type="text" name="firstName" id="firstName">';

echo '            <label for="lastName">Last Name</label>';
echo '            <input type="text" name="lastName" id="lastName">';

echo '            <label for="phone">Phone Number</label>';
echo '            <input type="text" name="phone" id="phone">';

echo '            <label for="email">Email</label>';
echo '            <input type="text" name="email" id="email">';

echo '            <label for="password">Password</label>';
echo '            <input type="password" name="password" id="password">';

echo '            <label for="Role">User Role</label>';
echo '            <select name="Role" id="Role">';
echo '                <option value="Admin">Admin</option>';
echo '                <option value="User">User</option>';
echo '            </select>';
echo '            <br>';
echo '            <input type="submit" value="Submit">';
echo '        </fieldset>';
echo '    </form>';
echo '</main>';
?>
<?php
include("includes/footer.php");
?>