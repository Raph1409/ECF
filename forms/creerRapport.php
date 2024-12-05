<form class="formLogin2 mx-auto" action="script/rapportPost.php" method="POST">

    <label class="label" for="nomRapport">Nom du rapport : </label><br>
    <input class="inputBasic2" type="text" name="nomRapport" required><br><br>

    <label class="label" for="contenu">Contenu : </label><br>
    <textarea class="inputBasic2" name="contenu" rows="10" placeholder="Écrivez le rapport ici..."
        required></textarea><br><br>

    <input class="button" type="submit" value="Créer">

</form>
</body>

</html>