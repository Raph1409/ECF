<form class="formLogin2 mx-auto" action="script/registerPost.php" method="POST">

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

    <input class="button" type="submit" value="Créer">

</form>
</body>

</html>