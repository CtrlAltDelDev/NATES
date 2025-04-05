<?php
global $dbc;
include("includes/header.php");
include("includes/nav.php");
include_once("db/dbconnect.php");

if (isset($_GET['event_id'])) {
    $get_records_query = $dbc->prepare("SELECT * FROM `event_table` WHERE event_id = :event_id");
    $get_records_query->bindParam(':event_id', $_GET['event_id']);
    $get_records_query->execute();

    echo '<main>';
    if (isset($_GET['error'])) {
        echo "<section>" . $_GET['error'] . "</section>";
    }
    echo "    <form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";

    include("includes/flashMessage.php");
    include("includes/adminNav.php"); // fieldset // legend // nav area

    while ($row = $get_records_query->fetch()) {
        echo "            <label for='event_name'>Event Name</label>";
        echo "            <input type='text' name='event_name' id='event_name' value='" . htmlspecialchars($row['event_name']) . "'>";

        echo "            <label for='speaker_id'>Select Speaker</label>";
        echo "            <select name='speaker_id' id='speaker_id'>";
        echo "                <option value='NULL'>Make A Selection</option>";

        $speaker_query = $dbc->prepare("SELECT * FROM speaker_table");
        $speaker_query->execute();

        while ($speaker = $speaker_query->fetch()) {
            $selected = ($speaker['speaker_id'] == $row['speaker_id']) ? "selected" : "";
            echo "<option value='{$speaker['speaker_id']}' $selected>" . htmlspecialchars($speaker['first_name']) . " " . htmlspecialchars($speaker['last_name']) . "</option>";
        }

        echo "            </select>";

        echo "            <label for='location_id'>Event Location</label>";
        echo "            <select name='location_id' id='location_id'>";
        echo "                <option value='NULL'>Make A Selection</option>";

        $location_query = $dbc->prepare("SELECT * FROM location_table");
        $location_query->execute();

        while ($location = $location_query->fetch()) {
            $selected = ($location['location_id'] == $row['location_id']) ? "selected" : "";
            echo "<option value='{$location['location_id']}' $selected>" . htmlspecialchars($location['venue_name']) . "</option>";
        }

        echo "            </select>";

        echo "            <label for='event_start'>Event Date</label>";
        echo "            <input type='datetime-local' name='event_start' id='event_start' value='" . htmlspecialchars($row['event_start']) . "'>";

        echo "            <label for='event_end'>Event Ends At</label>";
        echo "            <input type='datetime-local' name='event_end' id='event_end' value='" . htmlspecialchars($row['event_end']) . "'>";

        echo "            <label for='event_price'>Admission Price</label>";
        echo "            <input type='text' name='event_price' id='event_price' value='" . htmlspecialchars($row['event_price']) . "'>";

        echo "            <label for='event_description'>Event Details</label>";
        echo "            <textarea name='event_description' id='event_description'>" . htmlspecialchars($row['event_description']) . "</textarea>";
    }
    echo "            <input type='hidden' name='event_id' value='" . $_GET['event_id'] . "'>";
    echo "            <input type='submit' value='Update Event'>";
    echo "        </fieldset>";
    echo "    </form>";
    echo "</main>";
}

// Handle form submission
elseif (isset($_POST['event_id'])) {
    $error = array();
    $data = array();

    if (!empty($_POST["event_name"])) {
        $data["event_name"] = $_POST["event_name"];
    } else {
        $error["event_name"] = "Event name is required";
    }

    if (!empty($_POST["speaker_id"]) && $_POST["speaker_id"] != "NULL") {
        $data["speaker_id"] = $_POST["speaker_id"];
    } else {
        $error["speaker_id"] = "Please select a speaker";
    }

    if (!empty($_POST["location_id"]) && $_POST["location_id"] != "NULL") {
        $data["location_id"] = $_POST["location_id"];
    } else {
        $error["location_id"] = "Please select a location";
    }

    if (!empty($_POST["event_start"])) {
        $data["event_start"] = $_POST["event_start"];
    } else {
        $error["event_start"] = "Event start date is required";
    }

    if (!empty($_POST["event_end"])) {
        $data["event_end"] = $_POST["event_end"];
    } else {
        $error["event_end"] = "Event end date is required";
    }

    if (!empty($_POST["event_price"])) {
        $data["event_price"] = $_POST["event_price"];
    } else {
        $error["event_price"] = "Event price is required";
    }

    if (!empty($_POST["event_description"])) {
        $data["event_description"] = $_POST["event_description"];
    }

    $data['event_id'] = $_POST['event_id'];

    if (empty($error)) {
        $update_query = $dbc->prepare("
            UPDATE event_table 
            SET event_name = :event_name, 
                speaker_id = :speaker_id, 
                location_id = :location_id, 
                event_start = :event_start, 
                event_end = :event_end, 
                event_price = :event_price, 
                event_description = :event_description
            WHERE event_id = :event_id
        ");

        // Debugging: Check what data is being passed
        // print_r($data); // Uncomment this line for debugging

        $update_query->execute($data);
        // applies message to session super global
        $_SESSION['message'] = "Added successfully!";
        $_SESSION['message_type'] = "success";
        header("Location: " . $_SERVER['PHP_SELF'] . "?event_id=" .$_POST['event_id']);
        exit;

    } else {
        $message = "<ul>";
        foreach ($error as $value) {
            $message .= "<li>$value</li>";
        }
        $message .= "</ul>";
        $_SESSION["message"] = $message;
        $_SESSION['message_type'] = "error";
        header("Location: " . $_SERVER['PHP_SELF'] . "?error=$message&event_id=" . $_POST['event_id']);
        exit();
    }
}

include("includes/footer.php");
?>
