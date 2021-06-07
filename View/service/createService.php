

<div class="internal-container">
    <div class="profile-content">
        <div class="profile-table">
            <h1>Ajouter un service</h1>
            <hr>

            <form action="/index.php" method="post" enctype="multipart/form-data">

                <label for="subject">Précisez le titre du service</label>
                <input type="text" name="subject" id="subject" required>

                <label for="serviceImage">Ajouter une image pour votre service</label>
                <input type="file" name="serviceImage" id="serviceImage" accept="image/png, image/jpeg">
                <small class="form-control-info">Optionnel</small>

                <label for="descriptionService">Entrez la description de votre service</label>
                <textarea name="descriptionService" id="descriptionService" cols="70" rows="12" required></textarea>

                <input type="submit" name="submit" value="Ajouter mon service">
            </form>
        </div>
    </div>
</div>