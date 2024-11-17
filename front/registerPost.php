<!DOCTYPE html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <meta charset="utf_8">
    <meta name="viewport" content="width=device-width, initial-script">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/styleCSS/styleHeader.css" rel="stylesheet">
    <link href="/styleCSS/styleBigTitle.css" rel="stylesheet">
    <link href="/styleCSS/styleFooter.css" rel="stylesheet">
    <link href="/styleCSS/styleMessageLogin.css" rel="stylesheet">
    <link href="http://fonts.googleap.com/css?family=Crete+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<header>
    <?php require_once 'header.php'; ?>
</header>

<body>

    <?php require_once 'bigtitle.php'; ?>


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
    $roleForm = $_POST['role'];

    //Vérification de l'adresse mail (unique)
    $query = "SELECT * FROM utilisateurs WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $emailForm);
    $stmt->execute();

    //Est-ce que l'adresse mail existe
    if($stmt->rowCount() > 0){
        echo '<div class="bienvenue mx-auto">' . " <p style='color:#63340B; padding-top:20px; font-weight:bold;'>" . "Cette adresse mail est déjà utilisée" ."</p>" . "<a style='color:#63340B; padding-top:20px; font-weight:bold;' href='/admin.php';> Retour </a>" . "</div>";
        die();
        
    }

    //Hashage du mot de passe
    $hashedPassword = password_hash($passwordForm, PASSWORD_DEFAULT);

    //Insérer les données dans la base
    $insertQuery = "INSERT INTO utilisateurs (username, email, password, nom, prenom, role) VALUES (:pseudo, :email, :password, :name, :surname, :role)";
    $stmt = $pdo->prepare($insertQuery);
    $stmt->bindParam(":pseudo", $pseudoForm);
    $stmt->bindParam(":email", $emailForm);
    $stmt->bindParam(":password", $hashedPassword);
    $stmt->bindParam(":name", $nameForm);
    $stmt->bindParam(":surname", $surnameForm);
    $stmt->bindParam(":role", $roleForm);
    $stmt->execute();

    echo '<div class="bienvenue mx-auto">' . " <p style='color:#63340B; padding-top:20px; font-weight:bold;'>" . "Création de compte réussie !" ."</p>" . "<a style='color:#63340B; padding-top:20px; font-weight:bold;' href='/admin.php';> Retour </a>" . "</div>" ; 

}
catch(PDOException $e) {
    echo "Erreur lors de la création du compte : ". $e->getMessage();
}
?>