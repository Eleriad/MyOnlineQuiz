# MyOnlineQuiz

PHP Quiz with MVC and POO

Idée : 4 propositions à chaque fois :

- pour une question facile, 2 propositions à écarter facilement ;
- Pour une question normale, 1 proposition à écarter facilement,
- Pour une question difficile, tous les propositions peuvent être les bonnes
- Pour une question divin, les réponses sont très difficiles (dates à 1 année près, auteur inconnu, ...)

QuestionVF : si ce qu'on retourne ne contient que 2 éléments, alors on a affaire à une question VRAI ou FAUX ;-)

TODO : ajouter des messages à chaque vérification (revoir toutes les pages !)
Faire le phpdoc pour toutes les functions :-(

    - Faire les vérification des niveaux et catégories en JS et PHP  :

        - si l'input est vide (JS & PHP) ;

        - si la valeur existe déjà à la création ou à la modification (voir pour l'orthographe avec ou sans "s" par exemple ; faire un try-catch pour afficher l'erreur en cas de doublon (Sql avec unique)) - en PHP uniquement;

    - mettre des required pour tous les input une fois les vérif en JS et PHP effectuées !

Pour la version suivante :

- Pour les niveaux, prévoir une page pour l'administrateur afin de donner un poids à chaque niveau de difficulté ;
  l'administrateur peut ajouter pleins de niveaux et les classer les uns par rapports aux autres ;
  ça créé une nouvelle colonne de "poids" ou ça ré-arrange les ID des niveaux.
  Cf. idées de "poids" dans Moodle ;-)

- Sur la page d'index de quiz : prévoir un bouton "sélectionner toutes les catégories" ;

<!-- <label class="btn btn-primary">
                <input type="checkbox"><?= //$categorie->name ?>
                </label> -->
