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
Pourquoi aucune migration, aucun modèle et aucun test n'a changé ?


Eloquent et le constructeur de schéma adaptent les mêmes instructions au pilote de base de données utilisé : seule la connexion change. Cette compatibilité repose sur des règles de portabilité : éviter le SQL brut, comparer les booléens à true ou false, définir un ordre explicite pour chaque liste et effectuer des comparaisons exactes des slugs.
