<?php
global $dbc;
if (isset($_POST["first_name"])) {
    $error = array();
    $data = array();

    if ($_POST["first_name"] != "") {
        $first_name = $_POST["first_name"];
        $data["first_name"] = $first_name;
    } else {
        $error["first_name"] = "First name is required";
    }

    if ($_POST["last_name"] != "") {
        $last_name = $_POST["last_name"];
        $data["last_name"] = $last_name;
    } else {
        $error["last_name"] = "Last name is required";
    }

    if ($_POST["email"] != "") {
        $email = $_POST["email"];
        $data["email"] = $email;
    } else {
        $error["email"] = "Email is required";
    }

    if ($_POST["password"] != "") {
        $password = $_POST["password"];
        $data["password"] = $password;
    } else {
        $error["password"] = "Password is required";
    }

    if ($_POST["phone"] != "") {
        $phone = $_POST["phone"];
        $data["phone"] = $phone;
    } else {
        $error["phone"] = "Phone is required";
    }

    if ($_POST["role"] != "") {
        $role = $_POST["role"];
        $data["role"] = $role;
    } else {
        $error["role"] = "Role is required";
    }

    if (empty($error)) {
        include("../db/dbconnect.php");
        // if all fields filled in, create date and update DB
        $create_date = date('Y-m-d H:i:s');
        $data['create_date'] = $create_date;

        $query = $dbc->prepare("INSERT INTO user_table (first_name, last_name, email, password, phone, role, create_date) VALUES (:first_name, :last_name, :email, :password, :phone, :role, :create_date)");
        $query->execute($data);
        header("location:../success.php");
    } else {
        $message = "<ul>";
        foreach ($error as $value) {
            $message .= "<li>$value</li>";
        }
        $message .= "</ul>";
        echo $message;
        echo "<a href='../addUser.php'>Go Back</a>";
        // header("location:../admin.php");
    }
}
?>