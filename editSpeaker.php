<?php
session_start();
global $dbc;
include("includes/header.php");
include("includes/nav.php");
include_once("db/dbconnect.php");

if (isset($_GET['speaker_id'])) {
    $get_records_query = $dbc->prepare("SELECT * FROM `speaker_table` WHERE speaker_id = :speaker_id");
    $get_records_query->bindParam(':speaker_id', $_GET['speaker_id']);
    $get_records_query->execute();

    echo '<main>';
    if (isset($_GET['error'])) {
        echo "<section>" . $_GET['error'] . "</section>";
    }
    include("includes/flashMessage.php");
    echo "    <form method='post' enctype='multipart/form-data' action='" . $_SERVER['PHP_SELF'] . "'>";
    include("includes/adminNav.php"); // fieldset // legend // nav area

    while ($row = $get_records_query->fetch()) {
        echo "            <label for='first_name'>First Name</label>";
        echo "            <input type='text' name='first_name' id='first_name' value='" . htmlspecialchars($row['first_name']) . "'>";

        echo "            <label for='last_name'>Last Name</label>";
        echo "            <input type='text' name='last_name' id='last_name' value='" . htmlspecialchars($row['last_name']) . "'>";

        echo "            <label for='email'>Email Address</label>";
        echo "            <input type='text' name='email' id='email' value='" . htmlspecialchars($row['email']) . "'>";

        echo "            <label for='phone'>Phone Number</label>";
        echo "            <input type='text' name='phone' id='phone' value='" . htmlspecialchars($row['phone']) . "'>";

        echo "            <label for='speaker_links'>Links</label>";
        echo "            <input type='text' name='speaker_links' id='speaker_links' value='" . htmlspecialchars($row['speaker_links']) . "'>";

        echo "            <label for='speaker_bio'>Speaker Bio</label>";
        echo "            <textarea name='speaker_bio' id='speaker_bio'>" . htmlspecialchars($row['speaker_bio']) . "</textarea>";

        echo "            <label for='speaker_details'>Additional Speaker Details</label>";
        echo "            <textarea name='speaker_details' id='speaker_details'>" . htmlspecialchars($row['speaker_details']) . "</textarea>";

        echo "            <label for='speaker_photo'>Select an Image</label>";
        echo "            <input type='file' name='speaker_photo' id='speaker_photo' accept='image/jpeg'>";

        echo "            <label for='photo_alt'>Photo Description</label>";
        echo "            <input type='text' name='photo_alt' id='photo_alt' value='" . htmlspecialchars($row['photo_alt']) . "'>";
    }
    echo "            <input type='hidden' name='speaker_id' value='" . $_GET['speaker_id'] . "'>";
    echo "            <input type='submit' value='Update Speaker'>";
    echo "        </fieldset>";
    echo "    </form>";
    echo "</main>";
}

// Handle form submission
elseif (isset($_POST['speaker_id'])) {
    $error = array();
    $data = array();

    if (!empty($_POST["first_name"])) {
        $data["first_name"] = $_POST["first_name"];
    } else {
        $error["first_name"] = "First name is required";
    }

    if (!empty($_POST["last_name"])) {
        $data["last_name"] = $_POST["last_name"];
    } else {
        $error["last_name"] = "Last name is required";
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

    if (!empty($_POST["speaker_links"])) {
        $data["speaker_links"] = $_POST["speaker_links"];
    }

    if (!empty($_POST["speaker_bio"])) {
        $data["speaker_bio"] = $_POST["speaker_bio"];
    }

    if (!empty($_POST["speaker_details"])) {
        $data["speaker_details"] = $_POST["speaker_details"];
    }

    if (!empty($_POST["photo_alt"])) {
        $data["photo_alt"] = $_POST["photo_alt"];
    }

    // Handle Image Upload
    if (!empty($_FILES["speaker_photo"]["name"])) {
        $target_dir = "uploads/";
        $file_name = basename($_FILES["speaker_photo"]["name"]);
        $target_file_path = $target_dir . $file_name;
        $file_type = pathinfo($target_file_path, PATHINFO_EXTENSION);

        // Allow only JPEG
        if (strtolower($file_type) !== "jpg" && strtolower($file_type) !== "jpeg") {
            $error["speaker_photo"] = "Only JPG/JPEG images are allowed.";
        } else {
            move_uploaded_file($_FILES["speaker_photo"]["tmp_name"], $target_file_path);
            $data["speaker_photo"] = $target_file_path;
        }
    }

    $data['speaker_id'] = $_POST['speaker_id'];

    if (empty($error)) {
        $update_query = $dbc->prepare("
            UPDATE speaker_table 
            SET first_name = :first_name, 
                last_name = :last_name, 
                phone = :phone, 
                email = :email, 
                speaker_links = :speaker_links, 
                speaker_bio = :speaker_bio, 
                speaker_details = :speaker_details, 
                photo_alt = :photo_alt
            WHERE speaker_id = :speaker_id
        ");

        if (!empty($data["speaker_photo"])) {
            $update_query = $dbc->prepare("
                UPDATE speaker_table 
                SET first_name = :first_name, 
                    last_name = :last_name, 
                    phone = :phone, 
                    email = :email, 
                    speaker_links = :speaker_links, 
                    speaker_bio = :speaker_bio, 
                    speaker_details = :speaker_details, 
                    speaker_photo = :speaker_photo, 
                    photo_alt = :photo_alt
                WHERE speaker_id = :speaker_id
            ");
        }

        // Debugging: Check what data is being passed
        // print_r($data); // Comment out after debugging

        $update_query->execute($data);

        session_start();
        // applies message to session super global
        $_SESSION['message'] = "Added successfully!";
        $_SESSION['message_type'] = "success";
        header("Location: " . $_SERVER['PHP_SELF'] . "?error=$message&speaker_id=" .$_POST['speaker_id']);
        exit;

    } else {
        $message = "<ul>";
        foreach ($error as $value) {
            $message .= "<li>$value</li>";
        }
        $message .= "</ul>";
        session_start();
        $_SESSION["message"] = $message;
        $_SESSION['message_type'] = "error";

        header("Location: " . $_SERVER['PHP_SELF'] . "?error=$message&speaker_id=" . $_POST['speaker_id']);
        exit();
    }
}

include("includes/footer.php");
?>
