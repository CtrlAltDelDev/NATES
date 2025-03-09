<?php
global $dbc;
include("includes/header.php");
include("includes/nav.php");
include_once("db/dbconnect.php");

if (isset($_GET['speakerId'])) {
    $getRecordsQuery = $dbc->prepare("SELECT * FROM `speakerTable` WHERE speakerId = :speakerId");
    $getRecordsQuery->bindParam(':speakerId', $_GET['speakerId']);
    $getRecordsQuery->execute();

    echo '<main>';
    if (isset($_GET['error'])) {
        echo "<section>" . $_GET['error'] . "</section>";
    }
    echo "    <form method='post' enctype='multipart/form-data' action='" . $_SERVER['PHP_SELF'] . "'>";
    include("includes/adminNav.php"); // fieldset // legend // nav area

    while ($row = $getRecordsQuery->fetch()) {
        echo "            <label for='firstName'>First Name</label>";
        echo "            <input type='text' name='firstName' id='firstName' value='" . htmlspecialchars($row['firstName']) . "'>";

        echo "            <label for='lastName'>Last Name</label>";
        echo "            <input type='text' name='lastName' id='lastName' value='" . htmlspecialchars($row['lastName']) . "'>";

        echo "            <label for='email'>Email Address</label>";
        echo "            <input type='text' name='email' id='email' value='" . htmlspecialchars($row['email']) . "'>";

        echo "            <label for='phone'>Phone Number</label>";
        echo "            <input type='text' name='phone' id='phone' value='" . htmlspecialchars($row['phone']) . "'>";

        echo "            <label for='speakerLinks'>Links</label>";
        echo "            <input type='text' name='speakerLinks' id='speakerLinks' value='" . htmlspecialchars($row['speakerLinks']) . "'>";

        echo "            <label for='speakerBio'>Speaker Bio</label>";
        echo "            <textarea name='speakerBio' id='speakerBio'>" . htmlspecialchars($row['speakerBio']) . "</textarea>";

        echo "            <label for='speakerDetails'>Additional Speaker Details</label>";
        echo "            <textarea name='speakerDetails' id='speakerDetails'>" . htmlspecialchars($row['speakerDetails']) . "</textarea>";

        echo "            <label for='speakerPhoto'>Select an Image</label>";
        echo "            <input type='file' name='speakerPhoto' id='speakerPhoto' accept='image/jpeg'>";

        echo "            <label for='photoAlt'>Photo Description</label>";
        echo "            <input type='text' name='photoAlt' id='photoAlt' value='" . htmlspecialchars($row['photoAlt']) . "'>";
    }
    echo "            <input type='hidden' name='speakerId' value='" . $_GET['speakerId'] . "'>";
    echo "            <input type='submit' value='Update Speaker'>";
    echo "        </fieldset>";
    echo "    </form>";
    echo "</main>";
}

// Handle form submission
elseif (isset($_POST['speakerId'])) {
    $error = array();
    $data = array();

    if (!empty($_POST["firstName"])) {
        $data["firstName"] = $_POST["firstName"];
    } else {
        $error["firstName"] = "First name is required";
    }

    if (!empty($_POST["lastName"])) {
        $data["lastName"] = $_POST["lastName"];
    } else {
        $error["lastName"] = "Last name is required";
    }

    if (!empty($_POST["email"])) {
        $data["email"] = $_POST["email"];
    } else {
        $error["email"] = "Email is required";
    }

    if (!empty($_POST["phone"])) {
        $data["phone"] = $_POST["phone"];
    } else {
        $error["phone"] = "Phone is required";
    }

    if (!empty($_POST["speakerLinks"])) {
        $data["speakerLinks"] = $_POST["speakerLinks"];
    }

    if (!empty($_POST["speakerBio"])) {
        $data["speakerBio"] = $_POST["speakerBio"];
    }

    if (!empty($_POST["speakerDetails"])) {
        $data["speakerDetails"] = $_POST["speakerDetails"];
    }

    if (!empty($_POST["photoAlt"])) {
        $data["photoAlt"] = $_POST["photoAlt"];
    }

    // Handle Image Upload
    if (!empty($_FILES["speakerPhoto"]["name"])) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES["speakerPhoto"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow only JPEG
        if (strtolower($fileType) !== "jpg" && strtolower($fileType) !== "jpeg") {
            $error["speakerPhoto"] = "Only JPG/JPEG images are allowed.";
        } else {
            move_uploaded_file($_FILES["speakerPhoto"]["tmp_name"], $targetFilePath);
            $data["speakerPhoto"] = $targetFilePath;
        }
    }

    $data['speakerId'] = $_POST['speakerId'];

    if (empty($error)) {
        $updatequery = $dbc->prepare("
            UPDATE speakerTable 
            SET firstName = :firstName, 
                lastName = :lastName, 
                phone = :phone, 
                email = :email, 
                speakerLinks = :speakerLinks, 
                speakerBio = :speakerBio, 
                speakerDetails = :speakerDetails, 
                photoAlt = :photoAlt
            WHERE speakerId = :speakerId
        ");

        if (!empty($data["speakerPhoto"])) {
            $updatequery = $dbc->prepare("
                UPDATE speakerTable 
                SET firstName = :firstName, 
                    lastName = :lastName, 
                    phone = :phone, 
                    email = :email, 
                    speakerLinks = :speakerLinks, 
                    speakerBio = :speakerBio, 
                    speakerDetails = :speakerDetails, 
                    speakerPhoto = :speakerPhoto, 
                    photoAlt = :photoAlt
                WHERE speakerId = :speakerId
            ");
        }

        // Debugging: Check what data is being passed
        // print_r($data); // Comment out after debugging

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

        header("Location: " . $_SERVER['PHP_SELF'] . "?error=$message&speakerId=" . $_POST['speakerId']);
        exit();
    }
} else {
    header("Location: addSpeaker.php");
    exit();
}

include("includes/footer.php");
?>
