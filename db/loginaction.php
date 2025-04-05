<?php
session_start();
global $dbc;
include("../db/dbconnect.php");
unset($_SESSION['message']);
unset($_SESSION['message_type']);

// Detect if this is a signup or login request
$isSignup = isset($_POST["first_name"]); // if first_name is posted, it's a signup

if ($isSignup) {
    // === SIGN UP LOGIC ===
    $error = [];
    $data = [];

    if (!empty($_POST["first_name"])) {
        $data["first_name"] = $_POST["first_name"];
    } else {
        $error["first_name"] = "First name is required";
    }

    if (!empty($_POST["last_name"])) {
        $data["last_name"] = $_POST["last_name"];
    } else {
        $error["last_name"] = "Last name is required";
    }

    if (!empty($_POST["email"])) {
        $data["email"] = $_POST["email"];
    } else {
        $error["email"] = "Email is required";
    }

    if (!empty($_POST["password"])) {
        $data["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
    } else {
        $error["password"] = "Password is required";
    }

    if (!empty($_POST["phone"])) {
        $data["phone"] = $_POST["phone"];
    } else {
        $error["phone"] = "Phone number is required";
    }

    if (!empty($_POST["role"])) {
        $data["role"] = $_POST["role"];
    } else {
        $error["role"] = "Role is required";
    }

    if (empty($error)) {
        $data["create_date"] = date('Y-m-d H:i:s');

        $query = $dbc->prepare("INSERT INTO user_table (first_name, last_name, email, password, phone, role, create_date) 
                                VALUES (:first_name, :last_name, :email, :password, :phone, :role, :create_date)");
        $query->execute($data);

        $_SESSION["message"] = "Sign-up successful! Please log in.";
        $_SESSION["message_type"] = "success";
        header("Location: ../login.php?action=login");
        exit;
    } else {
        // Handle validation errors
        $message = "<ul>";
        foreach ($error as $msg) {
            $message .= "<li>$msg</li>";
        }
        $message .= "</ul>";

        $_SESSION["message"] = $message;
        $_SESSION["message_type"] = "error";
        header("Location: ../login.php?action=signup");
        exit;
    }

} else {
    // === LOGIN LOGIC ===
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';

    if (empty($email) || empty($password)) {
        $_SESSION["message"] = "Email and password are required.";
        $_SESSION["message_type"] = "error";

        // ✅ This is all you need:
        header("Location: ../login.php?action=login");
        exit;
    }


    // Look for user by email
    $query = $dbc->prepare("SELECT * FROM user_table WHERE email = :email LIMIT 1");
    $query->execute(['email' => $email]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $_SESSION["message"] = "No user found with that email address.";
        $_SESSION["message_type"] = "error";

        $message = $_SESSION["message"]; // assign session message to variable

        header("Location: ../login.php?action=login&error=" . urlencode($message));
        exit;
    }

    if (!password_verify($password, $user["password"])) {
        $_SESSION["message"] = "Incorrect password.";
        $_SESSION["message_type"] = "error";
        header("Location: ../login.php?action=login");

        exit;
    }

    // Login success
    $_SESSION["user_id"] = $user["user_id"];
    $_SESSION["user_name"] = $user["first_name"];
    $_SESSION["message"] = "Welcome back, " . ($user['first_name']) . ' ' . ($user['last_name']) . '!';
    $_SESSION["message_type"] = "success";
    header("Location: ../admin.php");
    exit;
}


?>
