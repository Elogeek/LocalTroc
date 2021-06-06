


<form id="createServ" action="/index.php" method="post" enctype="multipart/form-data">
    <h3>Editer un service</h3>

    <input type="date" name="date" required>
    <textarea name="descriptService" id="descriptionService" cols="70" rows="12" required></textarea>
    <input type="file" name="fichierUser" id="id-fichier" accept=".jpg,.jpeg,.png,.txt">
    <input type="submit" name="submit" value="Ajouter mon service">
</form>
