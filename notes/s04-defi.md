# Session 04 - Défi x-page-header

@props déclare title (obligatoire) et subtitle (par défaut null) : oui / non\*\*

Réponse : Oui.

Le paragraphe ne s'affiche que si subtitle est fourni : oui / non\*\*

Réponse : Oui.

Le composant remplace le h1 de a-propos.blade.php et de posts/index.blade.php : oui / non\*\*

Réponse : Oui.

Aucune URL écrite à la main : oui / non\*\*

Réponse : Oui.

Sur /posts/archive/2025, quel titre affiche x-page-header, et d'où vient-il ?\*\*

Réponse : Le composant affiche « Articles de 2025 ». Ce titre est construit par `PostController::archive` dans la variable `$heading`, puis transmis au composant avec `:title="$heading"` dans `posts/index.blade.php`.
