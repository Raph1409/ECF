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
    <link href="/styleCSS/styleHabitats.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>

    <?php require_once 'connexionBDD.php'; 

    $queryAnimals = "SELECT 
        animaux.prenom,
        races.nom_race AS race_nom,
        sexes.nom_sexe AS sexe_nom,
        etats.nom_etat AS etat_nom,
        rapports_veterinaire.detail AS rapport_detail,
        habitats.nom AS habitat_nom
    FROM animaux
    LEFT JOIN races ON animaux.race = races.race_id
    LEFT JOIN sexes ON animaux.sexe = sexes.sexe_id
    LEFT JOIN etats ON animaux.etat = etats.id
    LEFT JOIN rapports_veterinaire ON animaux.rapport = rapports_veterinaire.rapport_veterinaire_id
    LEFT JOIN habitats ON animaux.habitat = habitats.habitat_id WHERE habitats.nom = 'Marais'";
    $stmt = $pdo->prepare($queryAnimals);
    $stmt->execute();
    $animals = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //Organiser les animaux par race
    $animalsByRace = [];
    foreach ($animals as $animal) {
        $race = $animal["race_nom"];
        if(!isset($animalsByRace[$race])) {
            //initialiser un tableau pour chaque race
            $animalsByRace[$race] = [];
        }
        //Ajouter l'animal à la race correspondante
        $animalsByRace[$race][] = $animal;
    }

    $raceImages = [
        "Loutre d'Europe"=> "images/loutre.jpg",
        "Flamand rose"=> "images/flamand.jpg",
        "Capibara"=> "images/capybaras.jpg",
        "Aligator du Mississipi"=> "images/aligator.jpg",
        "Rhinocéros indien"=> "images/indian-rhinoceros.jpg",
        "Buffle d'Asie"=> "images/buffalo.jpg",
    ];

    

    foreach ($animalsByRace as $race => $animals) {
        echo "<h4 class='h4race'>$race</h4>" . "<br>";

        if (isset($raceImages[$race])) {
            echo "<img src='" . $raceImages[$race] . "' alt='Image de $race' style='width:200px; height:auto; margin-bottom:30px;'><br>";
        } 

            echo "<div class='container'><div class='row'>";
        foreach ($animals as $animal) {
            echo "<div class='col-12 col-md-6 mb-3'>
                <p class='p_animal w-75 mx-auto'>
                    <span class='underline'>Prénom :</span> " . "  " . $animal['prenom'] . "<br>" . 
                    "<span class='underline'>Sexe :</span> " . "  " . $animal['sexe_nom'] . "<br>" . 
                    "<span class='underline'>État :</span> " . "  " . $animal['etat_nom'] . "<br>" . 
                    "<span class='underline'>Habitat :</span> " . "  " . $animal['habitat_nom'] . "<br>" .
                    "<span class='underline'>Rapport :</span> " . "  " . $animal['rapport_detail'] . "
                </p>
            </div>";
                }

                    echo "</div></div>";
            } 
            ?>


</body>

</html>