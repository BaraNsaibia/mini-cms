# Session 03 - Routes, contrôleurs et layout

## Défi

URL produite par route('about') :http://localhost:8000/a-propos

URL produite par route('posts.show', 'routes-et-controleurs') :http://localhost:8000/posts/routes-et-controleurs

URL produite par route('posts.archive', 2025) :http://localhost:8000/posts/archive/2025

Pourquoi /posts/archive/abc et /posts/article-inconnu répondent toutes deux 404, et quelle ligne de code en est responsable dans chaque cas ?
whereNumber('year') dans web.php bloque la route si le paramètre n’est pas numérique. En revanche, /posts/article-inconnu correspond à la route, puis PostController::show déclenche abort(404) si l’article n’existe pas.
Que se passe-t-il si une vue appelle route('posts.show') sans paramètre ?
Laravel affiche Missing required parameter for [Route: posts.show] lorsque la route posts.show exige un paramètre (par exemple, id ou post), mais que celui-ci n’est pas fourni lors de la génération de l’URL avec route('posts.show').
