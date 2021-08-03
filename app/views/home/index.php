<div class="container-fluid homeContainer">
    <div class="container connectDiv">
        <div class="col col-6 leftCol">
            <img src="/app/components/img/Thot ombre 1.svg" class="logo" onmouseover="this.src='/app/components/img/Thot Sépia.svg'" onmouseout="this.src='/app/components/img/Thot ombre 1.svg'">
            <a href="/login/register" class="accountBtn registerBtn">Créer un compte</a>
        </div>

        <div class="col col-6 rightCol">
            <h1>Connexion</h1>
            <form class="accountForm" method="post">
                <div class="inputRow">
                    <input class="accountInput" type="email" value="" placeholder="Votre email" name="email">
                    <i class="fas fa-user"></i>
                </div>
                <div class="inputRow">
                    <input class="accountInput" type="password" value="" placeholder="Votre mot de passe" name="password">
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