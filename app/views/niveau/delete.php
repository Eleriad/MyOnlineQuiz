<div class="container py-4 text-center">
    <form action="" id="form4" method="post">
        <div class="form-group">
            <label>Nom de la catégorie : <input type="text" class="form-control" value="<?= $data->name ?>" disabled></label>

            <div class="text-center mt-3">
                <input type="submit" name="deleteCategorie" value="Supprimer cette catégorie" class="btn btn-success">
                <a href="/categorie/index" class="btn btn-dark">Retour</a>
            </div>
        </div>
    </form>
</div>