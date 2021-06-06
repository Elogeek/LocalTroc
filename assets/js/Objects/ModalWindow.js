
const ModalWindow = function(title, textContent, a) {

    this.overlay = document.createElement('div');

    /**
     * Build the modal window.
     */
    this.build = function() {
        a.addEventListener('click', (event) => {
            // Avoiding action to be triggered.
            event.preventDefault();
            this._buildOverlay();
            const buttonCancel = this._buildModalDialog();

            buttonCancel.addEventListener('click', function() {
                document.body.style.overflowY = 'auto';
                document.getElementById('confirm').remove();
                document.getElementById('overlay').remove();
            });
        });
    }

    /**
     * Build the modal window overlay.
     * @private
     */
    this._buildOverlay = function() {
        this.overlay.id = 'overlay';
        this.overlay.style.position = 'absolute';
        this.overlay.style.top = '0';
        this.overlay.style.left = '0';
        this.overlay.style.backgroundColor = 'rgba(175,175,175,0.5)';
        this.overlay.style.width = '100%';
        this.overlay.style.height = '100vh';
        this.overlay.style.display = 'flex';
        this.overlay.style.justifyContent = 'center';
        this.overlay.style.alignItems = 'center';

        document.body.append(this.overlay);
        document.body.style.overflowY = 'hidden';
    }

    /**
     * Build Modal dialog content.
     * @private
     */
    this._buildModalDialog = function() {
        // Création de la fenêtre modale.
        const confirm = document.createElement('div');
        const h3 = document.createElement('h3');
        const textContentP = document.createElement('p');
        const buttonsContainer = document.createElement('div');
        const confirmButton = document.createElement('a');
        const denyButton = document.createElement('button');

        confirm.id = 'confirm';
        confirm.style.width = '50rem';
        confirm.style.height = '22rem';
        confirm.style.borderRadius = '0.8rem';
        confirm.style.boxShadow = '0px 0px 16px 0px rgba(0,0,0,0.85)';
        confirm.style.backgroundColor = 'white';
        confirm.style.padding = '3rem';

        // Create h3 box title.
        h3.textContent = title;
        h3.style.marginBottom = '2rem';

        // Create text content paragraph.
        textContentP.innerText = textContent;

        // Create the buttons container.
        buttonsContainer.style.display = 'flex';
        buttonsContainer.style.justifyContent = 'space-around';
        buttonsContainer.style.marginTop = '2rem';

        // Create two confirm buttons.
        confirmButton.textContent = 'Ok';
        confirmButton.className = 'btn btn-primary';
        // Copying the href location of <a> element that triggered the modal window.
        confirmButton.href = a.href;
        denyButton.textContent = 'Annuler';
        denyButton.className = 'btn btn-secondary';

        buttonsContainer.append(confirmButton);
        buttonsContainer.append(denyButton);
        confirm.append(h3);
        confirm.append(textContentP);
        confirm.append(buttonsContainer);
        this.overlay.append(confirm);
        return denyButton;
    }
}