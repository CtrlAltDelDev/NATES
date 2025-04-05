<?php
global $dbc;
include("includes/header.php");
include("includes/nav.php");
include_once("db/dbconnect.php");

if (isset($_GET['location_id'])) {
    $get_records_query = $dbc->prepare("SELECT * FROM `location_table` WHERE location_id = :location_id");
    $get_records_query->bindParam(':location_id', $_GET['location_id']);
    $get_records_query->execute();

    echo '<main>';
    if (isset($_GET['error'])) {
        echo "<section>" . $_GET['error'] . "</section>";
    }
    echo "    <form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
    include("includes/flashMessage.php");
    include("includes/adminNav.php"); // fieldset // legend // nav area

    while ($row = $get_records_query->fetch()) {
        echo "            <label for='venue_name'>Enter Venue Name</label>";
        echo "            <input type='text' name='venue_name' id='venue_name' value='" . htmlspecialchars($row['venue_name']) . "'>";

        echo "            <label for='state'>Enter State Abbreviation</label>";
        echo "            <input type='text' name='state' id='state' value='" . htmlspecialchars($row['state']) . "'>";

        echo "            <label for='city'>Enter City Name</label>";
        echo "            <input type='text' name='city' id='city' value='" . htmlspecialchars($row['city']) . "'>";

        echo "            <label for='street_number'>Enter Street Number</label>";
        echo "            <input type='text' name='street_number' id='street_number' value='" . htmlspecialchars($row['street_number']) . "'>";

        echo "            <label for='street_name'>Enter Street Name</label>";
        echo "            <input type='text' name='street_name' id='street_name' value='" . htmlspecialchars($row['street_name']) . "'>";

        echo "            <label for='suite'>Enter Suite Number</label>";
        echo "            <input type='text' name='suite' id='suite' value='" . htmlspecialchars($row['suite'] ?? ' ') . "'>";

        echo "            <label for='zipcode'>Enter Zip Code</label>";
        echo "            <input type='text' name='zipcode' id='zipcode' value='" . htmlspecialchars($row['zipcode']) . "'>";

        echo "            <label for='phone'>Location Phone Number</label>";
        echo "            <input type='text' name='phone' id='phone' value='" . htmlspecialchars($row['phone']) . "'>";
    }
    echo "            <input type='hidden' name='location_id' value='" . $_GET['location_id'] . "'>";
    echo "            <input type='submit' value='Update Location'>";
    echo "        </fieldset>";
    echo "    </form>";
    echo "</main>";
}

// Handle form submission
elseif (isset($_POST['location_id'])) {
    $error = array();
    $data = array();

    if (!empty($_POST["venue_name"])) {
        $data["venue_name"] = $_POST["venue_name"];
    } else {
        $error["venue_name"] = "Venue name is required";
    }

    if (!empty($_POST["state"])) {
        $data["state"] = $_POST["state"];
    } else {
        $error["state"] = "State abbreviation is required";
    }

    if (!empty($_POST["city"])) {
        $data["city"] = $_POST["city"];
    } else {
        $error["city"] = "City name is required";
    }

    if (!empty($_POST["street_number"])) {
        $data["street_number"] = $_POST["street_number"];
    } else {
        $error["street_number"] = "Street number is required";
    }

    if (!empty($_POST["street_name"])) {
        $data["street_name"] = $_POST["street_name"];
    } else {
        $error["street_name"] = "Street name is required";
    }

    if (!empty($_POST["suite"])) {
        $data["suite"] = $_POST["suite"];
    }

    if (!empty($_POST["zipcode"])) {
        $data["zipcode"] = $_POST["zipcode"];
    } else {
        $error["zipcode"] = "Zip code is required";
    }

    if (!empty($_POST["phone"])) {
        $data["phone"] = $_POST["phone"];
    } else {
        $error["phone"] = "Phone number is required";
    }

    $data['location_id'] = $_POST['location_id'];

    if (empty($error)) {
        $update_query = $dbc->prepare("
            UPDATE location_table 
            SET venue_name = :venue_name, 
                state = :state, 
                city = :city, 
                street_number = :street_number, 
                street_name = :street_name, 
                suite = :suite, 
                zipcode = :zipcode, 
                phone = :phone
            WHERE location_id = :location_id
        ");

        // Debugging: Check what data is being passed
        // print_r($data); // Uncomment this line for debugging

        $update_query->execute($data);

        // applies message to session super global
        $_SESSION['message'] = "Added successfully!";
        $_SESSION['message_type'] = "success";
        header("Location: " . $_SERVER['PHP_SELF'] . "?location_id=" .$_POST['location_id']);
        exit;

    } else {
        $message = "<ul>";
        foreach ($error as $value) {
            $message .= "<li>$value</li>";
        }
        $message .= "</ul>";
        $_SESSION["message"] = $message;
        $_SESSION['message_type'] = "error";

        header("Location: " . $_SERVER['PHP_SELF'] . "?error=$message&location_id=" . $_POST['location_id']);
        exit();
    }
}

include("includes/footer.php");
?>
