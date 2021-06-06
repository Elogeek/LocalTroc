<div class="internal-container">
    <div class="profile-content">
        <h1>Nous contacter</h1>
        <hr>
        <div class="login-form">
            <form action="/index.php?controller=info&action=contact">

                <div class="form-group">
                    <div>
                        <label for="fname">Votre prénom</label>
                        <input class="no-margin" type="text" id="fname" name="firstname" required>
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <label for="lname">Votre nom</label>
                        <input class="no-margin" type="text" id="lname" name="lastname" required>
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <label for="mail">Votre adresse mail</label>
                        <input class="no-margin" type="email" id="mail" name="mail" required>
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <label for="subject">Sujet du message</label>
                        <input class="no-margin" type="text" id="subject" name="subject" required>
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <label for="message">Votre message</label>
                        <textarea rows="5" id="message" name="message"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <input class="btn btn-secondary" type="submit" value="Envoyer">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>