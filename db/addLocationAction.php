<?php
global $dbc;
if (isset($_POST['venue_name'])) {
    $error = array();
    $data = array();

    if ($_POST['venue_name'] != "") {
        $venue_name = $_POST['venue_name'];
        $data['venue_name'] = $venue_name;
    } else {
        $error[] = "Venue Name is required";
    }

    if ($_POST['state'] != "") {
        $state = $_POST['state'];
        $data['state'] = $state;
    } else {
        $error[] = "State is required";
    }

    if ($_POST['city'] != "") {
        $city = $_POST['city'];
        $data['city'] = $city;
    } else {
        $error[] = "City is required";
    }

    if ($_POST['street_number'] != "") {
        $street_number = $_POST['street_number'];
        $data['street_number'] = $street_number;
    } else {
        $error[] = "Street Number is required";
    }

    if ($_POST['street_name'] != "") {
        $street_name = $_POST['street_name'];
        $data['street_name'] = $street_name;
    } else {
        $error[] = "Street Name is required";
    }

    if ($_POST['suite'] != "") {
        $suite = $_POST['suite'];
        $data['suite'] = $suite;
    } else {
        $data['suite'] = NULL;
    }

    if ($_POST['zipcode'] != "") {
        $zipcode = $_POST['zipcode'];
        $data['zipcode'] = $zipcode;
    } else {
        $error[] = "Zip code is required";
    }

    if ($_POST['phone'] != "") {
        $phone = $_POST['phone'];
        $data['phone'] = $phone;
    } else {
        $error[] = "Phone is required";
    }

    if (empty($error)) {
        include("../db/dbconnect.php");
        $query = $dbc->prepare("INSERT INTO location_table (venue_name, state, city, street_number, street_name, suite, zipcode, phone) 
                                VALUES (:venue_name, :state, :city, :street_number, :street_name, :suite, :zipcode, :phone)");
        $query->execute($data);
        // applies message to session super global
        $_SESSION['message'] = "Added successfully!";
        $_SESSION['message_type'] = "success";
        header("Location: ../addLocation.php");
        exit;

    } else {
        $message = "<ul>";
        foreach ($error as $value) {
            $message .= "<li>$value</li>";
        }
        $message .= "</ul>";
        $_SESSION["message"] = $message;
        $_SESSION['message_type'] = "error";
        header("location:../addLocation.php");
        exit;
    }
}
?>
