<?php
$user = $data["deleteUser"];
?>
<div class="adminContainer text-center">
    <h1>Suppression d'un utilisateur</h1>

    <form action="" method="post">
        <div class="form-group">
            <label for="username">Identifiant :
                <input type="text" class="form-control" name="username" id="username" value="<?= $user->username ?>"
                    disabled>
            </label>
        </div>
        <div class="form-group">
            <label for="email">Email :
                <input type="email" class="form-control" name="email" id="email" value="<?= $user->email ?>" disabled>
            </label>
        </div>
        <div class=" form-group">
            <label for="password">Mot de passe :
                <input type="password" class="form-control" name="password" id="password" disabled>
            </label>
            <p>Pour ne pas changer le mot de passe existant, merci de laisser cette case vide ! </p>
        </div>
        <div class="form-group">
            <label for="role">Rôle :</label>
            <select name="role" id="role" disabled>
                <option value="<?= $user->role ?>"><?= $user->role ?></option>
                <option value="<?= $user->role = "user" ? "admin" : "user" ?>">
                    <?= $user->role = "user" ? "Admin" : "User" ?></option>
            </select>
        </div>

        <button type="submit" name="deleteUser" class="createBtn"><span><i
                    class="far fa-check-circle mr-2"></i></span>Confirmer la suppression</button>
        <a href="/user/index" class="returnBtn"><span><i class="far fa-arrow-alt-circle-left mr-2"></i></span>Retour</a>
    </form>
</div>