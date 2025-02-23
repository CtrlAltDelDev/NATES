<?php
if(isset($_POST['venueName'])){
    $errors = array();
    $data = array();
    if($_POST['venueName'] != ""){
        $venueName = $_POST['venueName'];
        $data['venueName'] = $venueName;
    }else{
        $errors[] = "Venue Name is required";
    }
    if($_POST['state'] != ""){
        $state = $_POST['state'];
        $data['state'] = $state;
    }else{
        $errors[] = "State is required";
    }
    if($_POST['city'] != ""){
        $city = $_POST['city'];
        $data['city'] = $city;
    }else{
        $errors[] = "City is required";
    }
    if($_POST['streetNumber'] != ""){
        $streetNumber = $_POST['streetNumber'];
        $data['streetNumber'] = $streetNumber;
    }else{
        $errors[] = "Street Number is required";
    }
    if($_POST['streetName'] != ""){
        $streetName = $_POST['streetName'];
        $data['streetName'] = $streetName;
    }else{
        $errors[] = "Street Name is required";
    }
    if($_POST['suite'] != ""){
        $suite = $_POST['suite'];
        $data['suite'] = $suite;
    }else{
        $errors[] = "Suite is required";
    }
    if($_POST['zipcode'] != ""){
        $zipcode = $_POST['zipcode'];
        $data['zipcode'] = $zipcode;
    }else{
        $errors[] = "Zip code is required";
    }
    if($_POST['phone'] != ""){
        $phone = $_POST['phone'];
        $data['phone'] = $phone;
    }else{
        $errors[] = "Phone is required";
    }
    if(empty($errors)){
        include("../db/dbconnect.php");
        $query = $dbc->prepare("INSERT INTO locationTable(venueName, state,city,streetNumber,streetName,suite,zipcode,phone) VALUES(:venueName, :state, :city, :streetNumber, :streetName, :suite, :zipcode, :phone)");
        $query->execute($data);
        header("location:../includes/success.php");
    }else {
        $message = "<ul>";
        foreach ($errors as $value) {
            $message .= "<li>$value</li>";
        }
        $message .= "</ul>";
        echo $message;
        echo "<a href='../adminLocation.php'>Go Back</a>";
        //   header("location:../adminEvent.php");
    }

}
?>