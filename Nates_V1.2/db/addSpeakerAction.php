<?php
// TODO: need to handle speaker photo storage
if (isset($_POST['first_name'])) {
    $error = array();
    $data = array();

    if ($_POST['first_name'] != "") {
        $first_name = $_POST['first_name'];
        $data['first_name'] = $first_name;
    } else {
        $error[] = "You need to enter your first name";
    }

    if ($_POST['last_name'] != "") {
        $last_name = $_POST['last_name'];
        $data['last_name'] = $last_name;
    } else {
        $error[] = "You need to enter your last name";
    }

    if ($_POST['email'] != "") {
        $email = $_POST['email'];
        $data['email'] = $email;
    } else {
        $error[] = "You need to enter your email";
    }

    if ($_POST['phone'] != "") {
        $phone = $_POST['phone'];
        $data['phone'] = $phone;
    } else {
        $error[] = "You need to enter your phone";
    }

    if ($_POST['speaker_links'] != "") {
        $speaker_links = $_POST['speaker_links'];
        $data['speaker_links'] = $speaker_links;
    } else {
        $error[] = "You need to enter your speaker links";
    }

    if ($_POST['speaker_bio'] != "") {
        $speaker_bio = $_POST['speaker_bio'];
        $data['speaker_bio'] = $speaker_bio;
    } else {
        $error[] = "You need to enter your speaker bio";
    }

    if ($_POST['speaker_details'] != "") {
        $speaker_details = $_POST['speaker_details'];
        $data['speaker_details'] = $speaker_details;
    } else {
        $error[] = "You need to enter your speaker details";
    }

    if ($_POST['photo_alt'] != "") {
        $photo_alt = $_POST['photo_alt'];
        $data['photo_alt'] = $photo_alt;
    } else {
        $error[] = "You need to enter your photo description";
    }

    if (isset($_FILES['speaker_photo']) && !empty($_FILES['speaker_photo'])) {
        $speaker_photo = $_FILES['speaker_photo']['tmp_name'];
        if (!empty($speaker_photo)) {
            // Create target directory
            if (!is_dir('speaker_photos')) {
                mkdir('speaker_photos', 0777, true);
            }
            // Extract file info
            $file_name = pathinfo($_FILES['speaker_photo']['name']);
            $file_extension = $file_name['extension'];
            $file_size = $_FILES['speaker_photo']['size'];
            $new_file_name = $file_name['filename'] . "_" . time() . "." . $file_extension;
            $file_and_location = "speaker_photos/" . $new_file_name;

            // Allowed Extensions
            $allowed_extensions = array("jpg", "jpeg", "png", "gif");

            // Check file size
            if ($file_size > 2097152) {
                $error[] = "File size must be less than 2 MB";
            }

            // Check allowed extensions
            if (!in_array($file_extension, $allowed_extensions)) {
                $error[] = "File type is not allowed";
            }

            // If all checks pass, upload file
            if (empty($error)) {
                move_uploaded_file($speaker_photo, $file_and_location);
                $data['speaker_photo'] = $file_and_location;
            } else {
                $error[] = "Some error occurred while uploading the file";
            }
        }
    }

    if (empty($error)) {
        include("../db/dbconnect.php");
        $query = $dbc->prepare("INSERT INTO speaker_table (first_name, last_name, email, phone, speaker_links, speaker_bio, speaker_details, photo_alt, speaker_photo) 
                                VALUES (:first_name, :last_name, :email, :phone, :speaker_links, :speaker_bio, :speaker_details, :photo_alt, :speaker_photo)");
        $query->execute($data);
        header("location:../success.php");
    } else {
        $message = "<ul>";
        foreach ($error as $value) {
            $message .= "<li>$value</li>";
        }
        $message .= "</ul>";
        echo $message;
        echo "<a href='../admin.php'>Go Back</a>";
        header("location:../admin.php");
    }
}
?>
