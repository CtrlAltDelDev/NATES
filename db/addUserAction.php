<?php
if(isset($_POST["firstName"])){
    $error = array();
    $data = array();
    if($_POST["firstName"] != ""){
        $firstName = $_POST["firstName"];
        $data["firstName"] = $firstName;
    }else{
        $error["firstName"] = "First name is required";
    }
    if($_POST["lastName"] != ""){
        $lastName = $_POST["lastName"];
        $data["lastName"] = $lastName;
    }else{
        $error["lastName"] = "Last name is required";
    }
    if($_POST["email"] != ""){
        $email = $_POST["email"];
        $data["email"] = $email;
    }else{
        $error["email"] = "Email is required";
    }
    if($_POST["password"] != ""){
        $password = $_POST["password"];
        $data["password"] = $password;
    }else{
        $error["password"] = "Password is required";
    }
    if($_POST["phone"] != ""){
        $phone = $_POST["phone"];
        $data["phone"] = $phone;
    }else{
        $error["phone"] = "Phone is required";
    }
    if($_POST["Role"] != ""){
        $Role = $_POST["Role"];
        $data["Role"] = $Role;
    }else{
        $error["Role"] = "Role is required";
    }
    if(empty($error)){
        include("../db/dbconnect.php");
        //if all fields filled in create date and update DB
        $createDate = date('Y-m-d H:i:s');
        $data['createDate'] = $createDate;

        $query = $dbc->prepare("INSERT INTO userTable(firstName, lastName, email, password, phone, Role, createDate) VALUES(:firstName, :lastName, :email, :password, :phone, :Role, :createDate)");
        $query->execute($data);
        header("location:../includes/success.php");
    }else{
        $message = "<ul>";
        foreach($error as $value)
        {
            $message .= "<li>$value</li>";
        }
        $message .= "</ul>";
        // header("location:../admin.php");
    }
}
?>