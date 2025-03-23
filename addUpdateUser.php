<?php
global $dbc;
include("includes/header.php");
include("includes/nav.php");
include_once("db/dbconnect.php");

// Fetch column names dynamically
$columns_query = $dbc->prepare("SHOW COLUMNS FROM user_table");
$columns_query->execute();
$columns = $columns_query->fetchAll(PDO::FETCH_COLUMN);

// Define fields to exclude from the form
$excluded_fields = ["user_id", "create_date"];
$form_fields = array_diff($columns, $excluded_fields);

// Initialize user data (empty for new users)
$user_data = array_fill_keys($form_fields, '');

// Check if editing an existing user
$editing = isset($_GET['user_id']);

if ($editing) {
    $get_records_query = $dbc->prepare("SELECT * FROM `user_table` WHERE user_id = :user_id");
    $get_records_query->bindParam(':user_id', $_GET['user_id']);
    $get_records_query->execute();
    $user_data = $get_records_query->fetch(PDO::FETCH_ASSOC) ?: $user_data; // Keep empty values if no match
}

echo '<main>';


$form_action = $_SERVER['PHP_SELF']; // Same page for processing

echo "<form method='post' action='$form_action'>";
include("includes/adminNav.php"); // fieldset // legend // nav area

foreach ($form_fields as $field) {
    $label = ucwords(str_replace('_', ' ', $field)); // Convert underscore to space and capitalize
    $value = htmlspecialchars($user_data[$field] ?? '');

    // Handle password separately (don't prefill for security reasons)
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

// Hidden input for existing user ID (if editing)
if ($editing) {
    echo "<input type='hidden' name='user_id' value='" . $_GET['user_id'] . "'>";
}

// Submit button text: "Update User" if editing, "Create User" otherwise
$button_text = $editing ? "Update User" : "Create User";
echo "<input type='submit' value='$button_text'>";

if (isset($_GET['error'])) {
    echo "<h3>Correct the following errors:</h3>";
    echo "<section class='error-message'>" . $_GET['error'] . "</section>";
}else{
    echo "<section class='success-message'>$button_text</section>";
}

echo "</fieldset>";
echo "</form>";
echo "</main>";

// Handle form submission for both Create and Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = [];
    $data = [];

    // Validate form fields
    foreach ($form_fields as $field) {
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

    if (empty($error)) {
        if (!empty($_POST['user_id'])) {  // UPDATE existing user
            $data['user_id'] = $_POST['user_id'];

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
        } else {  // CREATE new user
            $create_date = date('Y-m-d H:i:s');
            $data['create_date'] = $create_date;

            $insert_query = "INSERT INTO user_table (" . implode(", ", array_keys($data)) . ") VALUES (:" . implode(", :", array_keys($data)) . ")";
            $insert_stmt = $dbc->prepare($insert_query);
            $insert_stmt->execute($data);

            header("Location: success.php");
            exit();
        }
    } else {
        // If validation errors exist, redirect with error message
        $message = "<ul>";
        foreach ($error as $value) {
            $message .= "<li>$value</li>";
        }
        $message .= "</ul>";
        $message = urlencode($message);

        header("Location: " . $_SERVER['PHP_SELF'] . "?error=$message" . ($editing ? "&user_id=" . $_POST['user_id'] : ""));
        exit();
    }
}

include("includes/footer.php");
?>
