<?php
var_dump($data);
$this->displayMsg();
?>

<header>
    <h1>Modifier une catégorie</h1>
</header>

<div class="container text-center mt-4">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nom de la catégorie :
                <input type="text" name="categorieName" class="form-control" value="<?= $data["catégorie"]->name ?>">
            </label>

            <div class="form-group d-flex flex-column">
                <label for="description">Description de la catégorie :</label>
                <textarea name="description" cols="30" rows="10"><?= $data["catégorie"]->description ?></textarea>
            </div>

            <div class="form-group d-flex flex-column">
                <label for="infos">Informations pour le Tooltip :</label>
                <textarea name="infos" cols="30" rows="10"><?= $data["catégorie"]->infos ?></textarea>
            </div>

            <div>
                <p> Vous souhaitez modifier l'image de cette catégorie ? <a class="btn brn-small btn-info "
                        id="changePicture">Cliquez ici !</a>
                </p>
            </div>

            <div class="form-group" id="pictureDiv">
                <label for="editCategoriePicture"></label>
                <input type="file" id="editCategoriePicture" name="editCategoriePicture">
            </div>

            <div class="text-center mt-3">
                <button type="submit" name="updateCategorie" class="createBtn"><span><i
                            class="far fa-check-circle mr-2"></i></span>Confirmer la modification</button>
                <a href="/categorie/index" class="returnBtn"><span><i
                            class="far fa-arrow-alt-circle-left mr-2"></i></span>Retour</a>
            </div>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    $('#pictureDiv').hide();
    $("#categoriePicture").prop('disabled', true);

    $(document).on("click", "#changePicture", function(e) {
        $("#pictureDiv").toggle("hide");
        $("#categoriePicture").is(':disabled') == true ? $("#categoriePicture").prop('disabled',
            false) : $("#categoriePicture").prop('disabled', true);
    });
});
</script>