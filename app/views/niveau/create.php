<div class="adminContainer">
    <h1>Ajouter un niveau</h1>

    <div class="adminContainer mt-4">

        <div id="msgDiv" class="sessionMsgDiv"><?php $this->displayMsg(); ?></div>
        <form action="" method="post">
            <div class="form-group">
                <label for="newLevel">Nom du niveau :
                    <input type="text" class="form-control" name="newLevel" id="newLevel">
                </label>
            </div>

            <input type="submit" name="addLevel" class="createBtn" value="Créer"></input>
            <a href="/niveau/index" class="returnBtn"><span><i
                        class="far fa-arrow-alt-circle-left mr-2"></i></span>Retour</a>
        </form>
    </div>
</div>