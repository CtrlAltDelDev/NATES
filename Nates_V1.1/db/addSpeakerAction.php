<?php
// todo need to handle speaker photo storage
if (isset($_POST['firstName'])) {
    $error = array();
    $data = array();

    // Validate input fields
    $fields = [
        "firstName" => "You need to enter your first name",
        "lastName" => "You need to enter your last name",
        "email" => "You need to enter your email",
        "phone" => "You need to enter your phone",
        "speakerLinks" => "You need to enter your speaker links",
        "speakerBio" => "You need to enter your speaker Bio",
        "speakerDetails" => "You need to enter your speaker Details",
        "photoAlt" => "You need to enter your photo description"
    ];

    foreach ($fields as $field => $errorMessage) {
        if (!empty($_POST[$field])) {
            $data[$field] = $_POST[$field];
        } else {
            $error[] = $errorMessage;
        }
    }

    // Handle file upload (speaker photo)
    if (isset($_FILES['speakerPhoto']) && $_FILES['speakerPhoto']['tmp_name'] != "") {
        $speakerPhoto = $_FILES['speakerPhoto']['tmp_name'];

        // Create target directory if it doesn't exist
        if (!is_dir('speakerPhotos')) {
            mkdir('speakerPhotos', 0777, true);
        }

        // Extract file info
        $fileName = pathinfo($_FILES['speakerPhoto']['name']);
        $fileExtension = strtolower($fileName['extension']);
        $fileSize = $_FILES['speakerPhoto']['size'];
        $newFileName = $fileName['filename'] . "_" . time() . "." . $fileExtension;
        $fileAndLocation = "speakerPhotos/" . $newFileName;

        // Allowed Extensions
        $allowedExtensions = ["jpg", "jpeg", "png", "gif"];

        // Check file size (max 2MB)
        if ($fileSize > 2097152) {
            $error[] = "File size must be less than 2 MB";
        }

        // Check allowed extensions
        if (!in_array($fileExtension, $allowedExtensions)) {
            $error[] = "File type is not allowed";
        }

        // Upload file if no errors
        if (empty($error)) {
            if (move_uploaded_file($speakerPhoto, $fileAndLocation)) {
                $data['speakerPhoto'] = $fileAndLocation;
            } else {
                $error[] = "Some error occurred while uploading the file";
            }
        }
    } else {
        // Set default image if no file uploaded
        $data['speakerPhoto'] = "speakerPhotos/default-avatar-photo.jpg";
    }

    // If no errors, insert into database
    if (empty($error)) {
        include("../db/dbconnect.php");

        $query = $dbc->prepare("
            INSERT INTO speakerTable 
            (firstName, lastName, email, phone, speakerLinks, speakerBio, speakerDetails, photoAlt, speakerPhoto) 
            VALUES (:firstName, :lastName, :email, :phone, :speakerLinks, :speakerBio, :speakerDetails, :photoAlt, :speakerPhoto)
        ");

        $query->execute($data);
        header("Location: ../success.php");
        exit();
    } else {
        // Display errors and redirect
        $message = "<ul>";
        foreach ($error as $value) {
            $message .= "<li>$value</li>";
        }
        $message .= "</ul>";

        echo $message;
        echo "<a href='../admin.php'>Go Back</a>";
       // header("Location: ../admin.php");
    }
}
?>
