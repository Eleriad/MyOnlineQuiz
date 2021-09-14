<div class="adminContainer">
    <h1>Page d'accueil des catégories</h1>

    <table class="table categorieTable">
        <thead>
            <tr>
                <th>Pictos</th>
                <th>Liste des catégories</th>
                <th>Description</th>
                <th>Info</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['categories'] as $categories) : ?>
            <tr>
                <td><img src="/app/components/img/categorie_picture/<?= $categories->categorie_picture ?>" width="50px"
                        height="50px"></td>
                <td><?= $categories->name ?></td>
                <td><?= $categories->description ?></td>
                <td><?= $categories->infos ?></td>
                <td>
                    <a href=" /categorie/edit/<?= $categories->id_categorie ?>" class="modifyBtn"><span><i
                                class="fas fa-pencil-alt mr-2"></i></span>Modifier</a>
                    <a href="/categorie/delete/<?= $categories->id_categorie ?>" class="deleteBtn"><span><i
                                class="far fa-trash-alt mr-2"></i></span>Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="text-center">
    <a href="/categorie/create" class="createBtn"><i class="fas fa-plus mr-2"></i>Nouvelle
        catégorie</a>

    <a href="/admin/index" class="returnBtn"><span><i class="far fa-arrow-alt-circle-left mr-2"></i></span>Retour</a>
</div>

<script>
$(document).ready(function() {
    var table = $('.categorieTable').DataTable({
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
            "width": "15%"
        }, {
            "width": "30%"
        }, {
            "width": "25%"
        }, {
            "width": "20%"
        }]
    });
});
</script>