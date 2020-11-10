<div class="container text-center py-4">
    <h1>Page d'accueil des catégories</h1>

    <div class="container py-4">
        <table class="table w-100 mt">
            <thead>
                <tr>
                    <th>Liste des catégories</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data['categories'] as $categories) {
                    echo '
                    <tr>
                        <td>' . $categories->name . '</td>
                        <td>
                            <a href="/categorie/edit/' . $categories->id_categorie . '" class="btn btn-warning btn-sm"><span><i class="fas fa-pencil-alt mr-2"></i></span>Modifier</a>
                            <a href="/categorie/delete/' . $categories->id_categorie . '" class="btn btn-danger btn-sm"><span><i class="far fa-trash-alt mr-2"></i></span>Supprimer</a>
                        </td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="text-center">
        <a href="/categorie/create" class="btn btn-success">Créer une nouvelle catégorie</a>

        <a href="/admin/index" class="btn btn-dark">Retour</a>
    </div>
</div>