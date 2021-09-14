<div class="container-fluid flex-column">
    <h1>Résultats du quiz</h1>

    <?php
    $maxQuestions = $_SESSION["questionNb"];
    $resultDiff = array_diff_assoc($data["usersAnswersArray"], $_SESSION["correctAnswers"]);
    $score = $maxQuestions - count($resultDiff);
    ?>

    <!-- Affichage du résultat -->
    <div class="resultDiv">
        <?php $this->displayResult($score, $maxQuestions); ?>
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

        $result = $this->checkAnswers($choix, $userAnswers["$currentQuestion"], $correctAnswers["$currentQuestion"]);

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
            </div>
            <hr class="divider">
            <div class="answersDiv">
                <div class="d-inline">
                    <div class="answerR <?= $result[0] ?>">
                        <input type="radio" id="answer1_<?= $currentQuestion ?>" name="radio<?= $currentQuestion ?>"
                            value="<?= $choix[0] ?>" class="answer1 mr-2" disabled>
                        <label for="answer1_<?= $currentQuestion ?>"><?= $choix[0] ?></label>
                    </div>
                    <div class="answerR <?= $result[1] ?>">
                        <input type="radio" id="answer2_<?= $currentQuestion ?>" name="radio<?= $currentQuestion ?>"
                            value="<?= $choix[1] ?>" class="answer2 mr-2" disabled>
                        <label for="answer2_<?= $currentQuestion ?>"><?= $choix[1] ?></label>
                    </div>
                </div>
                <div class="d-inline">
                    <div class="answerR <?= $result[2] ?>">
                        <input type="radio" id="answer3_<?= $currentQuestion ?>" name="radio<?= $currentQuestion ?>"
                            value="<?= $choix[2] ?>" class="answer3 mr-2" disabled>
                        <label for="answer3_<?= $currentQuestion ?>"><?= $choix[2] ?></label>
                    </div>
                    <div class="answerR <?= $result[3] ?>">
                        <input type="radio" id="answer4_<?= $currentQuestion ?>" name="radio<?= $currentQuestion ?>"
                            value="<?= $choix[3] ?>" class="answer4 mr-2" disabled>
                        <label for="answer4_<?= $currentQuestion ?>"><?= $choix[3] ?></label>
                    </div>
                </div>
            </div>
            <div class="divFeedback">
                <p><?= $question["feedback"] ?></p>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <div class="buttons pb-5">
        <a href="/quiz/index" class="btn btn-sm endQuizBtn">Choisir un autre quiz</a>
        <a href="quiz/quiz" class="btn btn-sm endQuizBtn" id="tooltipQuiz" data-toggle="tooltip" data-placement="top"
            title="Ce quiz aura la/les même(s) thématique(s), le même niveau et le même nombre de questions">Refaire le
            même quiz</a>
    </div>
</div>