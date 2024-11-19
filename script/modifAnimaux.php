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
    <?php require_once '../front/headerAdmin.php'; ?>
</header>

<body>

    <?php require_once '../front/bigtitle.php'; ?>


    <?php

    require_once '../back/connexionBDD.php';


    //Récupérer les données du formulaire de modification
    $animalForm = $_POST['animal'];
    $prenomForm = $_POST['prenom'];
    $habitatForm = $_POST['habitat'];
    $etatForm = $_POST['etat'];
    $rapportForm = $_POST['rapport'];

    //On convertit rapportForm en entier INT
    $rapportForm = (int) $rapportForm;
    $habitatForm = (int) $habitatForm;

    //On récupère toute les données de nos animaux
    $sql = "SELECT prenom, habitat, etat, rapport FROM animaux";
    $stmt = $pdo->query($sql);

    // On stock le tout dans la variable $animals
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {   
    // On décompose $animals pour récuperer les valeurs de la BDD
    $prenom = $row["prenom"];
    $habitat = $row["habitat"];
    $etat = $row["etat"];
    $rapport = $row["rapport"];
    }

    //mapping
    $habitatFormMapping = [
        'Marais' => 1,
        'Savane' => 2,
        'Jungle' => 3,
    ];

    $etatFormMapping = [
        'Non évalué' => 1,
        'Données insuffisantes' => 2,
        'Préoccupation mineure' => 3,
        'Quasi menacé' => 4,
        'Vulnérable' => 5,
        'En danger' => 6,
        'En danger critique' => 7,
        "Éteint à l'état sauvage" => 8,
        'Éteint' => 9,
    ];

    // On récupère les donnée de l'animal qui à été séléctionner dans le formulaire
    $donneeAnimalForm = "SELECT prenom, habitat, etat, rapport FROM animaux WHERE prenom = :prenom";
    $stmt6 = $pdo->prepare($donneeAnimalForm);
    $stmt6->bindParam(":prenom", $animalForm);
    $stmt6->execute();
    $stmt6->setFetchMode(PDO::FETCH_ASSOC);

    // on stock les données de l'animal dans la variable $donneesAnimals
    while ($row2 = $stmt6->fetch(PDO::FETCH_ASSOC)) {
    //On récupère les différentes valeur de l'animal
    $animalHabitat = $row2["habitat"];
    $animalEtat = $row2["etat"];
    $animalRapport = $row2["rapport"];
    $animalPrenom = $row2["prenom"];
    }

    //On défini une variable de type tableau qui va contenir tout les messages de succès
    $successMessages = [];

    if ($prenomForm !== $animalForm && $prenomForm !== null) {
        $insertPrenom = "UPDATE animaux SET prenom = :prenom WHERE prenom = :ancienPrenom";
        $stmt2 = $pdo->prepare($insertPrenom);
        $stmt2->bindParam(":prenom", $prenomForm);
        $stmt2->bindParam(":ancienPrenom", $animalForm);
        $stmt2->execute();
        $successMessages[] = "Le prénom à bien été modifié !";
    }

    if (array_key_exists($habitatForm, $habitatFormMapping)) {
        // Récupérer le code correspondant
        $habitatCode = $habitatFormMapping[$habitatForm]; 
        // Vérifier si le code est différent de l'actuel et non null
        if ($habitatCode !== $animalHabitat && $habitatCode !== null){
        // Préparer et exécuter la requête   
        $insertHabitat = "UPDATE animaux SET habitat = :habitat WHERE prenom = :ancienPrenom";
        $stmt3 = $pdo->prepare($insertHabitat);
        $stmt3->bindParam(":habitat", $habitatCode);
        $stmt3->bindParam(":ancienPrenom", $animalForm);
        $stmt3->execute();
        $successMessages[] = "L'habitat de ". $animalForm . " à bien été modifié !";
    
    } else {}

    } else {}


    
    if (array_key_exists($etatForm, $etatFormMapping)) {
        // Récupérer le code correspondant
        $etatCode = $etatFormMapping[$etatForm];
        // Vérifier si le code est différent de l'actuel et non null
        if ($etatCode !== $animalEtat && $etatCode !== null) {
        // Préparer et exécuter la requête
        $insertEtat = "UPDATE animaux SET etat = :etat WHERE prenom = :ancienPrenom";
        $stmt4 = $pdo->prepare($insertEtat);
        $stmt4->bindParam(":etat", $etatCode);
        $stmt4->bindParam(":ancienPrenom", $animalForm);
        $stmt4->execute();
        $successMessages[] = "L'état de " . $animalForm . " à bien été modifié !";
    }  else {}

    } else {}

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

    $etatForm = (int) $etatForm;

    // Vérifier si une modification à été faite
    if ((isset($prenomForm) && $prenomForm === $animalPrenom) &&
    (isset($habitatForm) && $habitatForm === $animalHabitat) &&
    (isset($etatForm) && $etatForm === $animalEtat) &&
    (isset($rapportForm) && $rapportForm === $animalRapport)) {
    $successMessages[] = "Aucune modification n'a été apportée à " . $animalForm;
}

    //On affiche les message de succès
    if (!empty($successMessages)) {
        echo '<div class="bienvenue mx-auto">' . " <p style='color:#63340B; padding-top:20px; font-weight:bold;'>" . implode("<br>", $successMessages) ."</p>" . "<a style='color:#63340B; padding-top:20px; font-weight:bold;' href='/admin.php';> Retour </a>" . "</div>";
}


?>

</body>