<h1 class="text-center">Voici la liste des catégories</h1>

<div class="box-timeline">
    <div class="ligne">
        <?php
        $nb = 1;
        foreach ($data["categories"] as $categorie) : ?>
        <div class="rond r<?= $nb ?>" data-anim="<?= $nb ?>"><img
                src="/app/components/img/categorie_picture/<?= $categorie->categorie_picture ?>" width="50px"
                height="50px"></div>

        <div class="box b<?= $nb ?>" data-anim="<?= $nb ?>">
            <h4><?= $categorie->name ?></h4>
            <p><?= $categorie->description ?></p>
            <span><i class="fas fa-info-circle" id="tooltip<?= $nb ?>" data-toggle="tooltip" data-placement="bottom"
                    title="<?= $categorie->infos ?>"></i></span>
        </div>

        <?php
            $nb++;
        endforeach; ?>
    </div>
</div>

<script src="/app/components/js/publicCategories.js"></script>