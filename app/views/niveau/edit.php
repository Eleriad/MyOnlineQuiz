   <header>
       <h1>Modifier un niveau</h1>
   </header>

   <form action="" id="form4" method="post">
       <div class="form-group">
           <label>Nom du niveau : <input type="text" name="levelName" class="form-control"
                   value="<?= $data->level ?>"></label>

           <div class="text-center mt-3">
               <button type="submit" name="updateLevel" class="createBtn"><span><i
                           class="far fa-check-circle mr-2"></i></span>Confirmer la modification</button>
               <a href="/niveau/index" class="returnBtn"><span><i
                           class="far fa-arrow-alt-circle-left mr-2"></i></span>Retour</a>
           </div>
       </div>
   </form>