<?php
session_start();

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
<?php include("includes/flashMessage.php"); ?>

<?php
echo '<main>';
echo '    <form method="post" action="db/addUserAction.php">';
                include("includes/adminNav.php"); // fieldset // legend // nav area

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
