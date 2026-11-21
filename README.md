# Mini-CMS

Projet fil rouge de l'Atelier Framework Côté Serveur (Laravel 13, PHP 8.3+), 3e année MDW, ISET Sidi Bouzid.

**Auteur :** Bara Nsaibia, groupe MDW33.

## Description

Mini-CMS est une plateforme de publication de contenu développée avec Laravel 13 et PHP 8.3. Elle propose un site public complet pour la consultation d'articles, un système d'authentification robuste avec gestion de rôles (auteurs et administrateurs), un back-office d'administration des taxonomies (catégories et tags), ainsi qu'une API REST complète protégée par des jetons personnels Laravel Sanctum.

Le projet a été développé de manière incrémentale sur 15 sessions de codelab, en appliquant les meilleures pratiques du framework Laravel : contrôleurs légers, validation déléguée aux Form Requests, autorisations centralisées via des Gates et Policies, mise en forme des réponses JSON par Eloquent API Resources, prévention stricte des régressions de requêtes N+1 (`preventLazyLoading`), et couverture intégrale par une suite de 89 tests automatisés Pest.

## Fonctionnalités

- **Consultation publique :**
  - Page d'accueil dynamique avec mise en avant des catégories et tags populaires.
  - Liste paginée des articles publiés avec tri antéchronologique.
  - Page de détail d'un article avec informations sur l'auteur, date de publication, catégorie liée, tags et suggestion d'articles connexes.
  - Pages de filtrage par catégorie (`/posts/categorie/{category:slug}`) et par tag (`/posts/tag/{tag:slug}`).
  - Filtrage des archives par année (`/posts/archive/{year}`) et pages institutionnelles (À propos, Heure du serveur).
- **Gestion des articles (Auteurs & Administrateurs) :**
  - Formulaires dédiés de création et de modification avec composants Blade réutilisables.
  - Validation automatique via `StorePostRequest` et `UpdatePostRequest`.
  - Contrôle d'accès strict via `PostPolicy` : seuls l'auteur ou un administrateur peuvent modifier un article.
  - Publication / dépublication immédiate d'un article via requête PATCH.
  - Suppression sécurisée protégée par confirmation et boîte modale.
  - Protection des brouillons : invisibles au public, accessibles uniquement à leur auteur et aux administrateurs.
- **Back-office d'administration (Administrateurs) :**
  - Espace `/admin` protégé par le middleware dédié `admin` (`EnsureUserIsAdmin`).
  - Gestion complète (CRUD) des catégories (`/admin/categories`).
  - Gestion complète (CRUD) des tags (`/admin/tags`).
  - Gestion des utilisateurs (`/admin/utilisateurs`) avec promotion et rétrogradation de rôles.
