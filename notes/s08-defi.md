# Session 08 - Défi

La route posts.tag utilise {tag:slug} : oui
La page d'un tag n'affiche ni brouillon ni article d'un autre tag : oui
Les tags des cartes sont des liens : oui
L'accueil n'affiche que les tags qui ont au moins un article publié : oui
Les trois nouveaux tests passent et php artisan test est vert : oui

Pourquoi filtrer les tags vides après get() plutôt que d'afficher (0) ?
Pour afficher uniquement les tags qui possèdent au moins un article publié et éviter de montrer des tags sans contenu accessible aux visiteurs.
Combien de requêtes ajoute la liste des tags populaires, et pourquoi pas une par tag ?
Une seule requête SQL supplémentaire. withCount() compte les articles publiés pour chaque tag dans la requête de récupération des tags, ce qui évite le problème N+1
