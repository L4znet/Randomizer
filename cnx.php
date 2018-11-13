<?php
 $serveur = 'XXXX';
 
 $user = "XXXX";

 $bdd = "XXXX";

 $pass = "XXXXX";

 $port = ''; 
try {
    $cnx = new PDO ('mysql:host=' . $serveur .';dbname=' . $bdd . ';charset=utf8', $user, $pass);
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
 
