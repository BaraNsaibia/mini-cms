# Session 05 - Défi : articles récents sur l'accueil

latestPosts contient au plus 3 articles : oui / non\*\*

Réponse : Oui. `take(3)` limite le nombre d'articles récupérés à trois maximum.
Seuls les articles publiés sont transmis à la vue : oui / non\*\*

Réponse : Oui. `where('is_published', true)` filtre les articles pour ne récupérer que ceux qui sont publiés.

home.blade.php utilise x-post-card et @forelse : oui / non\*\*

Réponse : Oui. `x-post-card` affiche chaque article et `@forelse` permet d'afficher un message si aucun article n'est disponible.

Le nouveau test passe et php artisan test est vert : oui / non\*\*

Réponse : Oui, si le nouveau test réussit et que l'ensemble des tests du projet passe avec `php artisan test`.

Pourquoi get() et pas paginate(3) sur la page d'accueil ?\*\*

Réponse : `get()` exécute la requête et renvoie une collection contenant au maximum trois articles. `paginate(3)` ajouterait une pagination avec des numéros de page, ce qui est inutile pour afficher uniquement les trois derniers articles sur la page d'accueil.
