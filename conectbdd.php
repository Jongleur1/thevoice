<?php 
$bdd_name = 'mysql:host=localhost;dbname=Thevoice';
$user = 'greta';
$pass = 'Greta1234!';
try {
    $connexion = new PDO(
        $bdd_name, 
        $user, 
        $pass
    );
    $connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} 
catch (PDOException $excep)
{
    echo "erreur connexion" . $excep->getMessage();
}




?>
