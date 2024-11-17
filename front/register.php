<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
</head>

<body>

    <div class="row mx-auto" id="row2">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h2>Créer un compte</h2>
                    <form class="formLogin2 mx-auto" action="front/registerPost.php" method="POST">

                        <label class="label" for="pseudo">Pseudo : </label><br>
                        <input class="inputBasic2" type="text" name="pseudo" required><br><br>

                        <label class="label" for="email">Adresse email : </label><br>
                        <input class="inputBasic2" type="email" name="email" required><br><br>

                        <label class="label" for="password">Password : </label><br>
                        <input class="inputBasic2" type="password" name="password" required><br><br>

                        <label class="label" for="name">nom : </label><br>
                        <input class="inputBasic2" type="text" name="name" required><br><br>

                        <label class="label" for="surname">Prénom : </label><br>
                        <input class="inputBasic2" type="text" name="surname" required><br><br>

                        <label class="label" for="role-select">Rôle : </label><br>

                        <select name="role" id="pet-select">
                            <option value="">--Choisissez un rôle--</option>
                            <option value="2">Vétérinaire</option>
                            <option value="3">employé(e)s</option>
                        </select> <br><br>

                        <input type="submit" value="Créer">

                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>