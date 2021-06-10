<?php
$currentQuestion = $_SESSION["currentQuestion"];
$categorieName = "";

foreach ($data["categorieName"] as $test) {
    $test2 = implode($test);
    $categorieName .= $test2 . ", ";
}

$categorieName = rtrim($categorieName, ", ");

foreach ($data["questions"] as $question) :
    $currentQuestion++;

    $choix = array_slice($question, 2);
    $shuffle = shuffle($choix);
?>
<div class="quizDiv">
    <div class="questionDiv_<?= $currentQuestion ?>">

        <!-- TODO : mettre en forme les données en haut du quiz + l'affichage des choix de réponse -->
        <div class="quizTitle">
            <p>Quizz <i><?= $categorieName ?></i>, niveau <i><?= $data["levelName"]["level"] ?></i>
                - Question x sur y
            </p>
        </div>
        <div id="<?= $currentQuestion ?>" class="questionTitle">
            <?= $question["question"] ?>
            <hr class="divider">
        </div>
        <div class="answersDiv">
            <div class="d-inline">
                <div class="answer">
                    <input type="radio" id="answer1_<?= $currentQuestion ?>" name="radio_<?= $currentQuestion ?>"
                        value="<?= $choix[0] ?>" class="answer1 mr-2">
                    <label for="answer1_<?= $currentQuestion ?>"><?= $choix[0] ?></label>
                </div>
                <div class="answer">
                    <input type="radio" id="answer2_<?= $currentQuestion ?>" name="radio_<?= $currentQuestion ?>"
                        value="<?= $choix[1] ?>" class="answer2 mr-2">
                    <label for="answer2_<?= $currentQuestion ?>"><?= $choix[1] ?></label>
                </div>
            </div>
            <div class="d-inline">
                <div class="answer">
                    <input type="radio" id="answer3_<?= $currentQuestion ?>" name="radio_<?= $currentQuestion ?>"
                        value="<?= $choix[2] ?>" class="answer3 mr-2">
                    <label for="answer3_<?= $currentQuestion ?>"><?= $choix[2] ?></label>
                </div>
                <div class="answer">
                    <input type="radio" id="answer4_<?= $currentQuestion ?>" name="radio_<?= $currentQuestion ?>"
                        value="<?= $choix[3] ?>" class="answer4 mr-2">
                    <label for="answer4_<?= $currentQuestion ?>"><?= $choix[3] ?></label>
                </div>
            </div>
        </div>
        <button class="mt-5 btnNext disabled">Valider</button>
    </div>
</div>
<?php endforeach; ?>

<script>
$(document).ready(function() {

    $('input:radio').click(function() {

        if ($(this).is(':checked')) {
            self = $(this).parent();

            selectedAnswer = $(".answersDiv").find("div.selectedAnswer");
            selectedAnswer.removeClass('selectedAnswer');
            $(".btnNext").removeClass("disabled");

            self.toggleClass('selectedAnswer');
        }
    });
});
</script>