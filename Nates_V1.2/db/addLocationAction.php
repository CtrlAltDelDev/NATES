<?php
if (isset($_POST['venue_name'])) {
    $errors = array();
    $data = array();

    if ($_POST['venue_name'] != "") {
        $venue_name = $_POST['venue_name'];
        $data['venue_name'] = $venue_name;
    } else {
        $errors[] = "Venue Name is required";
    }

    if ($_POST['state'] != "") {
        $state = $_POST['state'];
        $data['state'] = $state;
    } else {
        $errors[] = "State is required";
    }

    if ($_POST['city'] != "") {
        $city = $_POST['city'];
        $data['city'] = $city;
    } else {
        $errors[] = "City is required";
    }

    if ($_POST['street_number'] != "") {
        $street_number = $_POST['street_number'];
        $data['street_number'] = $street_number;
    } else {
        $errors[] = "Street Number is required";
    }

    if ($_POST['street_name'] != "") {
        $street_name = $_POST['street_name'];
        $data['street_name'] = $street_name;
    } else {
        $errors[] = "Street Name is required";
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
        $errors[] = "Zip code is required";
    }

    if ($_POST['phone'] != "") {
        $phone = $_POST['phone'];
        $data['phone'] = $phone;
    } else {
        $errors[] = "Phone is required";
    }

    if (empty($errors)) {
        include("../db/dbconnect.php");
        $query = $dbc->prepare("INSERT INTO location_table (venue_name, state, city, street_number, street_name, suite, zipcode, phone) 
                                VALUES (:venue_name, :state, :city, :street_number, :street_name, :suite, :zipcode, :phone)");
        $query->execute($data);
        header("location:../success.php");
    } else {
        $message = "<ul>";
        foreach ($errors as $value) {
            $message .= "<li>$value</li>";
        }
        $message .= "</ul>";
        echo $message;
        echo "<a href='../addLocation.php'>Go Back</a>";
        // header("location:../addEvent.php");
    }
}
?>
