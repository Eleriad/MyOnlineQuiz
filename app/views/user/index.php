<div class="adminContainer text-center">
    <h1>Page d'accueil de gestion des utilisateurs</h1>

    <?php $this->displayMsg(); ?>

    <table class="table userTable mt-5">
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

    <div class="text-center">
        <a href="/user/create" class="createBtn"><i class="fas fa-plus mr-2"></i>Ajouter un nouvel utilisateur</a>

        <a href="/admin/index" class="returnBtn"><span><i
                    class="far fa-arrow-alt-circle-left mr-2"></i></span>Retour</a>
    </div>