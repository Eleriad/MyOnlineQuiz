<div class="container-fluid flex-column">
    <h1>Résultats du quiz</h1>

    <?php
    $maxQuestions = $_SESSION["questionNb"];
    $resultDiff = array_diff($data["usersAnswersArray"], $_SESSION["correctAnswers"]);
    $score = $maxQuestions - count($resultDiff);

    $third = $this->getPercentage($maxQuestions, 33);
    $twoThird = $this->getPercentage($maxQuestions, 66);
    ?>

    <div class="resultDiv">
        <?php
        switch ($score) {
            case $score < $third:
                echo "Encore un effort ! Votre score est de $score sur $maxQuestions";
                break;
            case $score > $third and $score < $twoThird:
                echo "Vous y êtes presque ! Votre score est de $score sur $maxQuestions";
                break;
            case $score > $twoThird:
                echo "Bravo ! Votre score est de $score sur $maxQuestions";
                break;
        }
        ?>

    </div>
    <?php

    $categorieName = "";
    $quizQuestions = [];
    $currentQuestion = $_SESSION["currentQuestion"];
    $userAnswers = $data["usersAnswersArray"];
    $correctAnswers = $_SESSION["correctAnswers"];

    // Retrieving categoriesNames
    foreach ($data["categorieName"] as $test) {
        $test2 = implode($test);
        $categorieName .= $test2 . ", ";
    }

    $categorieName = rtrim($categorieName, ", ");

    foreach ($_SESSION["quizQuestions"] as $question) :

        $choix = array_slice($question, 2);
        $shuffle = shuffle($choix);

        //     for ($i = 0; $i < count($choix); $i++) {
        //         switch ($choix[$i]) {
        //             case $choix[$i] === $correctAnswers["$currentQuestion"] and $choix[$i] != $userAnswers["$currentQuestion"]:
        //                 $test = "correct";
        //                 break;
        //             case $choix[$i] === $userAnswers["$currentQuestion"] and $choix[$i] != $correctAnswers["$currentQuestion"]:
        //                 $test = "incorrect";
        //                 break;
        //             case $choix[$i] === $correctAnswers["$currentQuestion"] and $choix[$i] === $userAnswers["$currentQuestion"]:
        //                 $test = "correct";
        //                 break;
        //             default:
        //                 $test = "";
        //         }
        //     }
        array_push($quizQuestions, $question);
        $currentQuestion++;
    ?>

    <div class="quizDiv py-4">

        <div id="questionDiv" class="cont">

            <div class="quizTitle text-center">
                <p>Quizz <i><?= $categorieName ?></i>, niveau <i><?= $data["levelName"]["level"] ?></i><br>
                </p>
            </div>
            <div class="questionTitle">
                <?= $question["question"] ?>
                <hr class="divider">
            </div>
            <div class="answersDiv">
                <div class="d-inline">
                    <div class="answer">
                        <input type="radio" id="answer1_<?= $currentQuestion ?>" name="radio<?= $currentQuestion ?>"
                            value="<?= $choix[0] ?>" class="answer1 mr-2" disabled>
                        <label for="answer1_<?= $currentQuestion ?>"><?= $choix[0] ?></label>
                    </div>
                    <div class="answer">
                        <input type="radio" id="answer2_<?= $currentQuestion ?>" name="radio<?= $currentQuestion ?>"
                            value="<?= $choix[1] ?>" class="answer2 mr-2" disabled>
                        <label for="answer2_<?= $currentQuestion ?>"><?= $choix[1] ?></label>
                    </div>
                </div>
                <div class="d-inline">
                    <div class="answer">
                        <input type="radio" id="answer3_<?= $currentQuestion ?>" name="radio<?= $currentQuestion ?>"
                            value="<?= $choix[2] ?>" class="answer3 mr-2" disabled>
                        <label for="answer3_<?= $currentQuestion ?>"><?= $choix[2] ?></label>
                    </div>
                    <div class="answer">
                        <input type="radio" id="answer4_<?= $currentQuestion ?>" name="radio<?= $currentQuestion ?>"
                            value="<?= $choix[3] ?>" class="answer4 mr-2" disabled>
                        <label for="answer4_<?= $currentQuestion ?>"><?= $choix[3] ?></label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php endforeach; ?>

</div>