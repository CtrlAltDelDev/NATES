<?php
//Local host
$user1 = 'root';
$pass1 = 'root';
$db1 = 'mysql:host=localhost; dbname=NATES';
// ctrlaltdel.dev/NATES
$user2 = 'dbu1026992';
$pass2 = 'Rootzs25';
$db2 = 'mysql:db5017384773.hosting-data.io;dbname=dbs13939436';

try{
    $dbc = new PDO($db1, $user1, $pass1);
}catch(PDOException $e){
    try{
        $dbc = new PDO($db2, $user2, $pass2);
    }catch(PDOException $e2) {
        echo $e->getMessage();
        echo $e2->getMessage();
    }
}
