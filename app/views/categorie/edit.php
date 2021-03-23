<div class="container py-4 text-center">

    <h1>Modifier une catégorie</h1>

    <form action="" id="form4" method="post">
        <div class="form-group">
            <label>Nom de la catégorie : <input type="text" name="categorieName" class="form-control"
                    value="<?= $data->name ?>"></label>

            <div class="text-center mt-3">
                <button type="submit" name="updateCategorie" class="createBtn"><span><i
                            class="far fa-check-circle mr-2"></i></span>Confirmer la modification</button>
                <a href="/categorie/index" class="returnBtn"><span><i
                            class="far fa-arrow-alt-circle-left mr-2"></i></span>Retour</a>
            </div>
        </div>
    </form>
</div>