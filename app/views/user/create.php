<div class="text-center">
    <h1>Création d'un nouvel utilisateur</h1>
</div>
<div class="container text-center">
    <form action="" method="post">
        <div class="form-group">
            <label for="username">Identifiant :
                <input type="text" class="form-control" name="username" id="username">
            </label>
        </div>
        <div class="form-group">
            <label for="email">Email :
                <input type="email" class="form-control" name="email" id="email">
            </label>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe :
                <input type="password" class="form-control" name="password" id="password">
            </label>
        </div>
        <div class="form-group">
            <label for="role">Rôle :</label>
            <select name="role" id="role">
                <option value="0">-------</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>

        <input type="submit" name="addUser" class="createBtn" value="Créer"></input>
        <a href="/user/index" class="returnBtn"><span><i class="far fa-arrow-alt-circle-left mr-2"></i></span>Retour</a>
    </form>
</div>