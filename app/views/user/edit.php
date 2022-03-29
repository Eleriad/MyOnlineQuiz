<?php
$user = $data["editUser"];
?>

<div class="adminContainer text-center">
    <h1>Modification d'un utilisateur</h1>

    <?php $this->displayMsg(); ?>

    <form action="" method="post">
        <div class="form-group">
            <label for="username">Identifiant :
                <input type="text" class="form-control" name="username" id="username" value="<?= $user->username ?>">
            </label>
        </div>
        <div class="form-group">
            <label for="email">Email :
                <input type="email" class="form-control" name="email" id="email" value="<?= $user->email ?>">
            </label>
        </div>
        <div class=" form-group">
            <label for="password">Mot de passe :
                <input type="password" class="form-control" name="password" id="password">
            </label>
            <p>Pour ne pas changer le mot de passe existant, merci de laisser cette case vide ! </p>
        </div>
        <div class="form-group">
            <label for="role">Rôle :</label>
            <select name="role" id="role">
                <option value="<?= $user->role ?>"><?= $user->role ?></option>
                <option value="<?= $user->role = "user" ? "admin" : "user" ?>">
                    <?= $user->role = "user" ? "Admin" : "User" ?></option>
            </select>
        </div>

        <input type="submit" name="editUser" class="createBtn" value="Modifier"></input>
        <a href="/user/index" class="returnBtn"><span><i class="far fa-arrow-alt-circle-left mr-2"></i></span>Retour</a>
    </form>
</div>