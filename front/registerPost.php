<?php

$dsn = "mysql:host=127.0.0.1;port=3307;dbname=arcadia;";
$username = "user_php";
$password = "4g8rkkEmn4JH89P";

try{
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Récupérer les données du formulaire de création de compte
    $pseudoForm = $_POST['pseudo'];
    $emailForm = $_POST['email'];
    $passwordForm = $_POST['password'];
    $nameForm = $_POST['name'];
    $surnameForm = $_POST['surname'];

    //Vérification de l'adresse mail (unique)
    $query = "SELECT * FROM utilisateurs WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $emailForm);
    $stmt->execute();

    //Est-ce que l'adresse mail existe
    if($stmt->rowCount() > 0){
        die("Cette adresse mail est déjà utilisée");
    }

    //Hashage du mot de passe
    $hashedPassword = password_hash($passwordForm, PASSWORD_DEFAULT);

    //Insérer les données dans la base
    $insertQuery = "INSERT INTO utilisateurs (username, email, password, nom, prenom) VALUES (:pseudo, :email, :password, :name, :surname)";
    $stmt = $pdo->prepare($insertQuery);
    $stmt->bindParam(":pseudo", $pseudoForm);
    $stmt->bindParam(":email", $emailForm);
    $stmt->bindParam(":password", $hashedPassword);
    $stmt->bindParam(":name", $nameForm);
    $stmt->bindParam(":surname", $surnameForm);
    $stmt->execute();

    echo "Création de compte réussie !";

}
catch(PDOException $e) {
    echo "Erreur lors de la création du compte : ". $e->getMessage();
}
?>