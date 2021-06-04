<!-- Create user account -->
<div>
    <form action="/index.php?controller=user&action=register" method="POST">
        <h4>Créer un compte </h4>

        <!-- first name and last name -->
        <input type="text" name="firstname" id="firstname" placeholder="Prénom" required>
        <input type="text" name="lastname" id="lastname" placeholder="Nom" required>
        <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required>

        <!-- User infos. -->

        <input type="date" name="birthday">
        <input name="city" type="text" placeholder="Ville" required>
        <input name="address" type="text" placeholder="Adresse" required>
        <input name="codeZip" type="number" placeholder="Code postal" required>
        <input name="other" type="text" placeholder="Autre : diplôme, passions, compétences,...">
        <input name="phone" type="tel" placeholder="Téléphone">

        <!-- User info connect -->
        <input name="mail" type="email" placeholder="Adresse mail" required>
        <input type="password" name="password" id="password" placeholder="Mot de passe" required>
        <small>Min 5 caractères, lettres, majuscules, chiffres </small>
        <input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Répétez le mot de passe" required>

        <input type="submit" name="submit" value="Créer mon compte">
    </form>

</div>