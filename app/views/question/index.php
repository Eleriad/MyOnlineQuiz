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
                    <a href="/question/edit/<?= $question->id_question ?>" class="modifyBtn"><span><i
                                class="fas fa-pencil-alt mr-2"></i></span>Modifier</a>
                    <a href="/question/delete/<?= $question->id_question ?>" class="deleteBtn"><span><i
                                class="far fa-trash-alt mr-2"></i></span>Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="text-center">
    <a href="/question/create" class="createBtn"><i class="fas fa-plus mr-2"></i>Nouvelle
        question</a>

    <a href="/admin/index" class="returnBtn"><span><i class="far fa-arrow-alt-circle-left mr-2"></i></span>Retour</a>
</div>

<script>
$(document).ready(function() {
    var table = $('.questionTable').DataTable({
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
        "columnDefs": [{
            "width": "17%",
            "targets": -1
        }]
    });
});
</script>