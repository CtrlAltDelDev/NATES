<?php
global $dbc;
include("includes/header.php");
include("includes/nav.php");
include_once("db/dbconnect.php");

if (isset($_GET['user_id'])) {
    $get_records_query = $dbc->prepare("SELECT * FROM `user_table` WHERE user_id = :user_id");
    $get_records_query->bindParam(':user_id', $_GET['user_id']);
    $get_records_query->execute();

    echo '<main>';
    if (isset($_GET['error'])) {
        echo "<section>" . $_GET['error'] . "</section>";
    }
    echo "    <form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
    include("includes/adminNav.php"); // fieldset // legend // nav area

    while ($row = $get_records_query->fetch()) {
        echo "            <label for='first_name'>First Name</label>";
        echo "            <input type='text' name='first_name' id='first_name' value='" . htmlspecialchars($row['first_name']) . "'>";

        echo "            <label for='last_name'>Last Name</label>";
        echo "            <input type='text' name='last_name' id='last_name' value='" . htmlspecialchars($row['last_name']) . "'>";

        echo "            <label for='phone'>Phone Number</label>";
        echo "            <input type='text' name='phone' id='phone' value='" . htmlspecialchars($row['phone']) . "'>";

        echo "            <label for='email'>Email</label>";
        echo "            <input type='text' name='email' id='email' value='" . htmlspecialchars($row['email']) . "'>";

        echo "            <label for='password'>Password</label>";
        echo "            <input type='password' name='password' id='password' value=''>";

        echo "            <label for='role'>User Role</label>";
        echo "            <select name='role' id='role'>";
        if ($row['role'] == 'Admin') {
            echo "                <option value='Admin' selected>Admin</option>";
            echo "                <option value='User'>User</option>";
        } else {
            echo "                <option value='User' selected>User</option>";
            echo "                <option value='Admin'>Admin</option>";
        }
        echo "            </select>";
    }
    echo "            <input type='hidden' name='user_id' value='" . $_GET['user_id'] . "'>";
    echo "            <input type='submit' value='Update User'>";
    echo "        </fieldset>";
    echo "    </form>";
    echo "</main>";
}

// Handle form submission
elseif (isset($_POST['user_id'])) {
    $error = [];
    $data = [];

    // Fetch column names from `user_table`
    $columns_query = $dbc->prepare("SHOW COLUMNS FROM user_table");
    $columns_query->execute();
    $columns = $columns_query->fetchAll(PDO::FETCH_COLUMN);

    // Define required fields dynamically (excluding optional ones)
    $excluded_fields = ["user_id", "create_date"]; // Fields that should not be user-editable
    $required_fields = array_diff($columns, $excluded_fields);

    // Loop through dynamically fetched fields
    foreach ($required_fields as $field) {
        if (!empty($_POST[$field])) {
            $data[$field] = $_POST[$field];
        } else {
            $error[$field] = ucfirst(str_replace('_', ' ', $field)) . " is required";
        }
    }

    // Handle password separately for hashing
    if (!empty($_POST["password"])) {
        $data["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
    } else {
        unset($data["password"]); // Do not update password if left empty
    }

    // Ensure user_id is included for the update query
    $data['user_id'] = $_POST['user_id'];

    if (empty($error)) {
        $update_query = "UPDATE user_table SET ";
        $update_parts = [];

        foreach ($data as $key => $value) {
            $update_parts[] = "$key = :$key";
        }

        $update_query .= implode(", ", $update_parts) . " WHERE user_id = :user_id";
        $update_stmt = $dbc->prepare($update_query);

        $update_stmt->execute($data);
        header("Location: success.php");
        exit();
    } else {
        $message = "<ul>";
        foreach ($error as $value) {
            $message .= "<li>$value</li>";
        }
        $message .= "</ul>";
        $message = urlencode($message);

        header("Location: " . $_SERVER['PHP_SELF'] . "?error=$message&user_id=" . $_POST['user_id']);
        exit();
    }
}

include("includes/footer.php");
?>
