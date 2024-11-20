<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    LEFT JOIN habitats ON animaux.habitat = habitats.habitat_id WHERE habitats.nom = 'Savane'";
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
        "Gnou"=> "images/gnou.jpg",
        "Guépard"=> "images/guepard.jpg",
        "Lion"=> "images/lion.png",
        "Zèbre"=> "images/zebre.jpg",
        "Girafe"=> "images/giraffe.jpg",
        "Eléphant d'Afrique"=> "images/elephant2.jpg",
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