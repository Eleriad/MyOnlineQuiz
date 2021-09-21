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
        <div class="my-3" id="questionNbSelect">
            <label for="questionNb" id="questionLabel">Choisissez un nombre de questions :</label>
            <select name="questionNb" id="questionNb">
                <option value="0">---</option>
            </select>
        </div>

        <!-- Submit -->
        <button type="submit" class="createBtn my-3">Lancer le quiz</button>
    </form>
</div>

<script src="/app/components/js/quizIndex.js"></script>