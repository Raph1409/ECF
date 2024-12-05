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
    <?php require_once '../front/headerVeterinaire.php'; ?>
</header>

<body>

    <?php 
    require_once '../front/bigtitle.php'; 
    require_once '../back/connexionBDD.php';
    ?>

    <?php

session_start();

$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Récupérer les données du formulaire de création de rapport
$nomRapportForm = $_POST['nomRapport'];
$contenuForm = $_POST['contenu'];

//récupération de l'utilisateur
$nomUtilisateur = $_SESSION['user']['username'];

//Vérification du nom du rapport (unique)
    $query = "SELECT * FROM rapports_veterinaire WHERE nom = :nom";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":nom", $nomRapportForm);
    $stmt->execute();

//Est-ce que l'adresse mail existe
    if($stmt->rowCount() > 0){
        echo '<div class="bienvenue mx-auto">' . " <p style='color:#63340B; padding-top:20px; font-weight:bold;'>" . "Cette nom de rapport est déjà utilisée" ."</p>" . "<a style='color:#63340B; padding-top:20px; font-weight:bold;' href='/veterinaire.php';> Retour </a>" . "</div>";
        die();
        
    }

//Insérer les données dans la base
$insertQuery = "INSERT INTO rapports_veterinaire (detail, utilisateur, nom) VALUES (:detail, :utilisateur, :nom)";
$stmt = $pdo->prepare($insertQuery);
$stmt->bindParam(":detail", $contenuForm);
$stmt->bindParam(":nom", $nomRapportForm);
$stmt->bindParam(":utilisateur", $nomUtilisateur);
$stmt->execute();

        echo '<div class="bienvenue mx-auto">' . " <p style='color:#63340B; padding-top:20px; font-weight:bold;'>" . "Création de rapport réussie !" ."</p>" . 
        "<a style='color:#63340B; padding-top:20px; font-weight:bold;' href='/veterinaire.php';> Retour </a>" . "</div>" ;

?>

    <footer>
        <?php require_once '../front/footer.php'; ?>
    </footer>