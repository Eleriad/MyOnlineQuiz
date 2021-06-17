<?php
$currentQuestion = $_SESSION["currentQuestion"];
$categorieName = "";

// var_dump($data);
// var_dump($_SESSION);

foreach ($data["categorieName"] as $test) {
    $test2 = implode($test);
    $categorieName .= $test2 . ", ";
}

$categorieName = rtrim($categorieName, ", ");
$questionInt = 1;

$correctAnswers = [];
foreach ($data["questions"] as $question) :
    $currentQuestion++;
    $correctAnswers[$currentQuestion] = $question["reponse"];


    $choix = array_slice($question, 2);
    $shuffle = shuffle($choix);
?>

<!-- Input hidden pour récupérer en JS le nombre maximum de questions -->
<input type="hidden" name="maxQuestion" value="<?= $_SESSION["questionNb"] ?>">

<form action="" method="POST">
    <div class="quizDiv">

        <!-- Input hidde, pour récupérer en AJAX le numéro dela question en cours -->
        <input type="hidden" name="currentQuestion" value="<?= $currentQuestion ?>">

        <div class="questionDiv_<?= $currentQuestion ?>">

            <!-- TODO : mettre en forme les données en haut du quiz + l'affichage des choix de réponse -->
            <div class="quizTitle text-center">
                <p>Quizz <i><?= $categorieName ?></i>, niveau <i><?= $data["levelName"]["level"] ?></i>
                    <br>
                <p class="subTitle">
                    <?php
                        echo $questionInt == $_SESSION["questionNb"] ? "Dernière question" : 'Question <strong>' . $questionInt . '</strong> sur <strong>' . $_SESSION["questionNb"] . '</strong>';
                        ?>
                </p>
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
            <button id="confirmBtn" class="mt-5 btnNext disabled"><?php
                                                                        echo $questionInt == $_SESSION["questionNb"] ? "Fin du quizz" : "Valider";
                                                                        ?></button>
        </div>
    </div>
</form>
<?php
    $questionInt++;
endforeach;
// var_dump($correctAnswers);
?>

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


    // TODO : on cache ici les questions qui ne sont pas celle en cours 
    // $('.questionDiv_1').parent().css('display', 'none');
    // $('.questionDiv_2').parent().css('display', 'none');
    // $('.questionDiv_3').parent().css('display', 'none');
    // $('.questionDiv_4').parent().css('display', 'none');
    // $('.questionDiv_5').parent().css('display', 'none');


    $('#confirmBtn').click(function(e) {
        e.preventDefault();

        console.log("bouton cliqué");
    })

    let maxQuestion = $('input[name="maxQuestion"]').val(); // récupération du nombre maximal de questions


    // TODO : voir comment récupérer toutes les div sauf celle de la question en cours
    // let questionNb = 1;
    // displayCurrentQuestion(questionNb);

    // function displayCurrentQuestion(nb) {
    // $('div[class^="questionDiv"]').siblings().parent().css('display', 'none');
    // $('.questionDiv_' + nb).show();

    // }


    // TODO : on click sur le bouton : cela permet d'enregistrer la réponse de l'utilisateur + cache la question précédente et affiche la question suivante 
    // (sauf si dernière question, dans ce cas, on renvoie sur la page de feedback)
});
</script>