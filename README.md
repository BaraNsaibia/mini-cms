# Mini-CMS

Projet fil rouge de l'Atelier Framework Côté Serveur (Laravel 13, PHP 8.3+), 3e année MDW, ISET Sidi Bouzid.

**Auteur :** Bara Nsaibia, groupe MDW33.

Mini-CMS évoluera au fil du semestre vers une petite plateforme de publication : pages publiques, back-office authentifié, API JSON et tests Pest. Chaque session se termine par un tag Git (`lab-01`, `lab-01b`, puis un tag par session).

## État actuel (tag lab-03)

-   Articles enregistrés dans une base SQLite et lus avec le modèle Eloquent `Post`.
-   Table `posts` créée par une migration : après un clone, `php artisan migrate` la recrée (vide).
-   Liste paginée, détail par liaison modèle-route, formulaire de création avec validation côté serveur.
-   Premiers tests Pest : `php artisan test`.

## Routes disponibles

| Méthode | URI                     | Nom             | Action                   |
| ------- | ----------------------- | --------------- | ------------------------ |
| GET     | `/`                     | `home`          | `PageController@home`    |
| GET     | `/a-propos`             | `about`         | `PageController@about`   |
| GET     | `/heure`                | `time`          | `PageController@time`    |
| GET     | `/posts`                | `posts.index`   | `PostController@index`   |
| GET     | `/posts/archive/{year}` | `posts.archive` | `PostController@archive` |
| GET     | `/posts/create`         | `posts.create`  | `PostController@create`  |
| POST    | `/posts`                | `posts.store`   | `PostController@store`   |
| GET     | `/posts/{post}`         | `posts.show`    | `PostController@show`    |

## Prérequis

-   PHP 8.3 ou plus, avec les extensions `curl`, `fileinfo`, `mbstring`, `openssl`, `pdo_sqlite`, `sqlite3` et `zip`.
-   [Composer](https://getcomposer.org/).
-   Node.js LTS et npm.
-   Git.

Téléchargement de PHP : [php.net/downloads](https://www.php.net/downloads).

## Installation

### Bash (Git Bash, macOS, Linux)

```bash
git clone https://github.com/BaraNsaibia/mini-cms.git
cd mini-cms
composer install
npm install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
composer run dev
```

### PowerShell (Windows)

```powershell
git clone https://github.com/BaraNsaibia/mini-cms.git
cd mini-cms
composer install
npm install
Copy-Item .env.example .env
php artisan key:generate
New-Item database/database.sqlite -ItemType File
php artisan migrate
composer run dev
```

Ouvrir ensuite [http://localhost:8000](http://localhost:8000). L'application utilise le port 8000 ; Vite utilise généralement le port 5173.

## Captures d'écran

### Accueil avec le layout

![Page d'accueil avec le layout](screenshots/s03_accueil.png)

### Liste des articles — Session 03

![Liste des articles](screenshots/s03-articles.png)

### Détail d'un article

![Détail d'un article](screenshots/s03-article.png)

### Session 04 — Composant x-page-header

![Liste des articles](screenshots/s04-articles.png)

### Session 05

![Liste paginée des articles](screenshots/s05-articles.png)

![Formulaire avec erreurs de validation](screenshots/s05-formulaire.png)
