<?php
require_once 'connexionBDD.php'; 

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

// Organiser les animaux par race
$animalsByRace = [];
foreach ($animals as $animal) {
    $race = $animal["race_nom"];
    if (!isset($animalsByRace[$race])) {
        $animalsByRace[$race] = [];
    }
    $animalsByRace[$race][] = $animal;
}

$raceImages = [
    "Loutre d'Europe" => "images/loutre.jpg",
    "Flamand rose" => "images/flamand.jpg",
    "Capibara" => "images/capybaras.jpg",
    "Aligator du Mississipi" => "images/aligator.jpg",
    "Rhinocéros indien" => "images/indian-rhinoceros.jpg",
    "Buffle d'Asie" => "images/buffalo.jpg",
];

foreach ($animalsByRace as $race => $animals) {
    echo "<h4 class='h4race'>$race</h4><br>";

    // Affichage de l'image de la race, si elle existe
    if (isset($raceImages[$race])) {
        echo "<img src='" . $raceImages[$race] . "' alt='Image de $race' style='width:200px; height:150px; margin-bottom:30px;'><br>";
    }

    echo "<div class='container'><div class='row'>";
    foreach ($animals as $animal) {
        $animalId = htmlspecialchars($animal['prenom'], ENT_QUOTES, 'UTF-8');

        echo "<div class='col-12 col-md-6 mb-3'>
            <!-- Accordéon pour chaque animal -->
            <div class='accordion mx-auto' id='accordionAnimal$animalId'>
                <div class='accordion-item'>
                    <h2 class='accordion-header' id='heading$animalId'>
                        <button class='btn btn-link collapsed' type='button' data-bs-toggle='collapse'
                            data-bs-target='#collapse$animalId' aria-expanded='false' aria-controls='collapse$animalId'>
                            " . htmlspecialchars($animal['prenom'], ENT_QUOTES, 'UTF-8') . "
                        </button>
                    </h2>
                    <div id='collapse$animalId' class='accordion-collapse collapse' aria-labelledby='heading$animalId'>
                        <div class='accordion-body'>
                            <p class='p_animal'>
                                <span class='underline'>Sexe :</span> " . htmlspecialchars($animal['sexe_nom'], ENT_QUOTES, 'UTF-8') . "<br>
                                <span class='underline'>État :</span> " . htmlspecialchars($animal['etat_nom'], ENT_QUOTES, 'UTF-8') . "<br>
                                <span class='underline'>Habitat :</span> " . htmlspecialchars($animal['habitat_nom'], ENT_QUOTES, 'UTF-8') . "<br>
                                <span class='underline'>Rapport :</span> " . htmlspecialchars($animal['rapport_detail'], ENT_QUOTES, 'UTF-8') . "
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
    }
    echo "</div></div>";
}
?>