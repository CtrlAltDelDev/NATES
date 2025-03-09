<?php
include("includes/header.php");
include("includes/nav.php");
include_once("db/dbconnect.php");

if (isset($_GET['eventId'])) {
    $getRecordsQuery = $dbc->prepare("SELECT * FROM `eventTable` WHERE eventId = :eventId");
    $getRecordsQuery->bindParam(':eventId', $_GET['eventId']);
    $getRecordsQuery->execute();

    echo '<main>';
    if (isset($_GET['error'])) {
        echo "<section>" . $_GET['error'] . "</section>";
    }
    echo "    <form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
    include("includes/adminNav.php"); // fieldset // legend // nav area

    while ($row = $getRecordsQuery->fetch()) {
        echo "            <label for='eventName'>Event Name</label>";
        echo "            <input type='text' name='eventName' id='eventName' value='" . htmlspecialchars($row['eventName']) . "'>";

        echo "            <label for='speakerId'>Select Speaker</label>";
        echo "            <select name='speakerId' id='speakerId'>";
        echo "                <option value='NULL'>Make A Selection</option>";

        $speakerQuery = $dbc->prepare("SELECT * FROM speakerTable");
        $speakerQuery->execute();

        while ($speaker = $speakerQuery->fetch()) {
            $selected = ($speaker['speakerId'] == $row['speakerId']) ? "selected" : "";
            echo "<option value='{$speaker['speakerId']}' $selected>" . htmlspecialchars($speaker['firstName']) . " " . htmlspecialchars($speaker['lastName']) . "</option>";
        }

        echo "            </select>";

        echo "            <label for='locationId'>Event Location</label>";
        echo "            <select name='locationId' id='locationId'>";
        echo "                <option value='NULL'>Make A Selection</option>";

        $locationQuery = $dbc->prepare("SELECT * FROM locationTable");
        $locationQuery->execute();

        while ($location = $locationQuery->fetch()) {
            $selected = ($location['locationId'] == $row['locationId']) ? "selected" : "";
            echo "<option value='{$location['locationId']}' $selected>" . htmlspecialchars($location['venueName']) . "</option>";
        }

        echo "            </select>";

        echo "            <label for='eventStart'>Event Date</label>";
        echo "            <input type='datetime-local' name='eventStart' id='eventStart' value='" . htmlspecialchars($row['eventStart']) . "'>";

        echo "            <label for='eventEnd'>Event Ends At</label>";
        echo "            <input type='datetime-local' name='eventEnd' id='eventEnd' value='" . htmlspecialchars($row['eventEnd']) . "'>";

        echo "            <label for='eventPrice'>Admission Price</label>";
        echo "            <input type='text' name='eventPrice' id='eventPrice' value='" . htmlspecialchars($row['eventPrice']) . "'>";

        echo "            <label for='eventDescription'>Event Details</label>";
        echo "            <textarea name='eventDescription' id='eventDescription'>" . htmlspecialchars($row['eventDescription']) . "</textarea>";
    }
    echo "            <input type='hidden' name='eventId' value='" . $_GET['eventId'] . "'>";
    echo "            <input type='submit' value='Update Event'>";
    echo "        </fieldset>";
    echo "    </form>";
    echo "</main>";
}

// Handle form submission
elseif (isset($_POST['eventId'])) {
    $error = array();
    $data = array();

    if (!empty($_POST["eventName"])) {
        $data["eventName"] = $_POST["eventName"];
    } else {
        $error["eventName"] = "Event name is required";
    }

    if (!empty($_POST["speakerId"]) && $_POST["speakerId"] != "NULL") {
        $data["speakerId"] = $_POST["speakerId"];
    } else {
        $error["speakerId"] = "Please select a speaker";
    }

    if (!empty($_POST["locationId"]) && $_POST["locationId"] != "NULL") {
        $data["locationId"] = $_POST["locationId"];
    } else {
        $error["locationId"] = "Please select a location";
    }

    if (!empty($_POST["eventStart"])) {
        $data["eventStart"] = $_POST["eventStart"];
    } else {
        $error["eventStart"] = "Event start date is required";
    }

    if (!empty($_POST["eventEnd"])) {
        $data["eventEnd"] = $_POST["eventEnd"];
    } else {
        $error["eventEnd"] = "Event end date is required";
    }

    if (!empty($_POST["eventPrice"])) {
        $data["eventPrice"] = $_POST["eventPrice"];
    } else {
        $error["eventPrice"] = "Event price is required";
    }

    if (!empty($_POST["eventDescription"])) {
        $data["eventDescription"] = $_POST["eventDescription"];
    }

    $data['eventId'] = $_POST['eventId'];

    if (empty($error)) {
        $updatequery = $dbc->prepare("
            UPDATE eventTable 
            SET eventName = :eventName, 
                speakerId = :speakerId, 
                locationId = :locationId, 
                eventStart = :eventStart, 
                eventEnd = :eventEnd, 
                eventPrice = :eventPrice, 
                eventDescription = :eventDescription
            WHERE eventId = :eventId
        ");

        // Debugging: Check what data is being passed
        // print_r($data); // Uncomment this line for debugging

        $updatequery->execute($data);

        header("Location: success.php");
        exit();
    } else {
        $message = "<ul>";
        foreach ($error as $value) {
            $message .= "<li>$value</li>";
        }
        $message .= "</ul>";
        $message = urlencode($message);

        header("Location: " . $_SERVER['PHP_SELF'] . "?error=$message&eventId=" . $_POST['eventId']);
        exit();
    }
} else {
    header("Location: addEvent.php");
    exit();
}

include("includes/footer.php");
?>
