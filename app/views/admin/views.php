<?php $total = $data["totalViews"][0]->total_views  ?>

<p> Au total, le nombre de vues sur le site s'élève à <?= $total ?> ! </p>

<?php foreach ($data["allPagesViews"] as $page) : ?>
<p> La page "<?= $page->name ?>" a été vue <?= $page->total_views ?> fois ! </p>
<?php endforeach; ?>