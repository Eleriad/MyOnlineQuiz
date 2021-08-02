<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    require_once 'head.php';
    $admBtn = '<a href="/admin/index" class="btn btn-sm headerBtn"><i class="fas fa-crown mr-2"></i>Page
    Administrateur</a>';
    ?>
    <title><?= isset($data["title"]) ? $data["title"] : "titre à voir" ?></title>
    <!-- TODO : titres à voir !!! -->
</head>

<body>
    <?php
    isset($data["title"]) ? $data["title"] = $data["title"] : $data["title"] = "titre à voir"; // TODO : ligne à supprimer une fois tous les titres mis en forme
    if ($data["title"] != "Page de connexion") :
    ?>
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
    </header>
    <?php
    endif;
    ?>