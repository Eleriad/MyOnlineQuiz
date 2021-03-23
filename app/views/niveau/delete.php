<div class="container py-4 text-center">

    <h1>Supprimer un niveau</h1>

    <form action="" id="form4" method="post">
        <div class="form-group">
            <label>Nom du niveau : <input type="text" class="form-control" value="<?= $data->level ?>" disabled></label>

            <div class="text-center mt-3">
                <button type="submit" name="deleteLevel" class="createBtn"><span><i
                            class="far fa-check-circle mr-2"></i></span>Confirmer la suppression</button>
                <a href="/niveau/index" class="returnBtn"><span><i
                            class="far fa-arrow-alt-circle-left mr-2"></i></span>Retour</a>
            </div>
        </div>
    </form>
</div>