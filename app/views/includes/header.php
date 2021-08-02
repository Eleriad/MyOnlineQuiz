<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    require_once 'head.php';
    $admBtn = '<a href="/admin/index" class="btn btn-sm headerBtn"><i class="fas fa-crown mr-2"></i>Page
    Administrateur</a>';
    ?>
</head>

<body>
    <header>
        <div class="row text-left">
            <div class="col col-lg-auto">
                <a href="/public/index"><img src="/app/components/img/Thot ombre 1.svg"></a>
                <a href="/public/index" class="btn btn-sm headerBtn"><i class="fas fa-home mr-2"></i>Accueil</a>
            </div>
            <div class="col col-lg-auto">
                <?php echo $_SESSION["role"] === "admin" ? $admBtn : "" ?>
                <a href="/public/categories" class="btn btn-sm headerBtn"><i class="far fa-list-alt mr-2"></i>Découvrir
                    les catégories</a>
                <a href="/quiz/index" class="btn btn-sm headerBtn"><i class="fas fa-question mr-2"></i>Quiz</a>
            </div>
            <div class="col col-lg-auto"></div>
        </div>

        <!-- <h1>C'est la page d'accueil du quiz</h1> -->
    </header>