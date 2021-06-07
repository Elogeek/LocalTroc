/**
 * Managing user account deletion confirmation dialog.
 */
const deleteUserAction = document.querySelector('#delete-user');
const deleteUserServiceAction = document.querySelector('#delete-user-service');

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
    const deleteUserServcieModalWindow = new ModalWindow(
        'Etes vous sûr ?',
        'Vous êtes sur le point de supprimer votre annonce, tous les messages envoyés et reçus seront également supprimés',
        deleteUserServiceAction
    );

    deleteUserServcieModalWindow.build();
}