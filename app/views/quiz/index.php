<header>
    <h1>C'est la page d'accueil du quiz</h1>
</header>

<a href="/admin/index" class="returnBtn"><i class="fas fa-crown mr-2"></i>Page Administrateur</a>
<a href="/public/categories" class="returnBtn"><i class="far fa-list-alt mr-2"></i>Découvrir les catégories</a>

<div class="container my-4 p-3">

    <?php if (isset($data["erreur"])) : ?>
    <div class="alert alert-danger my-3" id="divAlert" role="alert"><?= $data["erreur"]; ?></div>
    <?php endif; ?>

    <!-- TODO : Quiz aléatoire -->

    <!-- Formulaire de création du quiz -->
    <form action="" method="post" id="quizForm">

        <!-- Select pour choix du niveau -->
        <div class="my-3" id="levelDiv">
            <label for="level-select">Veuillez choisir un niveau de difficulté :</label>
            <select name="level" id="level-select" class="onChangeLevel">
                <option value="0">-------</option>
                <?php foreach ($data["niveaux"] as $niveau) : ?>
                <option value="<?= $niveau->id_niveau ?>"><?= $niveau->level ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Nombre de questions -->
        <div class="my-3">
            <label for="questionNb" id="questionLabel">Choisissez un nombre de questions :</label>
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
        <button type="submit" class="createBtn my-3">Lancer le quiz</button>
    </form>
</div>

<script src="/app/components/js/quizIndex.js"></script>

<!-- TODO : 
page index = accueil <=> choix
page quiz = là où tu fais le quiz
page de résultats = score ; feedback
Afficher les 3 derniers quizz créés = table posséder, voir les 3 derniers ID ajoutés et récupérer la catégorie et/ou le niveau dans les tables correspondantes
Afficher la possibilité de quizz aléatoire -->