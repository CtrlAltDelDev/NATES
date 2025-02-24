<?php
// TODO  import speakerID from speaker table
// TODO  import locationID from location table

if(isset($_POST['eventName'])){
    $error = array();
    $data = array();
    if($_POST['eventName'] != ""){
        $eventName = $_POST['eventName'];
        $data['eventName'] = $eventName;
    }else{
        $error['eventName'] = "Event Name is required";
    }
    if($_POST['speakerId'] != ""){
        $speakerId = $_POST['speakerId'];
        $data['speakerId'] = $speakerId;
    }else{
        $error['speakerId'] = "Speaker Name is required";
    }
    if($_POST['eventDescription'] != ""){
        $eventDescription = $_POST['eventDescription'];
        $data['eventDescription'] = $eventDescription;
    }else{
        $error['eventDescription'] = "Event Description is required";
    }
    if($_POST['eventStart'] != ""){
        $eventStart = $_POST['eventStart'];
        $data['eventStart'] = $eventStart;
    }else{
        $error['eventStart'] = "Event Start Date is required";
    }
    if($_POST['eventEnd'] != ""){
        $eventEnd = $_POST['eventEnd'];
        $data['eventEnd'] = $eventEnd;
    }else{
        $error['eventEnd'] = "Event End Date is required";
    }
    if($_POST['locationId'] != ""){
        $locationId = $_POST['locationId'];
        $data['locationId'] = $locationId;
    }else{
        $error['locationId'] = "Event Location is required";
    }
    if($_POST['eventPrice'] != ""){
        $eventPrice = $_POST['eventPrice'];
        $data['eventPrice'] = $eventPrice;
    }else{
        $error['eventPrice'] = "Event Price is required";
    }
    if(empty($error)){
        include("../db/dbconnect.php");
        //if all fields filled in create date and update DB
        $creationDate = date('Y-m-d H:i:s');
        $data['creationDate'] = $creationDate;

        $query = $dbc->prepare("INSERT INTO eventTable (eventName, speakerId, eventDescription, eventStart, eventEnd, locationId, eventPrice, creationDate) VALUES(:eventName, :speakerId, :eventDescription, :eventStart, :eventEnd, :locationId, :eventPrice, :creationDate)");
        $query->execute($data);
        header("location:../success.php");
}else {
        $message = "<ul>";
        foreach ($error as $value) {
            $message .= "<li>$value</li>";
        }
        $message .= "</ul>";
        echo $message;
        echo "<a href='../adminEvent.php'>Go Back</a>";
     //   header("location:../adminEvent.php");
    }
}
?>