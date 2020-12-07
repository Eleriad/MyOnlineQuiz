<h1 class="text-center">Page d'accueil des questions</h1>

<div class="container-fluid p-4 mt-4">
    <table class="table questionTable w-100 mt">
        <thead>
            <tr>
                <th>Catégories</th>
                <th>Niveau</th>
                <th>Question</th>
                <th>Bonne réponse</th>
                <th>Réponse facile</th>
                <th>Réponse normale</th>
                <th>Réponse difficile</th>
                <th>Feedback</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- 1st foreach to display datas -->
            <?php foreach ($data['questions'] as $question) :
                $out = array();

                // 2nd foreach to display specific categories' datas
                foreach ($question->categories as $categorie) {
                    array_push($out, $categorie["name"]);
                }
            ?>
                <tr>
                    <td>
                        <?= implode(', ', $out) ?></br>
                    </td>
                    <td><?= $question->level ?></td>
                    <td><?= $question->question ?></td>
                    <td><?= $question->reponse ?></td>
                    <td><?= $question->facile ?></td>
                    <td><?= $question->normal ?></td>
                    <td><?= $question->difficile ?></td>
                    <td><?= $question->feedback ?></td>
                    <td>
                        <a href="/question/edit/<?= $question->id_question ?>" class="btn btn-warning btn-sm"><span><i class="fas fa-pencil-alt mr-2"></i></span>Modifier</a>
                        <a href="/question/delete/<?= $question->id_question ?>" class="btn btn-danger btn-sm"><span><i class="far fa-trash-alt mr-2"></i></span>Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="text-center">
    <a href="/question/create" class="btn btn-success">Ajouter une nouvelle question</a>

    <a href="/admin/index" class="btn btn-dark">Retour</a>
</div>

<script>
    $(document).ready(function() {
        var table = $('.questionTable').DataTable({
            // Sélection de la langue du texte des éléments du dataTable
            language: {
                url: "/app/components/bootstrap/dataTable/media/french.json"
            },
            // Active la pagination
            paging: true,
            // Permet le scroll horizontal
            scrollX: true,
            // Active la responsivité du dataTable
            responsive: true,
            // Définit le type d'affichage des numéros et des boutons en bas de dataTable
            pagingType: 'numbers',
            // Active l'affichage en-tête/pied-de-page fixe
            fixedHeader: true,
            // Délection de la colonne et du type d'affichage (ici première colonne, affichage descendant)
            "order": [
                [2, "asc"]
            ],
            // Définit les propositions pour le choix de séelction d'affichage du nombre de lignes du dataTable
            lengthMenu: [
                [10, 20, 50, -1],
                [10, 20, 50, "Tout"],
            ],
        });
    });
</script>