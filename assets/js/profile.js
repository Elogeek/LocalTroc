/**
 * Managing user account deletion confirmation dialog.
 */
const deleteUserAction = document.querySelector('#delete-user');
if(deleteUserAction) {
    const deleteUserModalWindow = new ModalWindow(
        'Attention !',
        'Voulez vous vraiment supprimer votre compte ? Cette action est irréversible !',
        deleteUserAction
    );

    deleteUserModalWindow.build();
}
