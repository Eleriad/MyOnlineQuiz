# MyOnlineQuiz

PHP Quiz with MVC and POO

Idée : 4 propositions à chaque fois :

- pour une question facile, 2 propositions à écarter facilement ;
- Pour une question normale, 1 proposition à écarter facilement,
- Pour une question difficile, tous les propositions peuvent être les bonnes
- Pour une question divin, les réponses sont très difficiles (dates à 1 année près, auteur inconnu, ...)

QuestionVF : si ce qu'on retourne ne contient que 2 éléments, alors on a affaire à une question VRAI ou FAUX ;-)

TODO :

- Vérifier tous les post, notamment si le feedback débute par des guillements simples ou doubles avec secureArray et SecureString

- Vérifier tous les POST qui pourraient être vides avec la fonction isEmpty

- ajouter des messages à chaque vérification (revoir toutes les pages !)
  Faire le phpdoc pour toutes les functions :-(

      - Faire les vérification des niveaux et catégories en JS et PHP  :

          - si l'input est vide (JS & PHP) ;

          - si la valeur existe déjà à la création ou à la modification (voir pour l'orthographe avec ou sans "s" par exemple ; faire un try-catch pour afficher l'erreur en cas de doublon (Sql avec unique)) - en PHP uniquement;

      - mettre des required pour tous les input une fois les vérif en JS et PHP effectuées !

- Vérifier les bouttons de la page public/index.php

A AJOUTER :

- PREVOIR des photos pour les questions (si il y en a, on lui prévoit une place où s'afficher);
- PREVOIR une place pour une photo dans les feedbacks ainsi qu'un lien pour en savoir plus !

- PREVOIR un bouton qui permette de nettoyer la base de données photos en php (vérification des images utilisées sur le site et comapraison avec la BDD afin de voir les images non utilisées et les supprimer le cas échéant).

Pour la version suivante (V2) :

- Pour les niveaux, prévoir une page pour l'administrateur afin de donner un poids à chaque niveau de difficulté ;
  l'administrateur peut ajouter pleins de niveaux et les classer les uns par rapports aux autres ;
  ça créé une nouvelle colonne de "poids" ou ça ré-arrange les ID des niveaux.
  Cf. idées de "poids" dans Moodle ;-)

- Sur la page d'index de quiz : prévoir un bouton "sélectionner toutes les catégories" ;

- "question x/y" avec barre de progression ;

CREDITS :

Photos page d'accueil : Tombeau de Ramsès V/Ramsès VI (KV9), travail d'après une photo de aldboroughprimaryschool (cf. https://pixabay.com/fr/photos/tombeau-%C3%A9gypte-antique-brun-tombe-4300251/)
