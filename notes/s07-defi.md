# Session 07 - Défi : articles de la même catégorie

1. La section « Dans la même catégorie » apparaît sous un article publié qui a une catégorie :
   oui, si au moins un autre article publié appartient à cette catégorie.

2. L'article affiché n'apparaît pas dans sa propre section :
   oui, grâce à `where('id', '!=', $post->id)`.

3. Un brouillon de la même catégorie n'apparaît pas :
   oui, car `published()` sélectionne uniquement les articles publiés.

4. La page s'ouvre sans LazyLoadingViolationException :
   oui, grâce au chargement anticipé des relations avec `load()` et `with()`.

5. Le nouveau test passe et php artisan test est vert :
   à vérifier après l'exécution des tests.

## Combien de requêtes SQL charge la section, et pourquoi pas une par carte ?

La section utilise **4 requêtes SQL** : une pour récupérer les articles associés à la catégorie, puis trois pour charger leurs auteurs, catégories et tags.

Grâce à `with('user', 'category', 'tags')`, Laravel utilise le chargement anticipé (_eager loading_). Les relations sont récupérées pour tous les articles en quelques requêtes groupées, au lieu d'exécuter une requête supplémentaire pour chaque relation de chaque carte.

Cela évite le problème N+1, améliore les performances et empêche les erreurs liées au lazy loading.
