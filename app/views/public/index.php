<div class="bodyContainer flex-column p-4">
    <div class="pt-4 pb-2">
        <h4>Présentation</h4>
        <div>
            <p>J'ai imaginé ce quiz lorsque j'étais étudiant. Passioné de quiz et curieux de tout, cette méthode me
                permettait de réviser tout en m'amusant. Originellement, j'avais créé des "cartes" de questions sur le
                modèle d'un célèbre jeu de quiz où il faut compléter un célèbre fromage français. Durant mes années
                universitaires, j'ai laissé un peu de côté ce jeu, m'inmpliquant dans mes études jusqu'à l'obtentio nde
                mon
                doctorat. </p>
            <p>
                Désormais titulaire à la fois d'un doctorat en égyptologie et d'un diplôme de Concepteur Développeur
                d'Applications, j'ai pris plaisir à mettre à jour ce jeu, devenu quiz. Il se veut être une méthode
                ludique
                de découverte de l'Égypte ancienne. Finalisé en 2021, il est possible que certaines coquilles se soient
                glissées parmi les questions et que je n'ai pas eu le temps de mettre à jour les connaissances en
                fonction
                des dernières découvertes... Je m'en excuse par avance ! Surtout, si vous voyez une erreur, n'hésitez
                pas à
                m'envoyer un mail à <a>cette adresse</a> afin que je puisse la corriger au plus vite !
            </p>
            <p>
                J'espère que vous apprécierez ce jeu et irez aussi loin que possible (le mode "Pharaonique" est là pour
                les plus téméraires !). Puissiez-vous prendre autant de plaisir à y jouer que j'en ai eu à a concevoir !
                Bon jeu à toutes et à tous !
            </p>
        </div>
    </div>

    <div class="flex-column py-4">
        <h4 class="mb-4">Derniers quiz</h4>
        <p>De nouvelles questions sont régulièrement ajoutées dans la base et de nouvelles thématiques créées : voici
            les dernières en date !</p>

        <div class="cards d-flex flex-row pb-4 justify-content-center">

            <?php foreach ($data["thématiques"] as $thematique) : ?>
            <div class="col col-lg-3 text-center card">
                <img class="card-img-top"
                    src="/app/components/img/categorie_picture/<?= $thematique->categorie_picture ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $thematique->name ?></h5>
                    <p class="card-text"><?= $thematique->description ?></p>
                    <a href="#" class="btn">Tester ce quiz</a>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>