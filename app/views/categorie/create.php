    <header>
        <h1>Ajouter une catégorie</h1>
    </header>

    <div class="adminContainer mt-4">

        <div id="msgDiv" class="sessionMsgDiv"><?php $this->displayMsg(); ?></div>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="newCategory">Nom de la catégorie :
                    <input type="text" class="form-control" name="newCategory" id="newCategory">
                </label>
            </div>

            <div class="form-group d-flex flex-column">
                <label for="description">Description de la catégorie :</label>
                <textarea name="description" cols="30" rows="10"></textarea>
            </div>

            <div class="form-group">
                <label for="categoriePicture"></label>
                <input type="file" name="categoriePicture">
            </div>

            <button type="submit" name="addCategory" class="createBtn"><span><i
                        class="far fa-check-circle mr-2"></i></span>Valider</button>
            <a href="/categorie/index" class="returnBtn"><span><i
                        class="far fa-arrow-alt-circle-left mr-2"></i></span>Retour</a>
        </form>
    </div>