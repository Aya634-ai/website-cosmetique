# 💄 Glow and Go — Site e-commerce de cosmétiques

![PHP](https://img.shields.io/badge/PHP-8-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-MariaDB-4479A1?logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?logo=javascript&logoColor=black)
![XAMPP](https://img.shields.io/badge/XAMPP-Apache-FB7A24?logo=xampp&logoColor=white)

**Glow and Go** est un site web de vente de produits cosmétiques conçu pour révéler une beauté naturelle et durable. Les clients parcourent le catalogue, ajoutent des produits au panier, passent commande et contactent la boutique. L'administrateur gère le catalogue depuis un espace dédié.

## Sommaire

- [Fonctionnalités](#-fonctionnalités)
- [Technologies](#-technologies)
- [Comptes de démonstration](#-comptes-de-démonstration)
- [Installation et exécution](#-installation-et-exécution)
- [Utilisation](#-utilisation)
- [Structure du projet](#-structure-du-projet)
- [Base de données](#-base-de-données)
- [Dépannage](#-dépannage)
- [Auteure](#-auteure)

## 🚀 Fonctionnalités

**Client**
- Inscription et connexion
- Page d'accueil avec vidéo de présentation et sélection de produits
- Boutique : catalogue complet des produits
- Panier : ajout de produits avec choix de la quantité
- Commandes
- Page « À propos » et formulaire de contact / messages

**Administrateur**
- Connexion à un espace réservé
- Ajout de produits (nom, prix, image)
- Modification et suppression de produits
- Consultation des messages reçus

## 🛠️ Technologies

| Domaine | Outils |
|---|---|
| Backend | PHP 8, MySQL / MariaDB (extension `mysqli`) |
| Frontend | HTML, CSS, JavaScript |
| Icônes | Font Awesome |
| Environnement | XAMPP (Apache + MySQL), Git / GitHub |

## 🔑 Comptes de démonstration

Ces comptes sont créés automatiquement à l'import de `database/dbqueries.sql`.

| Rôle | Email | Mot de passe |
|---|---|---|
| Administrateur | `admin@exemple.com` | `Admin@123` |
| Client | `aya@gmail.com` | `123456` |

> ⚠️ Comptes réservés à la démonstration en local. Changez les mots de passe avant tout autre usage.

## 📦 Installation et exécution

### Prérequis

- [XAMPP](https://www.apachefriends.org) (PHP 8+, Apache, MySQL)
- [Git](https://git-scm.com)
- Un navigateur récent (Chrome, Edge ou Firefox)

### Étape 1 : récupérer le projet

```bash
cd C:\xampp\htdocs
git clone https://github.com/Aya634-ai/website-cosmetique.git website_cosmetique
```

### Étape 2 : démarrer Apache et MySQL

Ouvrir le **XAMPP Control Panel** et cliquer sur **Start** pour **Apache** et **MySQL**.

### Étape 3 : créer et importer la base de données

Le script SQL se trouve dans le dossier [`database/`](database/).

1. Ouvrir http://localhost/phpmyadmin
2. Créer une base nommée **`dbqueries`** (interclassement `utf8mb4_general_ci`)
3. Sélectionner la base, onglet **Importer**, puis choisir `database/dbqueries.sql`
4. *(Optionnel)* Importer ensuite `database/sample_products.sql` pour avoir des produits d'exemple

Ou en ligne de commande :

```cmd
C:\xampp\mysql\bin\mysql.exe -u root -e "CREATE DATABASE IF NOT EXISTS dbqueries;"
C:\xampp\mysql\bin\mysql.exe -u root dbqueries < "C:\xampp\htdocs\website_cosmetique\database\dbqueries.sql"
C:\xampp\mysql\bin\mysql.exe -u root dbqueries < "C:\xampp\htdocs\website_cosmetique\database\sample_products.sql"
```

### Étape 4 : vérifier la connexion

Le fichier `config.php` doit contenir :

```php
$conn = mysqli_connect('localhost', 'root', '', 'dbqueries');
```

Le mot de passe de `root` est vide par défaut sous XAMPP.

### Étape 5 : ouvrir le site

http://localhost/website_cosmetique/

**Variante sans Apache** (MySQL doit rester démarré) :

```cmd
cd /d "C:\xampp\htdocs\website_cosmetique"
C:\xampp\php\php.exe -S localhost:8000
```

Puis ouvrir http://localhost:8000

## 🧭 Utilisation

1. **Se connecter** avec un compte de démonstration, ou **s'inscrire** sur la page d'inscription.
2. **Ajouter des produits** (connecté en administrateur) depuis `admin_products.php` : renseigner le nom, le prix et une image (jpg ou png, 2 Mo maximum). Les images sont enregistrées dans `uploaded_img/`.
3. **Parcourir la boutique** (`shop.php`) et cliquer sur **Add to Cart**.
4. **Passer commande** depuis le panier.

> Si la boutique affiche « No Products Added Yet ! », la table `products` est vide : ajoutez des produits depuis l'espace administrateur.

## 📁 Structure du projet

```
website_cosmetique/
├── config.php             # Connexion à la base de données
├── login.php              # Connexion
├── register.php           # Inscription
├── user_header.php        # En-tête espace client
├── admin_header.php       # En-tête espace administrateur
├── footer.php             # Pied de page
├── shop.php               # Catalogue des produits
├── about.php              # Page « À propos »
├── admin_products.php     # Gestion des produits (administrateur)
├── message_detail.php     # Détail d'un message
├── style.css              # Styles du site
├── admin.css              # Styles de l'espace administrateur
├── script.js              # JavaScript du site
├── admin_js.js            # JavaScript de l'espace administrateur
├── video.mp4              # Vidéo de la page d'accueil
├── uploaded_img/          # Images des produits
└── database/
    ├── dbqueries.sql      # Structure et comptes de démonstration
    └── sample_products.sql # Produits d'exemple (optionnel)
```

## 🗄️ Base de données

Base : **`dbqueries`**

| Table | Rôle |
|---|---|
| `products` | Catalogue : `id`, `name`, `price`, `image` |
| `register` | Comptes : `id`, `name`, `email`, `password` (MD5), `user_type` (`admin` ou `user`) |
| `cart` | Panier par utilisateur : produit, prix, quantité, image |
| `orders` | Commandes : client, mode de paiement, adresse, produits, total, statut de paiement |
| `message` | Messages des clients : nom, e-mail, téléphone, message |

## 🩺 Dépannage

| Problème | Solution |
|---|---|
| `No Products Added Yet !` | La table `products` est vide : ajouter des produits depuis `admin_products.php` |
| `Unknown database` ou erreur de connexion | Vérifier que MySQL est démarré et que le nom de la base dans `config.php` est `dbqueries` |
| Images absentes | Vérifier que les fichiers sont dans `uploaded_img/` |
| Page sans style | Vérifier la présence de `style.css` et des fichiers CSS référencés par la page |
| Port 80 occupé | Changer le port d'Apache (`Listen 8080` dans `httpd.conf`) et ouvrir `http://localhost:8080/...` |
| Port 3306 occupé | Arrêter l'autre service MySQL en cours d'exécution |
| `'php' n'est pas reconnu` | Utiliser le chemin complet `C:\xampp\php\php.exe` |

## 👩‍💻 Auteure

**Aya Zouine** — Étudiante en développement logiciel et technologies de l'information, IGA Belvédère, Casablanca.
GitHub : [@Aya634-ai](https://github.com/Aya634-ai)

> Ce projet est basé sur un projet de librairie open source, adapté pour une boutique de cosmétiques. Vérifiez la licence du projet d'origine avant toute réutilisation.

> 🔒 Les mots de passe sont stockés en MD5, ce qui est insuffisant en production. Utilisez `password_hash()` et `password_verify()` de PHP pour un usage réel.
