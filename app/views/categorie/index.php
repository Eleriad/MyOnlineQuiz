<header>
    <h1>Page d'accueil des catégories</h1>
</header>

<div class="container py-4">
    <table class="table w-100 mt categorieTable">
        <thead>
            <tr>
                <th>Pictos</th>
                <th>Liste des catégories</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['categories'] as $categories) : ?>
            <tr>
                <td><img src="/app/components/img/categorie_picture/<?= $categories->categorie_picture ?>" width="50px"
                        height="50px"></td>
                <td><?= $categories->name ?></td>

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
            [2, "asc"]
        ],
        lengthMenu: [
            [10, 20, 50, -1],
            [10, 20, 50, "Tout"],
        ],
        "columns": [{
            "width": "90%"
        }, {
            "width": "10%"
        }]
    });
});
</script>