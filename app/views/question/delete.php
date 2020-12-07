<?php
// Foreach to display categories' datas
$out = array();
foreach ($data[1] as $categories) {
    array_push($out, $categories['name']);
} ?>

<div class="container">
    <h1 class="text-center">Supprimer une question</h1>

    <form action="" method="post">
        <div class="mb-3">
            <p>Catégorie(s) :</p>
            <input type="text" class="form-control" name="question" id="question" value="<?= implode(', ', $out) ?>" disabled>
        </div>
        <div class="form-group">
            <label for="selectNiveaux">niveau :</label>
            <input type="text" class="form-control" name="question" id="question" value="<?= $data[0]->level ?>" disabled>
        </div>
        <div class="form-group">
            <label for="question">Question :</label>
            <input type="text" class="form-control" name="question" id="question" value="<?= $data[0]->question ?>" disabled>
        </div>
        <div class="form-group">
            <label for="reponse">Bonne réponse :</label>
            <input type="text" class="form-control" name="reponse" id="reponse" value="<?= $data[0]->reponse ?>" disabled>
        </div>
        <div class="form-group">
            <label for="facile">Réponse facile :</label>
            <input type="text" class="form-control" name="facile" id="facile" value="<?= $data[0]->facile ?>" disabled>
        </div>
        <div class="form-group">
            <label for="normal">Réponse normale :</label>
            <input type="text" class="form-control" name="normal" id="normal" value="<?= $data[0]->normal ?>" disabled>
        </div>
        <div class="form-group">
            <label for="difficile">Réponse difficile :</label>
            <input type="text" class="form-control" name="difficile" id="difficile" value="<?= $data[0]->difficile ?>" disabled>
        </div>
        <div class=" form-group">
            <label for="feedback">feedback :</label>
            <input type="text" class="form-control" name="feedback" id="feedback" value="<?= $data[0]->feedback ?>" disabled>
        </div>

        <div class="text-center">
            <input type="submit" name="deleteQuestion" class="btn btn-danger" value="Supprimer"></input>
            <a href="/question/index" class="btn btn-dark">Retour</a>
        </div>
    </form>

</div>