<?php
include("includes/header.php");
include("includes/nav.php");
include_once("db/dbconnect.php");
global $dbc;

// Check which form to show
$action = $_GET['action'] ?? 'login'; // default is login

if (isset($_GET['user_id'])) {
    $get_records_query = $dbc->prepare("SELECT * FROM `user_table` WHERE user_id = :user_id");
    $get_records_query->bindParam(':user_id', $_GET['user_id']);
    $get_records_query->execute();
}
?>


<main>
    <?php include("includes/flashMessage.php"); ?>
    <form method="post" action="db/loginaction.php">
        <fieldset>
            <?php if ($action === 'signup'): ?>
                <legend>Sign Up</legend>

                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name">

                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name">

                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone">

                <label for="email">Email</label>
                <input type="text" name="email" id="email">

                <label for="password">Password</label>
                <input type="password" name="password" id="password">

                <!-- Hidden User Role -->
                <input type="hidden" name="role" value="User">
                <br>
                <input type="submit" value="Sign up">
                <br><br>
                <p>Already have an account? </p>
                <a href="?action=login">Login</a>

            <?php else: ?>
                <legend>Login</legend>

                <label for="email" >Email</label>
                <input type="text" name="email" id="email" value="admin@admin.com">

                <label for="password">Password</label>
                <input type="password" name="password" id="password" value="password">
                <br>
                <input type="submit" value="Login">
                <br><br>
            <p>Don't have an account?</p>
                <a href="?action=signup"> Sign Up</a>
            <?php endif; ?>
        </fieldset>
    </form>
</main>

<?php include("includes/footer.php"); ?>
