<?php 

try {
    $db = new PDO('mysql:host=localhost; dbname=gestionqdb','root','');
    echo'Connexion etablie !';
} catch (Exception $e) {
    die($e->getMessage()); 
}

?>