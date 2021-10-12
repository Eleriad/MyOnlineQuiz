<div class="registerContainer">

    <h1>Bienvenue sur la page de création de compte</h1>

    <div class="formDiv">
        <div class="registerForm">
            <h4>Formulaire d'inscription</h4>
            <?php
            $this->displayMsg();
            ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="identifiant">Identifiant</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp"
                        placeholder="Entrez un identifiant" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                        placeholder="Entrez un e-mail valide" required>
                    <small class="form-text">Votre email ne sera utilisé qu'en cas de newsletter</small>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password"
                        aria-describedby="emailHelp" placeholder="Entrez un mot de passe" required>
                    <small class="form-text">Celui-ci doit contenir au moins 1 chiffre, 1 majuscule et 1 caractère
                        spécial</small>
                </div>
                <div class="form-group">
                    <label for="checkPassword">Vérification du mot de passe</label>
                    <input type="password" class="form-control" id="checkPassword" name="checkPassword"
                        aria-describedby="emailHelp" placeholder="Entrez un mot de passe" required>
                    <small class="form-text">Merci de répéter ici votre mot de passe</small>
                </div>
                <input class="registerBtn" type="submit" name="register" value="Envoyer">
            </form>
        </div>
    </div>
</div>