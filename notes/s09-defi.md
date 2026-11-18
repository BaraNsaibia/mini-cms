# Session 09 - Défi

-   Le bandeau s'affiche sur toutes les pages lorsque `SITE_READ_ONLY=true` : oui / non
-   Le bandeau disparaît lorsque `SITE_READ_ONLY=false` : oui / non
-   La page « Article introuvable » affiche au maximum trois articles publiés, sans inclure les brouillons : oui / non
-   Aucune `LazyLoadingViolationException` n'est déclenchée sur `/posts/999` : oui / non
-   Les deux nouveaux tests passent et l'ensemble des tests exécutés avec `php artisan test` est validé : oui / non

**Questions de compréhension :**

1. Pourquoi le bandeau est-il placé dans le layout principal plutôt que dans chaque vue individuellement ?
2. Pourquoi le test du bandeau ne nécessite-t-il pas de modifier le fichier `.env` ?

**Éléments de réponse :**

-   Le layout principal englobe toutes les pages du site, y compris la page d'erreur. Placer le bandeau à cet endroit permet donc de l'afficher partout sans répéter le même code dans chaque vue. Toute modification peut ainsi être effectuée à un seul endroit.

-   L'instruction `config(['site.read_only' => true])` permet de modifier la valeur de configuration uniquement pendant l'exécution du test. Le fichier `phpunit.xml` conserve la valeur `false` pour les autres tests. Il n'est donc pas nécessaire de modifier le fichier `.env`.
