<div class="container-fluid quizIndexContainer">

    <?php if (isset($data["erreur"])) : ?>
    <div class="alert alert-danger my-3" id="divAlert" role="alert"><?= $data["erreur"]; ?></div>
    <?php endif; ?>

    <h1>Sur quoi voulez-vous être testé ?</h1>
    <!-- TODO : Quiz aléatoire
    faire un SELECT avec un nombre de questions avec un LIMIT = y et un IN = liste des catégories retenues
-->

    <form action="" method="post" id="randomQuizForm">
        <button type="submit" class="btn" name="randomQuiz" id="randomQuiz" data-toggle="tooltip" data-placement="right"
            title="Attention, en cliquant sur ce bouton, vous allez tomber sur 10 à 50 questions de tous niveaux et de toutes les catégories !">Quiz
            aléatoire</button>
    </form>

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
        <div class="my-3" id="questionNbSelect">
            <label for="questionNb" id="questionLabel">Choisissez un nombre de questions :</label>
            <select name="questionNb" id="questionNb">
                <option value="0">---</option>
            </select>
        </div>

        <!-- Submit -->
        <button type="submit" name="startQuiz" class="createBtn my-3">Lancer le quiz</button>
    </form>
</div>

<script src="/app/components/js/quizIndex.js"></script>

<script>
$(document).ready(function() {
    $('#randomQuiz').tooltip()
});
</script>