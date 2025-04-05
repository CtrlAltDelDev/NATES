<?php
// TODO  import speakerID from speaker table
// TODO  import locationID from location table

global $dbc;
if (isset($_POST['event_name'])) {
    $error = array();
    $data = array();

    if ($_POST['event_name'] != "") {
        $event_name = $_POST['event_name'];
        $data['event_name'] = $event_name;
    } else {
        $error['event_name'] = "Event Name is required";
    }

    if ($_POST['speaker_id'] != "") {
        $speaker_id = intval($_POST['speaker_id']); // add intval to convert string to int
        $data['speaker_id'] = $speaker_id;
    } else {
        $error['speaker_id'] = "Speaker Name is required";
    }

    if ($_POST['event_description'] != "") {
        $event_description = $_POST['event_description'];
        $data['event_description'] = $event_description;
    } else {
        $error['event_description'] = "Event Description is required";
    }

    if ($_POST['event_start'] != "") {
        $event_start = $_POST['event_start'];
        $data['event_start'] = $event_start;
    } else {
        $error['event_start'] = "Event Start Date is required";
    }

    if ($_POST['event_end'] != "") {
        $event_end = $_POST['event_end'];
        $data['event_end'] = $event_end;
    } else {
        $error['event_end'] = "Event End Date is required";
    }

    if ($_POST['location_id'] != "") {
        $location_id = intval($_POST['location_id']); // add intval to convert string to int
        $data['location_id'] = $location_id;
    } else {
        $error['location_id'] = "Event Location is required";
    }

    if ($_POST['event_price'] != "") {
        $event_price = $_POST['event_price'];
        $data['event_price'] = $event_price;
    } else {
        $error['event_price'] = "Event Price is required";
    }

    if (empty($error)) {
        // test to see what is being passed into database query
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // end test

        include("../db/dbconnect.php");

        // if all fields are filled in, create date and update DB
        $creation_date = date('Y-m-d H:i:s');
        $data['creation_date'] = $creation_date;

        $query = $dbc->prepare("INSERT INTO event_table (event_name, speaker_id, event_description, event_start, event_end, location_id, event_price, creation_date) 
                                VALUES(:event_name, :speaker_id, :event_description, :event_start, :event_end, :location_id, :event_price, :creation_date)");
        $query->execute($data);
        // applies message to session super global
        $_SESSION['message'] = "Added successfully!";
        $_SESSION['message_type'] = "success";
        header("Location: ../addEvent.php");
        exit;

    } else {
        $message = "<ul>";
        foreach ($error as $value) {
            $message .= "<li>$value</li>";
        }
        $message .= "</ul>";
        $_SESSION["message"] = $message;
        $_SESSION['message_type'] = "error";
        header("location:../addEvent.php");
        exit;
    }
}
?>
