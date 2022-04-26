<div class="container-fluid quizContainer">
    <?php
    $currentQuestion = $_SESSION["currentQuestion"];
    $categorieName = "";

    foreach ($data["categorieName"] as $name) {
        $finalName = implode($name);
        $categorieName .= $finalName . ", ";
    }

    $categorieName = "" ? $categorieName = "" : $categorieName = rtrim($categorieName, ", ");
    $questionInt = 1;
    $correctAnswers = [];
    $quizQuestions = [];

    foreach ($data["questions"] as $question) :
        $correctAnswers[$currentQuestion] = $question["reponse"];
        $_SESSION["correctAnswers"] = $correctAnswers; // gathering all correct answers

        $currentQuestion++;
        $choix = array_slice($question, 2);
        $shuffle = shuffle($choix);
        array_push($quizQuestions, $question);
    ?>

    <!-- Input hidden pour récupérer en JS le nombre maximum de questions -->
    <input type="hidden" name="maxQuestion" value="<?= $_SESSION["questionNb"] ?>">
    <form action="/quiz/results" method="POST">
        <div class="quizDiv">

            <!-- Input hidden pour récupérer en AJAX le numéro de la question en cours -->
            <input type="hidden" name="currentQuestion" value="<?= $currentQuestion ?>">

            <!-- Input hidden pour récupérer la liste des réponses de l'utilisateur -->
            <input type="hidden" id="userAnswers" name="userAnswers[]">


            <div id="questionDiv<?= $currentQuestion ?>" class="cont">

                <!-- TODO : mettre en forme les données en haut du quiz + l'affichage des choix de réponse -->
                <div class="quizTitle text-center">
                    <p>Quizz <i><?= $categorieName ?></i>
                        <?= isset($data["levelName"]["level"]) ? '- niveau ' . $data["levelName"]["level"] : "aléatoire" ?><br>
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
                            <input type="radio" id="answer1_<?= $currentQuestion ?>" name="radio<?= $currentQuestion ?>"
                                value="<?= $choix[0] ?>" class="answer1 mr-2">
                            <label for="answer1_<?= $currentQuestion ?>"><?= $choix[0] ?></label>
                        </div>
                        <div class="answer">
                            <input type="radio" id="answer2_<?= $currentQuestion ?>" name="radio<?= $currentQuestion ?>"
                                value="<?= $choix[1] ?>" class="answer2 mr-2">
                            <label for="answer2_<?= $currentQuestion ?>"><?= $choix[1] ?></label>
                        </div>
                    </div>
                    <div class="d-inline">
                        <div class="answer">
                            <input type="radio" id="answer3_<?= $currentQuestion ?>" name="radio<?= $currentQuestion ?>"
                                value="<?= $choix[2] ?>" class="answer3 mr-2">
                            <label for="answer3_<?= $currentQuestion ?>"><?= $choix[2] ?></label>
                        </div>
                        <div class="answer">
                            <input type="radio" id="answer4_<?= $currentQuestion ?>" name="radio<?= $currentQuestion ?>"
                                value="<?= $choix[3] ?>" class="answer4 mr-2">
                            <label for="answer4_<?= $currentQuestion ?>"><?= $choix[3] ?></label>
                        </div>
                    </div>
                </div>
                <button id="<?php echo $questionInt == $_SESSION["questionNb"] ? "endQuizBtn" : "$currentQuestion"; ?>"
                    class="mt-5 <?php echo $questionInt == $_SESSION["questionNb"] ? "endQuizBtn" : "btnNext"; ?>"><?php echo $questionInt == $_SESSION["questionNb"] ? "Fin du quizz" : "Question suivante"; ?></button>
            </div>
        </div>
    </form>

    <?php
        $questionInt++;
    endforeach;
    $_SESSION["quizQuestions"] = $quizQuestions;
    ?>
</div>

<script src="<?= APP_COMPONENT . "js/quizRun.js" ?>"></script>