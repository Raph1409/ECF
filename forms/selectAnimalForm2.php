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
    <link href="/styleCSS/styleAdmin.css" rel="stylesheet">
    <link href="http://fonts.googleap.com/css?family=Crete+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<?php

    require_once 'back/connexionBDD.php';

    $queryAnimals = "SELECT a.prenom, r.nom_race 
                 FROM animaux a
                 JOIN races r ON a.race = r.race_id";
    $stmt = $pdo->prepare($queryAnimals);
    $stmt->execute();
    $animals = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<form action="/forms/modifRapportForm.php" class="formLogin2 mx-auto" method="POST">

    <label class="label" for="animal">Animal :</label><br>
    <select class="inputBasic2" name="animal" id="animal-select">
        <option value="">--Choisissez un animal--</option>
        <?php
    foreach($animals as $animal){
        echo '<option value="' . htmlspecialchars($animal['prenom']) . '">' . htmlspecialchars($animal['prenom']) . ' (' . htmlspecialchars($animal['nom_race']) . ')</option>';
    }?>
    </select><br><br>
    <input class="button" type="submit" value="Choisir">
</form>