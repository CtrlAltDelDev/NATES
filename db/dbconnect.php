<?php
//Local host
$user1 = 'root';
$pass1 = 'root';
$db1 = 'mysql:host=localhost; dbname=NATES';
// ctrlaltdel.dev/NATES
$user2 = 'dbu2579167';
$pass2 = 'Rootzs25';
$db2 = 'mysql:host=db5017268506.hosting-data.io;dbname=dbs13857002';

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
