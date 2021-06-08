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