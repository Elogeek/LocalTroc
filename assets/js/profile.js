const deleteUserAction = document.querySelector('#delete-user');

// Make sure action link exists.
if(deleteUserAction) {
    deleteUserAction.addEventListener('click', function(event) {
        event.preventDefault();
        const overlay = createOverlay();

        // Création de la fenêtre modale.
        const confirm = document.createElement('div');
        confirm.id = 'confirm';
        confirm.style.width = '50rem';
        confirm.style.height = '22rem';
        confirm.style.borderRadius = '0.8rem';
        confirm.style.boxShadow = '0px 0px 16px 0px rgba(0,0,0,0.85)';
        confirm.style.backgroundColor = 'white';
        confirm.style.padding = '3rem';

        // Create h3 box title.
        const h3 = document.createElement('h3');
        h3.textContent = 'Attention !';
        h3.style.marginBottom = '2rem';

        // Create text content paragraph.
        const textContent = document.createElement('p');
        textContent.innerText = "Voulez vous vraiment supprimer votre compte ? Cette action est irréversible !";

        // Create the buttons container.
        const buttonsContainer = document.createElement('div');
        buttonsContainer.style.display = 'flex';
        buttonsContainer.style.justifyContent = 'space-around';
        buttonsContainer.style.marginTop = '2rem';

        // Create two confirm buttons.
        const confirmButton = document.createElement('a');
        const denyButton = document.createElement('button');
        confirmButton.textContent = 'Oui';
        confirmButton.className = 'btn btn-primary';
        // Copying the href location of <a> element that triggered the modal window.
        confirmButton.href = deleteUserAction.href;
        denyButton.textContent = 'Annuler';
        denyButton.className = 'btn btn-secondary';

        buttonsContainer.append(confirmButton);
        buttonsContainer.append(denyButton);
        confirm.append(h3);
        confirm.append(textContent);
        confirm.append(buttonsContainer);
        overlay.append(confirm);

        confirmButton.addEventListener('click', function(e) {

        });

        denyButton.addEventListener('click', function() {
           document.body.style.overflowY = 'auto';
           document.getElementById('confirm').remove();
           document.getElementById('overlay').remove();
        });
    });
}

/**
 * Create an overlay for modal windows.
 */
function createOverlay() {
    const overlay = document.createElement('div');
    overlay.id = 'overlay';
    overlay.style.position = 'absolute';
    overlay.style.top = '0';
    overlay.style.left = '0';
    overlay.style.backgroundColor = 'rgba(175,175,175,0.5)';
    overlay.style.width = '100%';
    overlay.style.height = '100vh';
    overlay.style.display = 'flex';
    overlay.style.justifyContent = 'center';
    overlay.style.alignItems = 'center';

    document.body.append(overlay);
    document.body.style.overflowY = 'hidden';
    return overlay;
}