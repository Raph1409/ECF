<!DOCTYPE html>
<html lang="en">

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
    <link href="/styleCSS/styleFormLogin.css" rel="stylesheet">
    <link href="/styleCSS/styleAdmin.css" rel="stylesheet">
    <link href="http://fonts.googleap.com/css?family=Crete+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Administration</title>
</head>

<header>
    <?php
    session_start(); 
    require_once '../front/headerVeterinaire.php'; ?>
</header>

<body>
    <?php require '../front/bigTitle.php';
    
    //On récupère les données du formulaire modifAnimauxform 
    $animalForm = $_POST['animal'];?>

    <h2>Modification de <?php echo $animalForm; ?> </h2>

    <?php
    
    //On se connect à la BDD
    require_once '../back/connexionBDD.php';

    //On récupère toute les données de la table rapport
    $queryRapport = "SELECT * FROM rapports_veterinaire";
    $stmt = $pdo->prepare($queryRapport);
    $stmt->execute();

    $rapports = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //On récupère les données rapport de l'animal en question
    $queryAnimals = 'SELECT rapport FROM animaux WHERE prenom = :prenom';
    $stmt2 = $pdo->prepare($queryAnimals);
    $stmt2->bindParam(":prenom", $animalForm);
    $stmt2->execute();
    $stmt2->setFetchMode(PDO::FETCH_ASSOC);

    ?>

    <!--On écrit le formulaire -->
    <form action="/script/modifRapport.php" class="formLogin2 mx-auto w-50" method="POST">

        <!--On renseigne le nom de l'animal selectionner au précédant formulaire dans un hidden -->
        <input type="hidden" name="animal" value="<?php echo $animalForm ?>">

        <!--On Créer l'input pour le rapport de l'animal -->
        <label class="label" for="rapport">Rapport :</label><br>
        <select class="inputBasic2" name="rapport">
            <option value="<?php echo $animalRapport ?>">--Choisissez un rapport--</option>

            <?php 
            foreach ($rapports as $rapport): ?>
            <option value="<?php echo $rapport['rapport_veterinaire_id']; ?>">
                <?php echo ($rapport['nom']); ?>
            </option>
            <?php endforeach; ?>
        </select><br><br>

        <!--On Créer le bouton d'envoi -->
        <input class="button" type="submit" value="Modifier">

    </form>;