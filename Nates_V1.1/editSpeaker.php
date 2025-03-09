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
    }                   // pass speakerId but keeps hidden from user
    echo "            <input type='hidden' name='speakerId' value='" . $_GET['speakerId'] . "'>";
    echo "            <input type='submit' value='Update Speaker'>";
    echo "        </fieldset>";
    echo "    </form>";
    echo "</main>";
}

// Handle form submission
else if (isset($_POST['speakerId'])) {
    $error = array();
    $data = array();

    if ($_POST["firstName"]) {
        $data["firstName"] = $_POST["firstName"];
    } else {
        $error["firstName"] = "First name is required";
    }

    if ($_POST["lastName"]) {
        $data["lastName"] = $_POST["lastName"];
    } else {
        $error["lastName"] = "Last name is required";
    }

    if ($_POST["email"]) {
        $data["email"] = $_POST["email"];
    } else {
        $error["email"] = "Email is required";
    }

    if ($_POST["phone"]) {
        $data["phone"] = $_POST["phone"];
    } else {
        $error["phone"] = "Phone is required";
    }

    if ($_POST["speakerLinks"]) {
        $data["speakerLinks"] = $_POST["speakerLinks"];
    } else{
        $error["speakerLinks"] = "Speaker links are required";
    }

    if ($_POST["speakerBio"]) {
        $data["speakerBio"] = $_POST["speakerBio"];
    } else {
        $error["speakerBio"] = "Speaker Bio is required";
    }

    if ($_POST["speakerDetails"]) {
        $data["speakerDetails"] = $_POST["speakerDetails"];
    } else {
        $error["speakerDetails"] = "Speaker details are required";
    }

    if ($_POST["photoAlt"]) {
        $data["photoAlt"] = $_POST["photoAlt"];
    } else {
        $error["photoAlt"] = "Photo alt is required";
    }

// Handle Image Upload
    if (isset($_FILES['speakerPhoto']) && $_FILES['speakerPhoto']['error'] === 0) {
        $targetDir = "speakerPhotos/";
        $uploadDir =   "db/speakerPhotos/";     // fix wrong file directory

        // Ensure directory exists and set permissions
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Extract file info
        $fileName = basename($_FILES['speakerPhoto']['name']);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $fileSize = $_FILES['speakerPhoto']['size'];

        // Generate a unique filename for data table
        $newFileName = uniqid("speaker_") . "." . $fileExtension;
        $targetFilePath =  $targetDir . $newFileName;
        $uploadFilePath =  $uploadDir . $newFileName;

        // Allowed Extensions
        $allowedExtensions = ["jpg", "jpeg", "png", "gif"];

        // Validate file type and size
        if (!in_array($fileExtension, $allowedExtensions)) {
            die("Invalid file type: " . $fileExtension);
        }

        if ($fileSize > 2097152) {
            die("File too large");
        }

        // Move file to destination
        if (move_uploaded_file($_FILES["speakerPhoto"]["tmp_name"], $uploadFilePath)) {
            echo "File uploaded successfully: " . $uploadFilePath;
            $data["speakerPhoto"] = $targetFilePath;        // actual path in data table
        } else {
            die("File upload failed! Check folder permissions.");
        }
    }

    // ensures speaker id is correctly set back to it original id
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
//            print_r($data['speakerPhoto']);
//            echo"<br>";
//            print_r($data['speakerId']);
//            exit();
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
