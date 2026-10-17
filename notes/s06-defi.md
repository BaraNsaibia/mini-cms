# Session 06 - Défi : publier et dépublier

La route posts.publication apparaît dans route:list avec le verbe PATCH : oui / non\*\*

Réponse : Oui, si la route est déclarée avec `Route::patch()` dans `routes/web.php`.

Le bouton affiche « Publier » sur un brouillon et « Dépublier » sur un article publié : oui / non\*\*

Réponse : Oui. Le texte du bouton dépend de la valeur de `$post->is_published` : il affiche « Dépublier » si l'article est publié et « Publier » dans le cas contraire.

published_at est rempli à la publication et vidé à la dépublication : oui / non\*\*

Réponse : Oui. Lors de la publication, `published_at` reçoit la date et l'heure actuelles avec `now()`. Lors de la dépublication, sa valeur devient `null`.

Le nouveau test passe et php artisan test est vert : oui / non\*\*

Réponse : Oui, si le nouveau test réussit et que tous les tests du projet passent avec `php artisan test`.

Pourquoi PATCH et pas PUT ni GET pour ce bouton ?\*\*

Réponse : `PATCH` permet de modifier partiellement une ressource, ici l'état de publication de l'article. `PUT` sert généralement à remplacer l'ensemble d'une ressource. `GET` sert à consulter des données et ne doit pas modifier l'état de l'application.
