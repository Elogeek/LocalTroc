
const ModalWindow = function(title, textContent, a) {

    this.overlay = document.createElement('div');

    /**
     * Build the modal window.
     */
    this.build = function() {
        a.addEventListener('click', (event) => {
            // Avoiding action to be triggered.
            event.preventDefault();

            // Defining overlay.
            this.overlay.className = 'modal-overlay';
            this.overlay.id = 'overlay';
            document.body.append(this.overlay);
            document.body.style.overflowY = 'hidden';

            // Création de la fenêtre modale.
            const confirm = document.createElement('div');
            confirm.id = 'confirm';

            // Window title.
            const h3 = document.createElement('h3');
            h3.textContent = title;

            // Create text content paragraph.
            const textContentP = document.createElement('p');
            textContentP.innerText = textContent;

            // Create buttons containers and buttons
            const buttonsContainer = document.createElement('div');
            const confirmButton = document.createElement('a');
            const denyButton = document.createElement('button');
            buttonsContainer.className = 'modal-buttons-container';
            confirmButton.textContent = 'Ok';
            denyButton.textContent = 'Annuler';
            confirmButton.className = 'btn btn-primary';
            denyButton.className = 'btn btn-secondary';

            // Copying the href location of <a> element that triggered the modal window.
            confirmButton.href = a.href;

            buttonsContainer.append(confirmButton);
            buttonsContainer.append(denyButton);
            confirm.append(h3);
            confirm.append(textContentP);
            confirm.append(buttonsContainer);
            this.overlay.append(confirm);

            denyButton.addEventListener('click', function() {
                document.body.style.overflowY = 'auto';
                document.getElementById('confirm').remove();
                document.getElementById('overlay').remove();
            });
        });
    }
}