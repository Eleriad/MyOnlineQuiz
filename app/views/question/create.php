<header>
    <h1 class="text-center">Ajouter une question</h1>
</header>

<div class="container">
    <form action="" method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <p>Catégorie(s) :</p>
            <div class="d-flex">
                <?php foreach ($data['categories'] as $categories) : ?>
                <div class="form-check mr-3">
                    <input type="checkbox" class="form-check-input" name="categories[]" id="categories"
                        value="<?= $categories->id_categorie ?>">
                    <label for="categories" class="form-check-label"><?= $categories->name ?></label>
                </div>
                <?php endforeach ?>
            </div>
        </div>

        <div class="form-group">
            <label for="selectNiveaux">niveau(x) :</label>
            <select name="niveaux" id="selectNiveaux">
                <?php foreach ($data['niveaux'] as $niveaux) : ?>
                <option value="<?= $niveaux->id_niveau ?>"><?= $niveaux->level ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="form-group">
            <label for="question">Question :</label>
            <input type="text" class="form-control" name="question" id="question" placeholder="Question">
        </div>

        <div class="form-group">
            <label for="reponse">Bonne réponse :</label>
            <input type="text" class="form-control" name="reponse" id="reponse" placeholder="Bonne réponse">
        </div>

        <div class="form-group">
            <label for="facile">Réponse facile :</label>
            <input type="text" class="form-control" name="facile" id="facile" placeholder="2e réponse">
        </div>

        <div class="form-group">
            <label for="normal">Réponse normale :</label>
            <input type="text" class="form-control" name="normal" id="normal" placeholder="3e réponse">
        </div>

        <div class="form-group">
            <label for="difficile">Réponse difficile :</label>
            <input type="text" class="form-control" name="difficile" id="difficile" placeholder="4e réponse">
        </div>

        <div class="form-group">
            <label for="feedback">feedback :</label>
            <input type="text" class="form-control" name="feedback" id="feedback" placeholder="Feedback">
        </div>

        <div class="form-group">
            <label for="lien">Lien :</label>
            <input type="text" class="form-control" name="lien" id="lien" placeholder="https://">
        </div>

        <button type="submit" name="addQuestion" class="createBtn"><span><i
                    class="far fa-check-circle mr-2"></i></span>Valider</button>
        <a href="/question/index" class="returnBtn"><span><i
                    class="far fa-arrow-alt-circle-left mr-2"></i></span>Retour</a>
    </form>
</div>