- **API REST (JSON) :**
  - Endpoints publics en lecture seule pour les articles, catégories et tags avec compteurs d'articles associés.
  - Filtrage multicritères sur les articles : `?category=<slug>`, `?tag=<slug>` et pagination configurable `?per_page=<1-50>`.
  - Formatage strict des réponses JSON via `PostResource`, `CategoryResource` et `TagResource` (exclusion d'informations sensibles, dates au format ISO 8601).
  - Authentification par jetons personnels Sanctum (`POST /api/login`, `POST /api/logout`).
  - Endpoints protégés d'écriture (`POST /api/posts`, `PUT /api/posts/{id}`, `DELETE /api/posts/{id}`) réutilisant intégralement les Form Requests et la `PostPolicy` du site web.
- **Robustesse & Expérience utilisateur :**
  - Messages flash d'information et d'alerte (`x-alert`).
  - Messages d'erreur de validation intégralement traduits en français (`lang/fr/validation.php`).
  - Pages d'erreur personnalisées (403 Accès interdit, 404 Page introuvable, 503 Maintenance) intégrées dans le design de l'application.
  - Middleware de bascule en mode lecture seule (`EnsureSiteIsWritable`).

## Installation

### Bash

```bash
git clone https://github.com/BaraNsaibia/mini-cms.git
cd mini-cms
composer install
npm install
npm run build
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate:fresh --seed
php artisan test
composer run dev
```

### PowerShell

```powershell
git clone https://github.com/BaraNsaibia/mini-cms.git
cd mini-cms
composer install
npm install
npm run build
copy .env.example .env
php artisan key:generate
New-Item database/database.sqlite -ItemType File
php artisan migrate:fresh --seed
php artisan test
composer run dev
```

L'application est ensuite accessible dans le navigateur à l'adresse [http://localhost:8000](http://localhost:8000).

## Comptes de test

La commande de peuplement (`php artisan migrate:fresh --seed`) crée les comptes suivants :

- **Compte Administrateur :**
  - **E-mail :** `test@example.com`
  - **Mot de passe :** `password`
  - **Rôle :** `admin` (accès complet au site, à tout le back-office `/admin`, et aux écritures de l'API).
- **Comptes Auteurs :**
  - Des utilisateurs avec le rôle `author` sont générés aléatoirement par le seeder pour alimenter les articles de démonstration.
  - **Mot de passe commun :** `password`
  - De nouveaux comptes auteurs peuvent également être créés directement via la page d'inscription `/inscription`.

## API

### Endpoints

| Méthode | URI | Nom de route | Accès | Description |
|---|---|---|---|---|
| POST | `/api/login` | `api.login` | Public | Authentification, renvoie un jeton Bearer Sanctum (201) |
| POST | `/api/logout` | `api.logout` | Jeton Sanctum | Révocation du jeton courant (204) |
| GET | `/api/posts` | `api.posts.index` | Public | Liste paginée des articles publiés (filtres `?category=`, `?tag=`, `?per_page=`) |
| GET | `/api/posts/{post}` | `api.posts.show` | Public | Détail d'un article publié (inclut le `body`) |
| POST | `/api/posts` | `api.posts.store` | Jeton Sanctum | Création d'un article par l'auteur connecté (201) |
| PUT/PATCH | `/api/posts/{post}` | `api.posts.update` | Jeton Sanctum | Modification d'un article (propriétaire uniquement, 200) |
| DELETE | `/api/posts/{post}` | `api.posts.destroy` | Jeton Sanctum | Suppression d'un article (propriétaire uniquement, 204) |
| GET | `/api/categories` | `api.categories.index` | Public | Liste des catégories avec `posts_count` |
| GET | `/api/categories/{category}` | `api.categories.show` | Public | Détail d'une catégorie avec `posts_count` |
| GET | `/api/tags` | `api.tags.index` | Public | Liste des tags avec `posts_count` |
| GET | `/api/tags/{tag}` | `api.tags.show` | Public | Détail d'un tag avec `posts_count` |
| GET | `/api/user` | — | Jeton Sanctum | Informations de l'utilisateur authentifié |

### Authentification par jeton

L'API repose sur des jetons d'accès personnels émis par Laravel Sanctum :

1. Le client effectue une requête POST sur `/api/login` avec ses identifiants JSON :
   ```json
   {
       "email": "test@example.com",
       "password": "password"
   }
   ```
2. Le serveur valide les informations et renvoie le jeton en clair avec le code HTTP 201 :
   ```json
   {
       "token": "1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
       "token_type": "Bearer"
   }
   ```
3. Pour accéder aux endpoints protégés, le client transmet ce jeton dans l'en-tête de chaque requête :
   `Authorization: Bearer <VOTRE_JETON>`
4. L'envoi d'une requête sur `/api/logout` révoque et supprime immédiatement le jeton actif.

### Codes d'erreur

L'API renvoie des réponses JSON prévisibles associées aux codes de statut HTTP standards :

- **200 OK :** Requête traitée avec succès.
- **201 Created :** Ressource créée avec succès (jeton émis, nouvel article créé).
- **204 No Content :** Opération exécutée avec succès ne nécessitant aucun corps de réponse (déconnexion, suppression).
- **401 Unauthorized :** Absence de jeton d'authentification ou jeton révoqué (`{"message": "Unauthenticated."}`).
- **403 Forbidden :** Action refusée par l'autorisation (`PostPolicy`), notamment la tentative de modification ou de suppression d'un article appartenant à un autre auteur.
- **404 Not Found :** Ressource introuvable (`{"message": "Not Found."}`).
- **422 Unprocessable Content :** Données invalides fournies dans la requête, avec détail des erreurs par champ en français sous la clé `errors`.
- **503 Service Unavailable :** Mode maintenance ou site en lecture seule activé (`SITE_READ_ONLY=true`).

### Exemple curl.exe

```bash
curl.exe -X POST -H "Accept: application/json" -H "Authorization: Bearer VOTRE_JETON" http://localhost:8000/api/logout
```

## Captures d'écran

### Accueil avec le layout

![Page d'accueil avec le layout](screenshots/<img width="1529" height="694" alt="s03_acceuil" src="https://github.com/user-attachments/assets/65d49684-3de1-4314-87ad-707afef05b6a" />)

### Liste des articles — Session 03

![Liste des articles](screenshots/s03-articles.png)

### Détail d'un article

![Détail d'un article](screenshots/s03-article.png)

### Session 04 — Composant x-page-header

![Liste des articles](screenshots/s04-articles.png)

### Session 05

![Liste paginée des articles](screenshots/s05-articles.png)

![Formulaire avec erreurs de validation](screenshots/s05-formulaire.png)

### Session 06

![Formulaire de modification prérempli](screenshots/s06-modification.png)

![Confirmation de suppression](screenshots/s06-suppression.png)

### Session 07

![Liste des articles avec leur catégorie, leur auteur et leurs tags](screenshots/s07-liste-relations.png)

![Page d'un article avec ses tags et les articles de la même catégorie](screenshots/s07-detail-tags.png)

### Session 08

![Formulaire de modification avec la catégorie et les tags](screenshots/s08-formulaire-relations.png)

![Page des articles d'une catégorie](screenshots/s08-page-categorie.png)

### Session 09

![Page d'un article avec le message flash « Article créé. »](screenshots/s09-message-flash.png)

![Page Article introuvable pour un identifiant inexistant](screenshots/s09-article-introuvable.png)

### Session 10

![Formulaire de catégorie envoyé vide, avec les messages de validation en français](screenshots/s10-validation.png)

![Page 404 du site pour une adresse inconnue](screenshots/s10-404.png)

### Session 11

![Barre de navigation d'un utilisateur connecté, avec le message « Vous êtes connecté. »](screenshots/s11-connexion.png)

![Page 403 quand un auteur ouvre la modification de l'article d'un autre auteur](screenshots/s11-interdit.png)

### Session 12

![Page 403 « Réservé aux administrateurs. » pour un compte auteur sur /admin/tags](screenshots/s12-admin-interdit.png)

![Barre de navigation d'un compte auteur, sans les liens Catégories et Tags](screenshots/s12-menu-auteur.png)

### Session 13

![Postman : réponse JSON de GET /api/posts?per_page=2, avec data, links et meta](screenshots/s13-postman-liste.png)

![Postman : réponse 422 de GET /api/posts?per_page=500, avec le message en français](screenshots/s13-postman-422.png)

### Session 14

![Postman : POST /api/posts avec un jeton Bearer, onglet Body, réponse 201 Created](screenshots/s14-postman-201.png)

![Postman : PUT sur l'article d'un autre auteur, réponse 403](screenshots/s14-postman-403.png)

## Choix d'architecture

### Pourquoi les écritures de l'API passent par PostPolicy

Une unique règle d'autorisation centralisée (`PostPolicy`) décide qui peut modifier ou supprimer un article, pour l'interface web (Blade) comme pour l'API REST. Si la règle évolue (par exemple un changement des permissions administrateur ou des règles de co-rédaction), les deux portes d'entrée changent ensemble de façon cohérente, garantissant que l'API ne devienne pas une faille ou un contournement des droits définis sur le site.

### Pourquoi preventLazyLoading est activé

Lorsqu'une relation Eloquent est accédée dans une vue ou une boucle sans chargement anticipé (`with` / `load`), cela engendre silencieusement le problème N+1 requêtes SQL, ce qui dégrade drastiquement les performances avec le volume de données. `Model::preventLazyLoading(! app()->isProduction())` lève une exception immédiate (`LazyLoadingViolationException`) en développement ou lors de l'exécution des tests dès qu'un chargement différé survient, forçant le développeur à corriger la requête avant toute mise en production.

### Pourquoi l'API utilise des jetons et non la session

Le middleware group `api` est par nature sans état (*stateless*) : il n'instancie ni session serveur ni cookies de navigation. Les clients de l'API (applications mobiles, scripts tiers, Postman, front-end découplé) s'authentifient en fournissant un jeton d'accès personnel Sanctum via l'en-tête HTTP `Authorization: Bearer <jeton>`. Ce jeton peut être révoqué individuellement à tout moment (par exemple lors de la déconnexion d'un appareil) sans affecter les sessions ou jetons d'autres appareils.
