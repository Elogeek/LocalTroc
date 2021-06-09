// Specific admin actions.
// User service deletion.
const deleteUserButtons = document.querySelectorAll('.admin-delete-user');
if(deleteUserButtons) {
    for(let buttonDelete of deleteUserButtons){
        const deleteUserModalWindow = new ModalWindow(
            "Supprimer l'utilisateur ?",
            'Tous les services, messages, données de profil et données associées seront supprimées !',
            buttonDelete
        );

        deleteUserModalWindow.build();
    }
}

const deleteUserService = document.querySelectorAll('.admin-delete-service');
if(deleteUserService) {
    for(let buttonDelete of deleteUserService){
        const deleteServiceModalWindow = new ModalWindow(
            "Supprimer ce service ?",
            'Tous les messages associés à ce service seront également supprimés !',
            buttonDelete
        );

        deleteServiceModalWindow.build();
    }
}

// Managing roles attributions.

const form = document.getElementById('roles-edition');
if(form) {
    // Allow to change the value of user role in appropriate span.
    form.querySelector('#user-id').addEventListener('change', function() {
        if(this.selectedIndex !== 0) {
            const currentStr = this.options[this.selectedIndex].dataset.role;
            const roleId = this.options[this.selectedIndex].dataset.roleId;
            document.querySelector('#current-role span').innerHTML = currentStr;
            document.querySelector('#role-id').selectedIndex = parseInt(currentRole) - 1;
        }
        else {
            document.querySelector('#current-role span').innerHTML = 'Aucune sélection';
        }
    });
}
