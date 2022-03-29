# MyOnlineQuiz

PHP Quiz with MVC and POO

TODO :

- mettre des required pour tous les input
- Vérifier que tous les boutons renvoient bien au bon endroit (notamment page public/index.php)
- enlever les images dans les questions (question_pîcture ; feedback_picture)

- onglet avec RGPD (page dans /public/RGPD) + ajout colonne deleted_at et on vide les données du user sauf le mail pour vérifier qu'on a bien supprimé ses données.
- vérifier la bonne syntaxe du mail à la connexion (majuscule).
- Faire la partie "mot de passe oublié" (Sokou)

- si la valeur existe déjà à la création ou à la modification (voir pour l'orthographe avec ou sans "s" par exemple ; faire un try-catch pour afficher l'erreur en cas de doublon (Sql avec unique)) - en PHP uniquement;

  - vérifier à l'aide d'une requête SQL si une catégorie a déjà le même nom
  - vérifier à l'aide d'une requête SQL si un niveau a déjà le même nom
  - vérifier à l'aide d'une requête SQL si une image a déjà le même nom

######################################

Pour la version suivante (V2) :

- statistiques plus précises sur le nombre de vues (depuis quand, sélectionner une période, une ou plsuieurs pages, etc.)
- PREVOIR des photos pour les questions (si il y en a, on lui prévoit une place où s'afficher);
- PREVOIR une place pour une photo dans les feedbacks ainsi qu'un lien pour en savoir plus !

- PREVOIR un bouton qui permette de nettoyer la base de données photos en php (vérification des images utilisées sur le site et comparaison avec la BDD afin de voir les images non utilisées et les supprimer le cas échéant).

- PREVOIR une case 'lien" pour chaque question avec, si le lien existe, un pett "en savoir plus" qui ouvre la page du lien dans un nouvel onglet.

- Pour les niveaux, prévoir une page pour l'administrateur afin de donner un poids à chaque niveau de difficulté ;
  l'administrateur peut ajouter pleins de niveaux et les classer les uns par rapports aux autres ;
  ça créé une nouvelle colonne de "poids" ou ça ré-arrange les ID des niveaux.
  Cf. idées de "poids" dans Moodle 😊

- Sur la page d'index de quiz : prévoir un bouton "sélectionner toutes les catégories" ;

- "question x/y" avec barre de progression ;

- obtenir les thématiques des quiz et les niveaux - plus tard
- obtenir les dates de connexion (pour voir son activité) - notamment sa date de dernière activité afin de supprimer un utilisateur qui n'est pas venu pendant longtemps ?
- bannir un utilisateur (bloque son ip pendant x temps)

CREDITS :

Photos page d'accueil : Tombeau de Ramsès V/Ramsès VI (KV9), travail d'après une photo de aldboroughprimaryschool (cf. https://pixabay.com/fr/photos/tombeau-%C3%A9gypte-antique-brun-tombe-4300251/)
