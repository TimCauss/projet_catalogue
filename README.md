# Projet 4 : Catalogue
du 23/05/2023 au 20/06/2023

💡- Technologies : HTML, CSS, Bootstrap/Tailwind, PHP, MySQL
👨‍👩‍👧‍👦- Projet par groupes de 2 ou 3

## Description :
Le but est de créer un catalogue dont le choix du thème vous appartient (on parle d’un catalogue du type Allociné pour les films, le but n’est pas de faire un site e-commerce). Ce catalogue doit permettre de visualiser une grille de produits (films, musiques, objets...). En cliquant sur un produit de cette grille, on pourra consulter la page individuelle de celui-ci. Cette page individuelle fournira une description et des informations supplémentaires.

Chaque produit appartient à une catégorie. On pourra trier les produits par catégorie. Il faudra également créer un back-office permettant aux administrateurs du catalogue d’ajouter de nouveaux produits, de les modifier et de les supprimer.

### Pages
+ Une page d’accueil avec la grille de produits
+ Une page individuelle par produit. Un produit contiendra au minimum :
+ Un nom
+ Une description
+ Une image/photo
+ Une catégorie
+ Une page par catégorie
+ Une page de connexion pour les administrateurs
+ Un back-office permettant :
  + d’ajouter des produits via un formulaire
  + de modifier les produits existants
  + de supprimer les produits existants
### Base de données
La base de données sera composée d’au moins trois tables :
+ une table pour les produits
+ une table pour les catégories
+ une table pour les utilisateurs

### Gestion des utilisateurs

+ Option 1 :
"La table des utilisateurs sert uniquement à s’identifier. Tous les utilisateurs ont les mêmes droits d’aministration qui permettent d’accéder au back-office. Ils peuvent agir sur l’ensemble des produits."

+ Option 2 :
"La table des utilisateurs permet de savoir qui a ajouté un produit.
Un administrateur principal peut agir sur l’ensemble des produits.
Les autres gestionnaires ne peuvent agir que sur les produits qu’ils ont ajouté eux-
mêmes."

### Bonus : 
l’administrateur principal gère les comptes des autres utilisateurs.

### Back-office
Pour l’apparence du back-office, il faudra utiliser un framework CSS, Bootstrap ou
Tailwind.
