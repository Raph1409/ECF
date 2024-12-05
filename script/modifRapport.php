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

    <?php require_once '../front/bigtitle.php'; ?>


    <?php

    require_once '../back/connexionBDD.php';

        //Récupérer les données du formulaire de modification
    $rapportForm = $_POST['rapport'];
    $animalForm = $_POST['animal'];

        //On convertit rapportForm en entier INT
    $rapportForm = (int) $rapportForm;

    // On récupère les donnée de l'animal qui à été séléctionner dans le formulaire
    $donneeAnimalForm = "SELECT prenom, rapport FROM animaux WHERE prenom = :prenom";
    $stmt6 = $pdo->prepare($donneeAnimalForm);
    $stmt6->bindParam(":prenom", $animalForm);
    $stmt6->execute();
    $stmt6->setFetchMode(PDO::FETCH_ASSOC);

    // on stock les données de l'animal dans la variable $donneesAnimals
    while ($row2 = $stmt6->fetch(PDO::FETCH_ASSOC)) {
    //On récupère les différentes valeur de l'animal
    $animalRapport = $row2["rapport"];
    $animalPrenom = $row2["prenom"];
    }

    //On défini une variable de type tableau qui va contenir tout les messages de succès
    $successMessages = [];

    // Vérifier si le code est différent de l'actuel et non null
    if (trim($rapportForm) !== trim($animalRapport)) {
        // Préparer et exécuter la requête
        $insertRapport = "UPDATE animaux SET rapport = :rapport WHERE prenom = :ancienPrenom";
        $stmt5 = $pdo->prepare($insertRapport);
        $stmt5->bindParam(":rapport", $rapportForm);
        $stmt5->bindParam(":ancienPrenom", $animalForm);
        $stmt5->execute();
        $successMessages[] = "Le rapport de " . $animalForm . " à bien été modifié !";
    
    } else {}

        // Vérifier si une modification à été faite
        if ((isset($rapportForm) && $rapportForm === $animalRapport)) {
        $successMessages[] = "Aucune modification n'a été apportée à " . $animalForm;
    }

    //On affiche les message de succès
    if (!empty($successMessages)) {
        echo '<div class="bienvenue mx-auto">' . " <p style='color:#63340B; padding-top:20px; font-weight:bold;'>" . implode("<br>", $successMessages) ."</p>" . "<a style='color:#63340B; padding-top:20px; font-weight:bold;' href='/veterinaire.php';> Retour </a>" . "</div>";
}


?>

</body>