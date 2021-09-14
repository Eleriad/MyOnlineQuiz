<?php
/* // TODO :
    - afficher tous les utilisateurs <=> vérifier pourquoi la table ne prend pas toute la place...
    - créer un utilisateur
    - modifier un utilisateur
    - supprimer un utilisateur
    (- obtenir les thématiques des quiz et les niveaux) - plus tard
    - obtenir les dates de connexion (pour voir son activité)
    - bannir un utilisateur (bloque son ip pendant x temps)
    */
?>

<div class="adminContainer">
    <h1>Page d'accueil de gestion des utilisateurs</h1>

    <table class="table usersTable">
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

<script>
$(document).ready(function() {
    var table = $('.usersTable').DataTable({
        language: {
            url: "/app/components/bootstrap/dataTable/media/french.json"
        },
        paging: true,
        scrollX: true,
        responsive: true,
        pagingType: 'numbers',
        fixedHeader: true,
        "order": [
            [1, "asc"]
        ],
        lengthMenu: [
            [10, 20, 50, -1],
            [10, 20, 50, "Tout"],
        ],
        "columns": [{
            "width": "10%"
        }, {
            "width": "20%"
        }, {
            "width": "20%"
        }, {
            "width": "10%"
        }, {
            "width": "max-content"
        }]
    });
});
</script>