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
    require_once '../front/headerAdmin.php'; ?>
</header>

<body>
    <?php require '../front/bigTitle.php';
    
    //On récupère les données du formulaire modifAnimauxform1 
    $animalForm = $_POST['animal'];?>

    <h2>Modification de <?php echo $animalForm; ?> </h2>

    <?php
    
    //On se connect à la BDD
    require_once '../back/connexionBDD.php';

    // On récupère toutes les données de la table animaux
    $queryAnimals = "SELECT * FROM animaux";
    $stmt = $pdo->prepare($queryAnimals);
    $stmt->execute();

    //On récupère toutes les données de la table habitat
    $queryHabitats = "SELECT * FROM habitats";
    $stmt2 = $pdo->prepare($queryHabitats);
    $stmt2->execute();

    //On récupère toute les données de la table rapport
    $queryRapport = "SELECT * FROM rapports_veterinaire";
    $stmt3 = $pdo->prepare($queryRapport);
    $stmt3->execute();

    //On récupère toute les données de la table etats
    $queryEtat = "SELECT * FROM etats";
    $stmt4 = $pdo->prepare($queryEtat);
    $stmt4->execute();

    //On stock les données de chaque table dans une variable
    $animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $habitats = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    $rapports = $stmt3->fetchAll(PDO::FETCH_ASSOC);
    $etats = $stmt4->fetchAll(PDO::FETCH_ASSOC);

    //On récupère les données prenom, habitat, etat, rapport de l'animal en question
    $queryAnimals = 'SELECT prenom, habitat, etat, rapport FROM animaux WHERE prenom = :prenom';
    $stmt4 = $pdo->prepare($queryAnimals);
    $stmt4->bindParam(":prenom", $animalForm);
    $stmt4->execute();
    $stmt4->setFetchMode(PDO::FETCH_ASSOC);

    // on stock les données de l'animal dans des variables
    while ($row = $stmt4->fetch(PDO::FETCH_ASSOC)) {
    $animalPrenom = $row["prenom"];
    $animalHabitat = $row["habitat"];
    $animalEtat = $row["etat"];
    $animalRapport = $row["rapport"];
    }

    //Onréalise le mapping de l'habitat pour la récupération du nom à la place de l'id
    $animalHabitatMapping = [
        1 => 'Marais',
        2 => 'Savane',
        3 => 'Jungle',
    ];

    $animalEtatMapping = [
        1 => 'Non évalué',
        2 => 'Données insuffisantes',
        3 => 'Préoccupation mineure',
        4 => 'Quasi menacé',
        5 => 'Vulnérable',
        6 => 'En danger',
        7 => 'En danger critique',
        8 => "Éteint à l'état sauvage",
        9 => 'Éteint',
    ];


?>
    <!--On écrit le formulaire -->
    <form action="/script/modifAnimaux.php" class="formLogin2 mx-auto w-50" method="POST">

        <!--On renseigne le nom de l'animal selectionner au précédant formulaire dans un hidden -->
        <input type="hidden" name="animal" value="<?php echo $animalForm ?>">

        <!--On Créer l'input pour le prénom de l'animal -->
        <label class="label" for="prenom">Prénom :</label><br>
        <input class="inputBasic2" type="text" name="prenom" value="<?php echo $animalPrenom ?>"><br><br>

        <!--On Créer l'input pour l'habitat de l'animal -->
        <label class="label" for="habitat">Habitat :</label><br>
        <select class="inputBasic2" name="habitat">
            <option value="<?php echo $animalHabitat ?>">
                <?php
            if (array_key_exists($animalHabitat, $animalHabitatMapping)) {
                $habitatCode = $animalHabitatMapping[$animalHabitat];
                echo $habitatCode;
            } 
        ?>
            </option>
            <?php
            foreach($habitats as $habitat){
            if ($habitat['nom'] !== $habitatCode) {
        ?>
            <option><?php echo $habitat['nom'];?> </option>
            <?php 
            } }
        ?>
        </select><br><br>

        <!--On Créer l'input pour l'etat de l'animal -->
        <label class="label" for="etat">État :</label><br>
        <select class="inputBasic2" name="etat">
            <option value="<?php echo $animalEtat ?>">
                <?php
            if (array_key_exists($animalEtat, $animalEtatMapping)) {
            $etatCode = $animalEtatMapping[$animalEtat];
            echo $etatCode;
            } 
        ?>
            </option>
            <?php
            foreach($etats as $etat){
            if ($etat['nom_etat'] !== $etatCode) {
                echo '<option value="' . htmlspecialchars($etat['nom_etat']) . '">' . htmlspecialchars($etat['nom_etat']) . '</option>';
            } }
        ?>
        </select><br><br>

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

</body>

<footer>
    <?php require '../front/footer.php'; ?>
</footer>