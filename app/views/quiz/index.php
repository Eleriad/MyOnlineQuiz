<h1>C'est la page d'accueil du quiz</h1>

<a href="/admin/index" class="btn btn-info">Page Administrateur</a>

<div class="container my-4 p-3">

    <?php if (isset($data["erreur"])) : ?>
    <div class="alert alert-danger my-3" role="alert"><?= $data["erreur"]; ?></div>
    <?php endif; ?>

    <!-- TODO : Quiz aléatoire -->

    <!-- Formulaire de création du quiz -->
    <form action="/quiz/quiz" method="post">

        <!-- Select pour choix du niveau -->
        <div class="my-3">
            <label for="level-select">Choisissez un niveau :</label>
            <select name="levels" id="level-select">
                <?php foreach ($data["niveaux"] as $niveau) : ?>
                <option value="<?= $niveau->id_niveau ?>"><?= $niveau->level ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Checkboxes pour choix de la ou des catégories -->
        <div class="my-3">
            <div class="btn-group-toggle" data-toggle="buttons">
                <p>Choisissez une ou plusieurs catégories :</p>
                <?php foreach ($data["categories"] as $categorie) : ?>
                <label class="btn btn-primary" for="<?= $categorie->id_categorie ?>">
                    <input type="checkbox" id="<?= $categorie->id_categorie ?>" value="<?= $categorie->id_categorie ?>"
                        name="Categories[]"><?= $categorie->name ?>
                </label>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Nombre de questions -->
        <div class="my-3">
            <label for="questionNb">Choisissez un nombre de questions :</label>
            <select name="questionNb" id="questionNb">
                <!-- For loop to display specific number of questions -->
                <?php for ($i = 1; $i <= $data["questionMax"]; $i++) : ?>
                <?php if ($i === 1 or $i === 5 or $i === $data["questionMax"] or ($i % 10) === 0) : ?>
                <option value="<?= $i ?>"><?= $i ?></option>
                <?php endif; ?>
                <?php endfor; ?>
            </select>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-success my-3">Lancer le quiz</button>
    </form>
</div>












<!-- TODO : 

page index = accueil <=> choix
page quiz = là où tu fais le quiz
page de résultats = score ; feedback

Afficher la liste des niveaux
Afficher la liste des catégories

Afficher les 3 derniers quizz créés = table posséder, voir les 3 derniers ID ajoutés et récupérer la catégorie et/ou le niveau dans les tables correspondantes

Afficher la possibilité de quizz aléatoire -->