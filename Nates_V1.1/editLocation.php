<?php
include("includes/header.php");
include("includes/nav.php");
include_once("db/dbconnect.php");

if (isset($_GET['locationId'])) {
    $getRecordsQuery = $dbc->prepare("SELECT * FROM `locationTable` WHERE locationId = :locationId");
    $getRecordsQuery->bindParam(':locationId', $_GET['locationId']);
    $getRecordsQuery->execute();

    echo '<main>';
    if (isset($_GET['error'])) {
        echo "<section>" . $_GET['error'] . "</section>";
    }
    echo "    <form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
    include("includes/adminNav.php"); // fieldset // legend // nav area

    while ($row = $getRecordsQuery->fetch()) {
        echo "            <label for='venueName'>Enter Venue Name</label>";
        echo "            <input type='text' name='venueName' id='venueName' value='" . htmlspecialchars($row['venueName']) . "'>";

        echo "            <label for='state'>Enter State Abbreviation</label>";
        echo "            <input type='text' name='state' id='state' value='" . htmlspecialchars($row['state']) . "'>";

        echo "            <label for='city'>Enter City Name</label>";
        echo "            <input type='text' name='city' id='city' value='" . htmlspecialchars($row['city']) . "'>";

        echo "            <label for='streetNumber'>Enter Street Number</label>";
        echo "            <input type='text' name='streetNumber' id='streetNumber' value='" . htmlspecialchars($row['streetNumber']) . "'>";

        echo "            <label for='streetName'>Enter Street Name</label>";
        echo "            <input type='text' name='streetName' id='streetName' value='" . htmlspecialchars($row['streetName']) . "'>";

        echo "            <label for='suite'>Enter Suite Number</label>";
        echo "            <input type='text' name='suite' id='suite' value='" . htmlspecialchars($row['suite']) . "'>";

        echo "            <label for='zipcode'>Enter Zip Code</label>";
        echo "            <input type='text' name='zipcode' id='zipcode' value='" . htmlspecialchars($row['zipcode']) . "'>";

        echo "            <label for='phone'>Location Phone Number</label>";
        echo "            <input type='text' name='phone' id='phone' value='" . htmlspecialchars($row['phone']) . "'>";
    }
    echo "            <input type='hidden' name='locationId' value='" . $_GET['locationId'] . "'>";
    echo "            <input type='submit' value='Update Location'>";
    echo "        </fieldset>";
    echo "    </form>";
    echo "</main>";
}

// Handle form submission
elseif (isset($_POST['locationId'])) {
    $error = array();
    $data = array();

    if (!empty($_POST["venueName"])) {
        $data["venueName"] = $_POST["venueName"];
    } else {
        $error["venueName"] = "Venue name is required";
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

    if (!empty($_POST["streetNumber"])) {
        $data["streetNumber"] = $_POST["streetNumber"];
    } else {
        $error["streetNumber"] = "Street number is required";
    }

    if (!empty($_POST["streetName"])) {
        $data["streetName"] = $_POST["streetName"];
    } else {
        $error["streetName"] = "Street name is required";
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

    $data['locationId'] = $_POST['locationId'];

    if (empty($error)) {
        $updatequery = $dbc->prepare("
            UPDATE locationTable 
            SET venueName = :venueName, 
                state = :state, 
                city = :city, 
                streetNumber = :streetNumber, 
                streetName = :streetName, 
                suite = :suite, 
                zipcode = :zipcode, 
                phone = :phone
            WHERE locationId = :locationId
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

        header("Location: " . $_SERVER['PHP_SELF'] . "?error=$message&locationId=" . $_POST['locationId']);
        exit();
    }
} else {
    header("Location: addLocation.php");
    exit();
}

include("includes/footer.php");
?>
