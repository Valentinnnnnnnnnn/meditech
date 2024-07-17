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
Dans un premier temps, il y avait plusieurs fichiers importants :
- `php/createProduct.php` : Cette page permet de créer un nouveau produit dans la base de données
- `php/CreateSubmit.php` : Cette page traite les données soumises lors de la création d'un produit
- `php/deleteProduct.php` : Cette page permet de supprimer un produit de la base de données
- `php/editSubmit.php` : Cette page traite les données soumises lors de la modification d'un produit
- `php/productDetail.php` : Cette page affiche les détails d'un produit spécifique
- `php/productEdit.php` : Cette page permet de modifier les informations d'un produit
- `php/products.php` : Cette page affiche la liste des produits disponibles
- `script.js` : Gestion des clics sur les produits et des animations 
- `php/script.php` : Gère la connexion avec la base de données


## Comment faire fonctionner Meditech sur ton ordinateur
1. D'abord, il faut installer XAMPP sur l'ordinateur
2. Ensuite, il faut copier tous les fichiers de notre projet dans le dossier `htdocs` de XAMPP
3. Après, il faut importer le fichier `database.sql` dans phpMyAdmin pour créer la base de données
4. Enfin, il faut ouvrir un navigateur web et se rendre sur `http://localhost/meditech` pour voir le site

## Page darrivée du site : 
Lorsque vous allez arriver sur la page d'accueil, on vous demande de vous connecter : soit vous avez déjà un identifiant et vous avez juste a rentrer votre identifiant et mot de passe, soit vous créer un compte. 

##










Semaine 2 : 

# Création d'une VM Oracle et configuration d'un environnement de développement PHP

## Lundi : Création du compte Oracle, de la VM et connexion à GitHub

### 1. Création d'un compte Oracle Cloud

- Rendez-vous sur le site d'Oracle Cloud : [https://www.oracle.com/cloud/](https://www.oracle.com/cloud/)
- Cliquez sur "Essayez Oracle Cloud gratuitement"
- Remplissez le formulaire d'inscription avec vos informations personnelles
- Une fois votre compte créé, connectez-vous à la console Oracle Cloud

### 2. Création de la VM

- Dans la console Oracle Cloud, accédez à la section "Compute" et cliquez sur "Instances"
- Cliquez sur "Créer une instance"
- Sélectionnez l'image de système d'exploitation de votre choix (par exemple, Ubuntu)
- Choisissez la taille de la VM en fonction de vos besoins (par exemple, VM.Standard.E2.1.Micro)
- Cliquez sur "Créer" pour lancer la création de votre VM

### 3. Installation d'Apache et PHP

- Connectez-vous à votre VM en utilisant SSH
- Mettez à jour les packages système avec la commande : `sudo apt update`
- Installez Apache avec la commande : `sudo apt install apache2`
- Vérifiez qu'Apache est bien installé en accédant à l'adresse IP publique de votre VM dans un navigateur web
- Installez PHP avec la commande : `sudo apt install php libapache2-mod-php`
- Redémarrez Apache avec la commande : `sudo systemctl restart apache2`

### 4. Connexion à GitHub et synchronisation avec Git

- Créez un compte sur GitHub si vous n'en avez pas déjà un
- Créez un nouveau repository sur GitHub pour votre projet
- Clonez le repository sur votre ordinateur local en utilisant la commande : `git clone <url_du_repository>`
- Configurez Git sur votre ordinateur local avec une clé SSL
- Effectuez des modifications sur votre projet en local et utilisez les commandes Git (`git add *`, `git commit`, `git push`) pour synchroniser les changements avec le repository GitHub

### 5. Utilisation de Termius pour synchroniser les modifications sur la VM

- Installez Termius sur votre ordinateur local
- Créez une nouvelle connexion SSH dans Termius en utilisant l'adresse IP publique de votre VM et la clé de connexion fournie à la création.
- Dans les paramètres de la connexion, ajoutez votre clé privée SSH pour l'authentification
- Connectez-vous à votre VM via Termius
- Clonez le repository GitHub sur votre VM en utilisant la commande : `git clone <url_du_repository>`

## Mardi : Installation de MySQL et configuration de l'environnement

### 1. Installation de MySQL

- Installez MySQL avec la commande : `sudo apt install mysql-server`
- Sécurisez l'installation de MySQL en exécutant le script : `sudo mysql_secure_installation`
- Suivez les instructions à l'écran pour définir un mot de passe root et configurer les options de sécurité

### 2. Connexion à la base de données créée en local

- Connectez-vous à MySQL en utilisant la commande : `mysql -u root -p`
- Entrez le mot de passe root défini lors de l'installation
- Créez une nouvelle base de données ou utilisez une base de données existante créée en local
- Importez les données de votre base de données locale vers la VM

### 3. Configuration des variables d'environnement (optionnel)

- Ajoutez des variables d'environnement PHP dans le fichier `/etc/php/7.4/apache2/php.ini` 
- Redémarrez Apache après avoir effectué les modifications : `sudo systemctl restart apache2`

### 4. Configuration d'un Virtual Host (optionnel)

- Si vous souhaitez héberger plusieurs sites web sur votre VM, vous pouvez configurer des Virtual Hosts Apache
- Créez un nouveau fichier de configuration dans `/etc/apache2/sites-available/` pour chaque site web
- Configurez le Virtual Host en spécifiant le nom de domaine, le chemin vers les fichiers du site, etc.
- Activez le Virtual Host avec la commande : `sudo a2ensite nom_du_fichier_de_configuration`
- Redémarrez Apache : `sudo systemctl restart apache2`
