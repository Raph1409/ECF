<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
</head>

<body>
    <h1>Créer un compte</h1>
    <form action="registerPost.php" method="POST">

        <label for="pseudo">Pseudo : </label>
        <input type="text" name="pseudo" required><br><br>

        <label for="email">Adresse email : </label>
        <input type="email" name="email" required><br><br>

        <label for="password">Password : </label>
        <input type="password" name="password" required><br><br>

        <label for="name">nom : </label>
        <input type="text" name="name" required><br><br>

        <label for="surname">Prénom : </label>
        <input type="text" name="surname" required><br><br>

        <input type="submit" value="Créer">

    </form>
</body>

</html>