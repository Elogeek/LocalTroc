<div class="search-container">
    <form>
        <select name="search-criteria" id="criteria" method="POST" action="/index.php?controller=search">
            <option value="0">Par ville</option>
            <option value="1">Par titre</option>
            <option value="2">Par utilisateur</option>
        </select>
        <input type="text" id="search" placeholder="Rechercher service" required>
        <input class="btn btn-secondary" type="submit" value="Chercher un service" id="submit">
    </form>
</div>
