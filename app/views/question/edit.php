<div class="container">
    <h1 class="text-center">Modifier une question</h1>

    <?php
    if (isset($_GET['Message'])) {
        if ($_GET['Message'] = "errCat") { ?>
            <div class="alert alert-danger my-3" role="alert">
                Aucune catégorie n'a été sélectionnée !
            </div>
    <?php
        }
    }
    ?>

    <form action="" method="post">
        <div class="mb-3">
            <p>Catégorie(s) :</p>
            <div class="d-flex">
                <?php foreach ($data['categories'] as $categories) : ?>
                    <div class="form-check mr-3">
                        <input type="checkbox" class="form-check-input" name="categories[]" id="categories" value="<?= $categories->id_categorie ?>" <?php foreach ($data["categorieNames"] as $names) {
                                                                                                                                                            if ($categories->name === $names["name"]) echo "checked";
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
                    <option value="<?= $niveaux->id_niveau ?>" <?php if ($niveaux->level === $data["question"]->level) echo 'selected="selected"'; ?>><?= $niveaux->level ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <label for="question">Question :</label>
            <input type="text" class="form-control" name="question" id="question" value="<?= $data["question"]->question ?>">
        </div>
        <div class="form-group">
            <label for="reponse">Bonne réponse :</label>
            <input type="text" class="form-control" name="reponse" id="reponse" value="<?= $data["question"]->reponse ?>">
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
            <input type="text" class="form-control" name="difficile" id="difficile" value="<?= $data["question"]->difficile ?>">
        </div>
        <div class="form-group">
            <label for="feedback">feedback :</label>
            <input type="text" class="form-control" name="feedback" id="feedback" value="<?= $data["question"]->feedback ?>">
        </div>

        <input type="submit" name="editQuestion" class="btn btn-success" value="Modifier"></input>
        <a href="/question/index" class="btn btn-dark">Retour</a>
    </form>

</div>