<?php

$dsn = "mysql:host=127.0.0.1;port=3307;dbname=arcadia;";
$username = "user_php";
$password = "4g8rkkEmn4JH89P";

try{
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Récupérer les données du formulaire de connexion
    $emailForm = $_POST['email'];
    $passwordForm = $_POST['password'];

    $query = "SELECT * FROM utilisateurs WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $emailForm);
    $stmt->execute();

    //Est-ce que l'adresse mail existe
    if($stmt->rowCount() == 1){
       $monUtilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
       if(password_verify($passwordForm, $monUtilisateur["password"])){
            echo "Connexion réussie ! Bienvenue " .$monUtilisateur['username'];
       } else {
        echo "Mot de passe incorrect";
       }


} else {
    echo "Utilisateur introuvable ! Vérifier votre adresse mail !";
}

} 

catch(PDOException $e) {
    echo "Erreur de connexion à la base de données : ". $e->getMessage();
}

?>