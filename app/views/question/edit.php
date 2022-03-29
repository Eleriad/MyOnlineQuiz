<header>
    <h1 class="text-center">Modifier une question</h1>
</header>

<!-- Vérification du formulaire en JS -->
<div role="alert" id="errorMessage">
</div>

<?php if (isset($_GET['Message']) && $_GET['Message'] = "errCat") : ?>
<!-- Vérification du formulaire en PHP -->
<div class="alert alert-danger my-3" role="alert">
    Aucune catégorie n'a été sélectionnée !
</div>
<?php endif; ?>

<div class="container">
    <form action="" method="post" id="editQuestionForm">
        <div class="mb-3">
            <p>Catégorie(s) :</p>
            <div class="d-flex">
                <?php foreach ($data['categories'] as $categories) : ?>
                <div class="form-check mr-3">
                    <input type="checkbox" class="form-check-input inputCategories" name="categories[]" id="categories"
                        value="<?= $categories->id_categorie ?>"
                        <?php foreach ($data["categorieNames"] as $names) {
                                                                                                                                                                            if ($categories->name === $names["name"]) echo "checked='checked'";
                                                                                                                                                                        } ?>>
                    <label for="categories" class="form-check-label"><?= $categories->name ?></label>
                </div>
                <?php endforeach ?>
            </div>
        </div>
        <div class="form-group">
            <label for="selectNiveaux">niveau(x) :</label>
            <select name="niveaux" id="selectNiveaux">
                <?php foreach ($data['niveaux'] as $niveaux) : ?>
                <option value="<?= $niveaux->id_niveau ?>"
                    <?php if ($niveaux->level === $data["question"]->level) echo 'selected="selected"'; ?>>
                    <?= $niveaux->level ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <label for="question">Question :</label>
            <input type="text" class="form-control" name="question" id="question"
                value="<?= $data["question"]->question ?>">
        </div>

        <div class="form-group">
            <label for="reponse">Bonne réponse :</label>
            <input type="text" class="form-control" name="reponse" id="reponse"
                value="<?= $data["question"]->reponse ?>">
        </div>

        <div class="form-group">
            <label for="facile">Réponse facile :</label>
            <input type="text" class="form-control" name="facile" id="facile" value="<?= $data["question"]->facile ?>">
        </div>

        <div class="form-group">
            <label for="normal">Réponse normale :</label>
            <input type="text" class="form-control" name="normal" id="normal" value="<?= $data["question"]->normal ?>">
        </div>

        <div class="form-group">
            <label for="difficile">Réponse difficile :</label>
            <input type="text" class="form-control" name="difficile" id="difficile"
                value="<?= $data["question"]->difficile ?>">
        </div>

        <div class="form-group">
            <label for="feedback">feedback :</label>
            <input type="text" class="form-control" name="feedback" id="feedback"
                value="<?= $data["question"]->feedback ?>">
        </div>

        <div class="form-group">
            <label for="lien">Lien :</label>
            <input type="text" class="form-control" name="lien" id="lien" value="<?= $data["question"]->lien ?>">
        </div>

        <button type=" submit" name="editQuestion" class="createBtn" id="editQuestionButton"><span><i
                    class="far fa-check-circle mr-2"></i></span>Confirmer la modification</button>
        <a href="/question/index" class="returnBtn"><span><i
                    class="far fa-arrow-alt-circle-left mr-2"></i></span>Retour</a>
    </form>
</div>
<script src="/app/components/js/verifCheckboxes.js"></script>