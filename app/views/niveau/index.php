<div class="adminContainer">
    <h1>Page d'accueil des niveaux</h1>

    <?php $this->displayMsg(); ?>

    <div class="container">
        <table class="table w-100 levelTable">
            <thead>
                <tr>
                    <th>Liste des Niveaux</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['niveaux'] as $niveaux) : ?>
                <tr>
                    <td><?= $niveaux->level ?></td>
                    <td>
                        <a href="/niveau/edit/<?= $niveaux->id_niveau ?>" class="modifyBtn"><span><i
                                    class="fas fa-pencil-alt mr-2"></i></span>Modifier</a>
                        <a href="/niveau/delete/<?= $niveaux->id_niveau ?>" class="deleteBtn"><span><i
                                    class="far fa-trash-alt mr-2"></i></span>Supprimer</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <div class="text-center mt-5">
        <a href="/niveau/create" class="createBtn"><i class="fas fa-plus mr-2"></i>Nouveau niveau</a></a>
        <a href="/admin/index" class="returnBtn"><span><i
                    class="far fa-arrow-alt-circle-left mr-2"></i></span>Retour</a>
    </div>
</div>

<script>
$(document).ready(function() {
    var table = $('.levelTable').DataTable({
        language: {
            url: "/app/components/bootstrap/dataTable/media/french.json"
        },
        paging: true,
        scrollX: true,
        responsive: true,
        pagingType: 'numbers',
        fixedHeader: true,
        "order": [
            [2, "asc"]
        ],
        lengthMenu: [
            [10, 20, 50, -1],
            [10, 20, 50, "Tout"],
        ],
    });
});
</script>