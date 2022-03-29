<?php $total = $data["totalViews"][0][0]  ?>

<div class="container m-5 p-5">
    <h5>Statistiques</h5>

    <p> Voici quelques informations relatives au site internet : </p>
    <p> Au total, le nombre de vues sur le site s'élève à <?= $total ?>. </p>

    <?php foreach ($data["allPagesViews"] as $page) : ?>
    <p> La page "<?= $page[1] ?>" a été vue <?= $page[2] ?> fois. </p>
    <?php endforeach; ?>

    <div class="btnDiv">
        <a href="/admin/index" class="returnBtn"><span><i class="far fa-arrow-alt-circle-left mr-2"></i></span>
            Retour</a>
    </div>
</div>