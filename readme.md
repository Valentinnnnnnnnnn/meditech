# Mon projet de la semaine : Meditech


## C'est quoi Meditech ?
Cette semaine, on a créé un site web appelé Meditech. C'est un site développé en PHP qui me permet de gérer une base de données de médicaments. Avec Meditech, on peut faire plusieurs choses :
- Lister les médicaments en stock
- Changer les informations des médicaments qui sont déjà dans la base de données
- Ajouter de nouveaux médicaments
- Supprimer des médicaments
Pour créer Meditech, on a utilisé un éditeur de code nommé phpStorm. On a aussi utilisé XAMPP, qui nous permet d'avoir un serveur web en local pour tester notre site et gérer la base de données.


## Les outils que j'ai utilisés
- PHP : C'est le langage de programmation que j'ai utilisé pour créer mon site web. xamm
- [XAMPP](https://www.apachefriends.org/fr/) : C'est un ensemble de logiciels qui m'a permis de créer un serveur Apache ainsi qu'une base de données MySQL.
- [phpStorm]((https://www.jetbrains.com/phpstorm/promo/?source=google&medium=cpc&campaign=EMEA_en_FR_PhpStorm_Branded&term=phpstorm&content=540305604152&gad_source=1&gclid=CjwKCAjwps-zBhAiEiwALwsVYcMuSfkJpCxn-vR6WYVE50DkBSeleaQyQpc0QmXjErnX_OF0Z8vRlBoCY9AQAvD_BwE)) : C'est l'éditeur de ce qu'on a utilisé pour écrire le code PHP.


## Comment j'ai organisé mon projet
Dans mon projet Meditech, il y a plusieurs fichiers importants :
- `php/createProduct.php` : Cette page permet de créer un nouveau produit dans la base de données
- `php/CreateSubmit.php` : Cette page traite les données soumises lors de la création d'un produit
- `php/deleteProduct.php` : Cette page permet de supprimer un produit de la base de données
- `php/editSubmit.php` : Cette page traite les données soumises lors de la modification d'un produit
- `php/productDetail.php` : Cette page affiche les détails d'un produit spécifique
- `php/productEdit.php` : Cette page permet de modifier les informations d'un produit
- `php/products.php` : Cette page affiche la liste des produits disponibles
- `script.js` : Gestiond des clics sur les produits et des animations 
- `php/script.php` : Gère la connexion avec la base de données


## Comment faire fonctionner Meditech sur ton ordinateur
1. D'abord, il faut installer XAMPP sur l'ordinateur (via le lien ci-dessus)
2. Ensuite, il faut copier tous les fichiers de notre projet dans le dossier `htdocs` de XAMPP
3. Après, tu dois importer le fichier `database.sql` dans phpMyAdmin pour créer la base de données
4. Enfin, tu ouvres ton navigateur web et tu vas sur `http://localhost/meditech` pour voir le site
Voilà, c'est tout ! Maintenant, tu peux regarder comment j'ai fait mon site et même le modifier si tu veux !


## Page darrivée du site : 
Lorsque vous allez arriver sur la page d'accueil, on vous demande de vous connecter : soit vous avez déjà un identifiant et vous avez juste a rentrer votre identifiant et mot de passe, soit vous créer un compte. 

##