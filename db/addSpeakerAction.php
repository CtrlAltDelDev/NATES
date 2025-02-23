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
    if(empty($error)){
        include("../db/dbconnect.php");
        $query = $dbc->prepare("INSERT INTO speakerTable (firstName, lastName, email, phone, speakerLinks,speakerBio, SpeakerDetails) VALUES (:firstName, :lastName, :email, :phone, :speakerLinks, :speakerBio, :speakerDetails)");
        $query->execute($data);
        header("location:../includes/success.php");
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
