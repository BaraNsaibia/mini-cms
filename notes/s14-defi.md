# Session 14 - Défi

Connexion enregistre le jeton toute seule : oui
Créer un article répond 201 sans copier le jeton : oui
Le fichier exporté ne contient aucun jeton : oui

Le dépôt est public. Que risquez-vous si le fichier exporté contient un jeton, et comment l'annuler ?
Si un jeton se retrouve dans un dépôt public, n'importe qui peut l'utiliser pour créer, modifier ou supprimer des ressources avec les droits du compte associé. Pour l'annuler, il suffit d'invoquer la déconnexion (`POST /api/logout` avec le jeton) ou de supprimer l'entrée correspondante dans la table `personal_access_tokens` (via tinker ou l'interface de base de données).

Pourquoi les écritures de l'API passent-elles par les Form Requests et PostPolicy plutôt que par des règles écrites dans Api\PostController ?
Cela garantit une source unique de vérité pour la validation et l'autorisation dans l'application. Les mêmes règles de validation métier (`StorePostRequest`, `UpdatePostRequest`) et les mêmes droits d'accès (`PostPolicy`) s'appliquent de manière cohérente au site web et à l'API, évitant toute duplication de code et tout risque de divergence ou de faille de sécurité.
