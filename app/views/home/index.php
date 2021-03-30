<div class="container-fluid bodyContainer">
    <div class="container connectPage">
        <div class="col col-6 col1">
            <img src="/app/components/img/testLogo4.png" class="logo">
            <a href="/login/register" class="accountBtn registerBtn">Créer un compte</a>
        </div>

        <div class="col col-6 col2">
            <h1>Connexion</h1>

            <form class="accountForm" method="post">
                <div class="inputRow">
                    <input class="accountInput" type="email" value="" placeholder="Votre email" name="email">
                    <i class="fas fa-user"></i>
                </div>
                <div class="inputRow">
                    <input class="accountInput" type="password" value="" placeholder="Votre mot de passe"
                        name="password">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="formButtons">
                    <a href="/login/password" class="forgottenPwd">Mot de passe oublié ?</a>
                    <input type="submit" name="login" value="Se connecter" class="accountBtn connexionBtn">
                </div>
            </form>
        </div>
    </div>
</div>