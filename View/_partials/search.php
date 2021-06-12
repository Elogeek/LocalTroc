<div class="search-container">
    <form method="POST" action="/index.php?controller=search">
        <select name="search-criteria" id="criteria">
            <option value="country">Par ville</option>
            <option value="title">Par titre</option>
            <option value="user">Par utilisateur</option>
        </select>
        <input type="text" id="search" name="search-text" placeholder="Rechercher service" required>
        <input class="btn btn-secondary" type="submit" value="Chercher un service" id="submit">
    </form>
</div>
