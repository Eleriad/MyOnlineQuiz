<div class="container py-4 text-center">
    <form action="" id="form4" method="post">
        <div class="form-group">
            <label>Nom du niveau : <input type="text" name="levelName" class="form-control" value="<?= $data->level ?>"></label>

            <div class="text-center mt-3">
                <input type="submit" name="updateLevel" value="Modifier ce niveau" class="btn btn-success">
                <a href="/niveau/index" class="btn btn-dark">Retour</a>
            </div>
        </div>
    </form>
</div>