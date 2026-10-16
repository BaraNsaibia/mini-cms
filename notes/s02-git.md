# Session 02 - Git et GitHub

Réponses rédigées avec mes propres mots, puis comparées au corrigé de la page.

## 1. Index et commit

Réponse :Cycle Git : git add prépare les fichiers dans l’index, git commit enregistre les changements dans le dépôt local et git push envoie les commits vers le dépôt distant.

## 2. Branche et tag

Réponse :Branche et tag : une branche évolue au fil des commits, tandis qu’un tag identifie un commit précis. Par exemple, lab-01 marque la fin de la première séance.

## 3. Le fichier .env

Réponse :Fichier .env : il contient la clé APP_KEY et les paramètres de configuration propres à l’environnement. On le crée à partir de .env.example, puis on génère la clé avec php artisan key:generate.

## 4. Le dossier vendor/

Réponse :Dossier vendor/ : il contient les dépendances installées par Composer. Il est exclu du dépôt car il est volumineux et peut être recréé avec composer install, en respectant les versions définies dans composer.lock.

## 5. Git Credential Manager

Réponse :Identifiants GitHub : ils sont stockés dans le Gestionnaire d’identification Windows, notamment sous l’entrée git:https://github.com. Sur un ordinateur universitaire partagé, il faut les supprimer pour empêcher les autres utilisateurs d’utiliser votre compte ; sur un ordinateur personnel sécurisé, on peut les conserver.
## 6. Historique depuis lab-01

Nombre de commits depuis lab-01 : 4 commits (68d29dd, 7d930bd, 148edeb, d8c1251).

Fichiers modifiés depuis lab-01 : `README.md` et `screenshots/s02-a-propos.png` (2 fichiers modifiés, 58 insertions, 34 suppressions).

Ce que git tag -n affiche pour lab-01 : `lab-01          lab-01` (affiche le nom du tag suivi de l'annotation/message associé).
