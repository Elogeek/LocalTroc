<div class="internal-container">
    <div class="profile-content">
        <?php
        use App\Entity\User;

        require_once $_SERVER['DOCUMENT_ROOT'] . '/View/user/_partials/avatar-and-menu.php';
        $users = $params['users'];
        $roles = $params['roles'];
        ?>

        <div class="profile-table">
            <h1>Changer le rôle d'un utilisateur</h1>
            <hr>

            <form action="/index.php?controller=admin&action=roles" method="POST" id="roles-edition">
                <!-- Current selected user role -->
                <div class="form-group">
                    <div>
                        <p id="current-role">Rôle actuel: <span>Aucune sélection</span></p>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group-item">
                        <!-- User selection. -->
                        <label for="user-id">Utilisateur</label>
                        <select name="user-id" id="user-id">
                            <option value="0">Sélectionnez un utilisateur</option><?php
                            foreach ($users as $user) {
                                $optionValue = $user->getFirstName() ." ". $user->getLastName() ." ( ". $user->getEmail() . " )";
                                ?>
                                <option value="<?= $user->getId() ?>"
                                        data-role="<?= ucfirst($user->getRole()->getName()) ?>"
                                        data-role-id="<?= $user->getRole()->getId() ?>"
                                ><?= $optionValue ?></option>
                                <?php
                            } ?>
                        </select>
                    </div>

                    <!-- Role selection -->
                    <div class="form-group-item">
                        <div>
                            <label for="role-id">Rôle à appliquer</label>
                            <select name="role-id" id="role-id"> <?php
                                foreach($roles as $role) { ?>
                                    <option value="<?= $role->getId() ?>"><?= $role->getName() ?></option><?php
                                } ?>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <div class="form-group-item">
                        <input class="btn btn-secondary" type="submit" name="submit" value="Sauvegarder">
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>