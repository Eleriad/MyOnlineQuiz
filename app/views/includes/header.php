<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    require_once 'head.php';
    $admBtn = '<a href="/admin/index" class="btn btn-sm headerBtn"><i class="fas fa-crown mr-2"></i>Page
    Administrateur</a>';
    ?>
    <title><?= isset($data["title"]) ? $data["title"] : "titre à voir" ?></title>
</head>

<body>
    <?php
    isset($data["title"]) ? $data["title"] = $data["title"] : $data["title"] = "titre à voir";
    if ($data["title"] != "Page de connexion" && $data["title"] != "Page d'inscription") :
    ?>
    <header>
        <div class="row text-left">
            <div class="col col-lg-auto">
                <a href="/public/index"><img src="/app/components/img/Thot ombre 1.svg"></a>
                <a href="/public/index" class="btn btn-sm headerBtn"><i class="fas fa-home mr-2"></i>Accueil</a>
            </div>
            <div class="col col-lg-auto">
                <?php echo isset($_SESSION["role"]) && $_SESSION["role"] === "admin" ? $admBtn : ""
                    ?>
                <a href="/public/categories" class="btn btn-sm headerBtn"><i class="far fa-list-alt mr-2"></i>Découvrir
                    les catégories</a>
                <a href="/quiz/index" class="btn btn-sm headerBtn"><i class="fas fa-question mr-2"></i>Quiz</a>
            </div>
            <div class="col text-right">
                <a href="/home/disconnection" class="btn btn-sm headerBtnOut"><i class="fas fa-sign-out-alt mr-2"></i>Se
                    déconnecter</a>
            </div>
        </div>
    </header>
    <?php
    endif;
    ?>