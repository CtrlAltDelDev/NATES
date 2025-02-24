<?php
// todo need to handle speaker photo storage
if(isset($_POST['firstName']))
{
    $error = array();
    $data = array();
    if($_POST['firstName'] != "")
    {
        $firstName = $_POST['firstName'];
        $data['firstName'] = $firstName;
    } else{
        $error[] = "You need to enter your first name";
    }
    if($_POST['lastName'] != "")
    {
        $lastName = $_POST['lastName'];
        $data['lastName'] = $lastName;
    } else{
        $error[] = "You need to enter your last name";
    }
    if($_POST['email'] != "")
    {
        $email = $_POST['email'];
        $data['email'] = $email;
    } else{
        $error[] = "You need to enter your email";
    }
    if($_POST['phone'] != "")
    {
        $phone = $_POST['phone'];
        $data['phone'] = $phone;
    } else{
        $error[] = "You need to enter your phone";
    }
    if($_POST['speakerLinks'] != "")
    {
        $speakerLinks = $_POST['speakerLinks'];
        $data['speakerLinks'] = $speakerLinks;
    }else{
        $error[] = "You need to enter your speaker links";
    }
    if($_POST['speakerBio'] != "")
    {
        $speakerBio = $_POST['speakerBio'];
        $data['speakerBio'] = $speakerBio;
    }else{
        $error[] = "You need to enter your speaker Bio";
    }
    if($_POST['speakerDetails'] != ""){
        $speakerDetails = $_POST['speakerDetails'];
        $data['speakerDetails'] = $speakerDetails;
    }else{
        $error[] = "You need to enter your speaker Details";
    }
    if($_POST['photoAlt'] != ""){
        $photoAlt = $_POST['photoAlt'];
        $data['photoAlt'] = $photoAlt;
    }else{
        $error[] = "You need to enter your photo discription";
    }
    if(isset($_FILES['speakerPhoto']) && !empty($_FILES['speakerPhoto'])){
        $speakerPhoto = $_FILES['speakerPhoto']['tmp_name'];
        if(!empty($speakerPhoto)){
            //create target directory
            if(!is_dir('speakerPhotos')){
                mkdir('speakerPhotos', 0777, true);
            }
            // Extract file info
            $fileName = pathinfo($_FILES['speakerPhoto']['name']);
            $fileExtension = $fileName['extension'];
            $fileSize = $_FILES['speakerPhoto']['size'];
            $newFileName = $fileName['filename'] . "_" . time() . "." . $fileExtension;
            $fileAndLocation = "speakerPhotos/" . $newFileName;

            //Allowed Extensions
            $allowedExtensions = array("jpg", "jpeg", "png", "gif");
            // check file size
            if ($fileSize > 2097152) {
                $error[] = "File size must be less than 2 MB";
            }
            // check allowed extensions
            if(!in_array($fileExtension, $allowedExtensions)) {
                $error[] = "File type is not allowed";
            }
            //// all checks passed upload file
            if(empty($error)){
                move_uploaded_file($speakerPhoto, $fileAndLocation);
                $data['speakerPhoto'] = $fileAndLocation;
            }else{
                $error[] = "Some error occured while uploading the file";
            }
        }
    }

    if(empty($error)){
        include("../db/dbconnect.php");
        $query = $dbc->prepare("INSERT INTO speakerTable (firstName, lastName, email, phone, speakerLinks,speakerBio, SpeakerDetails, photoAlt, speakerPhoto) VALUES (:firstName, :lastName, :email, :phone, :speakerLinks, :speakerBio, :speakerDetails, :photoAlt, :speakerPhoto)");
        $query->execute($data);
        header("location:../success.php");
    }
    else{
        $message = "<ul>";
        foreach($error as $value)
        {
            $message .= "<li>$value</li>";
        }
        $message .= "</ul>";
        echo $message;
        echo "<a href='../admin.php'>Go Back</a>";
        header("location:../admin.php");
    }
}
