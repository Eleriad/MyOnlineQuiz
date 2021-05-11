<?php
$currentQuestion = $_SESSION["currentQuestion"];

foreach ($data["questions"] as $question) :
    $currentQuestion++;

    $choix = array_slice($question, 2);
    $shuffle = shuffle($choix);
?>
<div class="quizDiv">
    <div class="questionDiv_<?= $currentQuestion ?>">

        <!-- TODO : mettre en forme les données en haut du quiz + l'affichage des choix de réponse -->
        <div>
            <p>mettre ici le titre et le niveau de quiz + question x sur y</p>
        </div>
        <div id="<?= $currentQuestion ?>" class="questionTitle">
            <?= $question["question"] ?>
            <hr>
        </div>
        <div class="answersDiv">
            <div class="answer">
                <input type="radio" id="answer1_<?= $currentQuestion ?>" name="radio_<?= $currentQuestion ?>"
                    value="<?= $choix[0] ?>">
                <label for="answer1_<?= $currentQuestion ?>"><?= $choix[0] ?></label>
            </div>
            <div class="answer">
                <input type="radio" id="answer2_<?= $currentQuestion ?>" name="radio_<?= $currentQuestion ?>"
                    value="<?= $choix[1] ?>">
                <label for="answer2_<?= $currentQuestion ?>"><?= $choix[1] ?></label>
            </div>
            <div class="answer">
                <input type="radio" id="answer3_<?= $currentQuestion ?>" name="radio_<?= $currentQuestion ?>"
                    value="<?= $choix[2] ?>">
                <label for="answer3_<?= $currentQuestion ?>"><?= $choix[2] ?></label>
            </div>
            <div class="answer">
                <input type="radio" id="answer4_<?= $currentQuestion ?>" name="radio_<?= $currentQuestion ?>"
                    value="<?= $choix[3] ?>">
                <label for="answer4_<?= $currentQuestion ?>"><?= $choix[3] ?></label>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<script>
$(document).ready(function() {
    $(".questionDiv_2").hide();
});
</script>