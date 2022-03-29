# MyOnlineQuiz

PHP Quiz with MVC and POO

TODO :

- Faire le phpdoc pour toutes les functions :-(
- Faire la partie "mot de passe oublié" (Sokou)
- vérifier qu'il ait bien des messages à chaque création / modification / suppression
- vérifier qu'il ait bien des titres à chaque page
- vérifier à l'aide d'une requête SQL si une catégorie a déjà le même nom
- vérifier à l'aide d'une requête SQL si un niveau a déjà le même nom
- vérifier à l'aide d'une requête SQL si une image a déjà le même nom

      - Faire les vérification des niveaux et catégories en JS et PHP  : (Sokou)

          - si l'input est vide (JS & PHP) ;

          - si la valeur existe déjà à la création ou à la modification (voir pour l'orthographe avec ou sans "s" par exemple ; faire un try-catch pour afficher l'erreur en cas de doublon (Sql avec unique)) - en PHP uniquement;

      - mettre des required pour tous les input une fois les vérif en JS et PHP effectuées !

- Vérifier que tous les boutons renvoient bien au bon endroit (notamment page public/index.php)

######################################

Pour la version suivante (V2) :

- PREVOIR des photos pour les questions (si il y en a, on lui prévoit une place où s'afficher);
- PREVOIR une place pour une photo dans les feedbacks ainsi qu'un lien pour en savoir plus !

- PREVOIR un bouton qui permette de nettoyer la base de données photos en php (vérification des images utilisées sur le site et comparaison avec la BDD afin de voir les images non utilisées et les supprimer le cas échéant).

- PREVOIR une case 'lien" pour chaque question avec, si le lien existe, un pett "en savoir plus" qui ouvre la page du lien dans un nouvel onglet.

- Pour les niveaux, prévoir une page pour l'administrateur afin de donner un poids à chaque niveau de difficulté ;
  l'administrateur peut ajouter pleins de niveaux et les classer les uns par rapports aux autres ;
  ça créé une nouvelle colonne de "poids" ou ça ré-arrange les ID des niveaux.
  Cf. idées de "poids" dans Moodle ;-)

- Sur la page d'index de quiz : prévoir un bouton "sélectionner toutes les catégories" ;

- "question x/y" avec barre de progression ;

CREDITS :

Photos page d'accueil : Tombeau de Ramsès V/Ramsès VI (KV9), travail d'après une photo de aldboroughprimaryschool (cf. https://pixabay.com/fr/photos/tombeau-%C3%A9gypte-antique-brun-tombe-4300251/)
