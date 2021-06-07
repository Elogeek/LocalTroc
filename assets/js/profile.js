/**
 * Managing user account deletion confirmation dialog.
 */
// User itself delete button.
const deleteUserAction = document.querySelector('#delete-user');
// User service deletion buttons.
const deleteUserServiceAction = document.querySelectorAll('.delete-user-service');

// User account deletion.
if(deleteUserAction) {
    const deleteUserModalWindow = new ModalWindow(
        'Attention !',
        'Voulez vous vraiment supprimer votre compte ? Cette action est irréversible !',
        deleteUserAction
    );

    deleteUserModalWindow.build();
}


// User service deletion.
if(deleteUserServiceAction) {
    for(let buttonDelete of deleteUserServiceAction){
        const deleteUserServiceModalWindow = new ModalWindow(
            'Etes vous sûr ?',
            'Vous êtes sur le point de supprimer votre annonce, tous les messages envoyés et reçus seront également supprimés',
            buttonDelete
        );

        deleteUserServiceModalWindow.build();
    }
}