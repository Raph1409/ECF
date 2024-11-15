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
    <link href="/styleCSS/styleFormLogin.css" rel="stylesheet">
    <link href="/styleCSS/styleAdmin.css" rel="stylesheet">
    <link href="http://fonts.googleap.com/css?family=Crete+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Vétérinaire</title>
</head>

<header>
    <?php
    session_start(); 
    require 'front/header.php'; ?>
</header>

<body>
    <?php require 'front/bigTitle.php'; ?>

    <h2>Page Vétérinaire</h2>
    <div class="body mx-auto">
        <p>Bienvenue <?php echo $_SESSION["user"]["nom"] ." " . $_SESSION["user"]["email"] ?> </p>
        <button class="button" onclick="window.location.href = 'front/deconnexion.php';"> Déconnexion </button>
    </div>

</body>

<footer>
    <?php require 'front/footer.php'; ?>
</footer>