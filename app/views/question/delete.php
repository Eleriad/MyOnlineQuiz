<?php
$out = array();
foreach ($data[1] as $categories) {
    array_push($out, $categories['name']);
}
?>

<header>
    <h1 class="text-center">Supprimer une question</h1>
</header>

<div class="container">
    <form action="" method="post">
        <div class="mb-3">
            <p>Catégorie(s) :</p>
            <input type="text" class="form-control" name="question" id="question" value="<?= implode(', ', $out) ?>"
                disabled>
        </div>
        <div class="form-group">
            <label for="selectNiveaux">niveau :</label>
            <input type="text" class="form-control" name="question" id="question" value="<?= $data[0]->level ?>"
                disabled>
        </div>
        <div class="form-group">
            <label for="question">Question :</label>
            <input type="text" class="form-control" name="question" id="question" value="<?= $data[0]->question ?>"
                disabled>
        </div>

        <div class="form-group">
            <label for="questionPicture">Photo de la question :</label>
            <?= $data[0]->question_picture == null ? "" : '<img src="/app/components/img/question_pictures/' . $data[0]->question_picture . '" width="50px" height="50px">' ?>
        </div>

        <div class="form-group">
            <label for="reponse">Bonne réponse :</label>
            <input type="text" class="form-control" name="reponse" id="reponse" value="<?= $data[0]->reponse ?>"
                disabled>
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
            <input type="text" class="form-control" name="difficile" id="difficile" value="<?= $data[0]->difficile ?>"
                disabled>
        </div>
        <div class=" form-group">
            <label for="feedback">feedback :</label>
            <input type="text" class="form-control" name="feedback" id="feedback" value="<?= $data[0]->feedback ?>"
                disabled>
        </div>

        <div class="form-group">
            <label for="feedbackPicture">Photo du feedback :</label>
            <?= $data[0]->feedback_picture == null ? "" : '<img src="/app/components/img/feedback_pictures/' . $data[0]->feedback_picture . '" width="50px" height="50px">' ?>
        </div>

        <div class="form-group">
            <label for="lien">Lien :</label>
            <input type="text" class="form-control" name="lien" id="lien" value="<?= $data[0]->lien ?>" disabled>
        </div>

        <div class="text-center">
            <button type="submit" name="deleteQuestion" class="createBtn"><span><i
                        class="far fa-check-circle mr-2"></i></span>Confirmer la suppression</button>
            <a href="/question/index" class="returnBtn"><span><i
                        class="far fa-arrow-alt-circle-left mr-2"></i></span>Retour</a>
        </div>
    </form>

</div>