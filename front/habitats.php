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
    <link href="/styleCSS/styleHabitats.css" rel="stylesheet">
    <link href="http://fonts.googleap.com/css?family=Crete+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Nos habitats</title>

</head>

<header>

    <?php require 'header.php'; ?>

</header>

<body>

    <?php require 'bigTitle.php'; ?>

    <h2>Nos habitats et leurs animaux</h2>

    <!-- TEST -->

    <div class="accordion mx-auto" id="accordionExample">
        <div class="accordion-item">
            <h2>LES MARAIS</h2>
            <img src="../images/marais.jpg" class="img-responsive" alt="Responsive image">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Les Marais : Description de l'habitat et animaux
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p class="description">Un habitat de type marais est un écosystème humide caractérisé par des zones
                        d'eau peu profonde,
                        des végétations aquatiques comme des roseaux et des nénuphars, et des sols boueux.
                        Il abrite une grande variété d'animaux tels que des oiseaux aquatiques, des amphibiens, des
                        poissons et des insectes.
                        Ce type d'environnement offre des refuges naturels et joue un rôle essentiel dans la filtration
                        de l'eau et la régulation du climat.
                    </p>
                    <?php require_once '../back/marais.php'; ?>

                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2>LA SAVANE</h2>
            <img src="../images/Savane.jpg" class="img-responsive" alt="Responsive image">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    La Savane : Description de l'habitat et animaux
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p class="description">La savane est un écosystème caractérisé par de vastes étendues herbeuses
                        parsemées de quelques
                        arbres et buissons,
                        principalement dans des régions chaudes et sèches. Elle abrite des animaux comme des herbivores
                        (girafes, zèbres, éléphants)
                        et des prédateurs (lions, hyènes), et est marquée par des saisons de pluie et de sécheresse.
                        La savane joue un rôle clé dans la biodiversité et le cycle de carbone.
                    </p>
                    <?php require_once '../back/savane.php'; ?>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2>LA JUNGLE</h2>
            <img src="../images/jungle.jpg" class="img-responsive" alt="Responsive image">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    La Jungle : Description de l'habitat et animaux
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p class="description">La jungle est un écosystème dense et tropical, avec une végétation
                        luxuriante, composée de grands
                        arbres, de lianes et de plantes grimpantes. Elle abrite une biodiversité exceptionnelle,
                        incluant des animaux comme des singes, des tigres, des oiseaux colorés et des insectes. Ce
                        milieu humide, souvent pluvieux, offre de nombreux refuges et nourritures pour ses habitants.
                    </p>
                    <?php require_once '../back/jungle.php'; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- TEST -->

</body>

<footer>

    <?php require 'footer.php'; ?>

</footer>