<?php
/* // TODO :
    (- obtenir les thématiques des quiz et les niveaux) - plus tard
    - obtenir les dates de connexion (pour voir son activité) - notamment sa date de dernière activité afin de supprimer un utilisateur qui n'est pas venu pendant longtemps ?
    - bannir un utilisateur (bloque son ip pendant x temps)
    */
?>
<div class="text-center">
    <h1>Page d'accueil de gestion des utilisateurs</h1>
</div>

<?php
$this->displayMsg();
?>
<div class="container-fluid userContainer p-4 mt-4">
    <table class="table userTable">
        <thead>
            <tr>
                <th>id</th>
                <th>Pseudo</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['users'] as $user) : ?>
            <tr>
                <td><?= $user->id ?></td>
                <td><?= $user->username ?></td>
                <td><?= $user->email ?></td>
                <td><?= $user->role ?></td>
                <td>
                    <a href=" /user/edit/<?= $user->id ?>" class="modifyBtn"><span><i
                                class="fas fa-pencil-alt mr-2"></i></span>Modifier</a>
                    <a href="/user/delete/<?= $user->id ?>" class="deleteBtn"><span><i
                                class="far fa-trash-alt mr-2"></i></span>Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="text-center">
    <a href="/user/create" class="createBtn"><i class="fas fa-plus mr-2"></i>Ajouter un nouvel utilisateur</a>

    <a href="/admin/index" class="returnBtn"><span><i class="far fa-arrow-alt-circle-left mr-2"></i></span>Retour</a>
</div>