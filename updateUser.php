<?php
session_start();
global $dbc;
include("includes/header.php");
include("includes/nav.php");
include_once("db/dbconnect.php");

if (isset($_GET['user_id'])) {
    // Fetch all columns from `user_table`
    $columns_query = $dbc->prepare("SHOW COLUMNS FROM user_table");
    $columns_query->execute();
    $columns = $columns_query->fetchAll(PDO::FETCH_COLUMN);

    // Define fields to exclude from the form
    $excluded_fields = ["user_id", "create_date"];
    $form_fields = array_diff($columns, $excluded_fields);

    // Fetch user data
    $get_records_query = $dbc->prepare("SELECT * FROM `user_table` WHERE user_id = :user_id");
    $get_records_query->bindParam(':user_id', $_GET['user_id']);
    $get_records_query->execute();
    $user_data = $get_records_query->fetch(PDO::FETCH_ASSOC);

    echo '<main>';
    if (isset($_GET['error'])) {
        echo "<section>" . $_GET['error'] . "</section>";
    }
    include("includes/flashMessage.php");
    echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
    include("includes/adminNav.php"); // fieldset // legend // nav area

    foreach ($form_fields as $field) {
        $label = ucfirst(str_replace('_', ' ', $field)); // Capitalize field name for label
        $value = isset($user_data[$field]) ? htmlspecialchars($user_data[$field]) : '';

        // Handle password field separately (don't prefill)
        if ($field === "password") {
            echo "<label for='$field'>$label</label>";
            echo "<input type='password' name='$field' id='$field' value=''>";
        }
        // Handle role as a dropdown
        elseif ($field === "role") {
            echo "<label for='$field'>$label</label>";
            echo "<select name='$field' id='$field'>";
            echo $value === "Admin"
                ? "<option value='Admin' selected>Admin</option><option value='User'>User</option>"
                : "<option value='User' selected>User</option><option value='Admin'>Admin</option>";
            echo "</select>";
        }
        // All other fields as text inputs
        else {
            echo "<label for='$field'>$label</label>";
            echo "<input type='text' name='$field' id='$field' value='$value'>";
        }
    }

    echo "<input type='hidden' name='user_id' value='" . $_GET['user_id'] . "'>";
    echo "<input type='submit' value='Update User'>";
    echo "</fieldset>";
    echo "</form>";
    echo "</main>";
}

// Handle form submission
elseif (isset($_POST['user_id'])) {
    $error = [];
    $data = [];

    // Fetch column names dynamically
    $columns_query = $dbc->prepare("SHOW COLUMNS FROM user_table");
    $columns_query->execute();
    $columns = $columns_query->fetchAll(PDO::FETCH_COLUMN);

    // Exclude non-editable fields
    $excluded_fields = ["user_id", "create_date"];
    $editable_fields = array_diff($columns, $excluded_fields);

    // Validate form fields
    foreach ($editable_fields as $field) {
        if (!empty($_POST[$field])) {
            $data[$field] = $_POST[$field];
        } else {
            $error[$field] = ucfirst(str_replace('_', ' ', $field)) . " is required";
        }
    }

    // Handle password separately (hashing if provided)
    if (!empty($_POST["password"])) {
        $data["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
    } else {
        unset($data["password"]); // Skip updating password if left empty
    }

    // Ensure user_id is included for updating the right record
    $data['user_id'] = $_POST['user_id'];

    if (empty($error)) {
        // Dynamically build the UPDATE query
        $update_parts = [];
        foreach ($data as $key => $value) {
            $update_parts[] = "$key = :$key";
        }

        $update_query = "UPDATE user_table SET " . implode(", ", $update_parts) . " WHERE user_id = :user_id";
        $update_stmt = $dbc->prepare($update_query);
        $update_stmt->execute($data);
        session_start();
        // applies message to session super global
        $_SESSION['message'] = "Added successfully!";
        $_SESSION['message_type'] = "success";

        header("Location: " . $_SERVER['PHP_SELF'] . "?error=$message&user_id=" .$_POST['user_id']);
        exit;

    } else {
        $message = "<ul>";
        foreach ($error as $value) {
            $message .= "<li>$value</li>";
        }
        $message .= "</ul>";
        session_start();
        $_SESSION["message"] = $message;
        $_SESSION['message_type'] = "error";

        header("Location: " . $_SERVER['PHP_SELF'] . "?error=$message&user_id=" . $_POST['user_id']);
        exit();
    }
}
include("includes/footer.php");
?>
