<?php

$servername = "localhost";
$username = "root"; 
$password = "root";  
$dbname = "blog"; 

try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
