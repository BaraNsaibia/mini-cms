# Session 12 - Défi

1. Pourquoi role n'est-il pas dans #[Fillable], et comment votre contrôleur le modifie-t-il quand même ?
Le champ role est exclu de $fillable pour éviter toute élévation de privilèges accidentelle lors d'une assignation de masse (par exemple si un formulaire d'inscription ou une requête HTTP inclut un champ role). Le contrôleur le modifie de manière explicite et sécurisée en affectant directement la propriété ($user->role = ...) après avoir validé les données et vérifié l'autorisation via la Policy, puis en appelant $user->save().

2. Pourquoi le callback de Gate::before doit-il renvoyer null, et non false, pour un auteur ?
Renvoyer false dans Gate::before constitue un refus absolu qui bloque immédiatement la requête sans évaluer les autres Gates ou méthodes de Policy. Renvoyer null indique que le callback n'a pas d'avis prioritaire, ce qui permet à Laravel de poursuivre le cycle habituel d'autorisation et d'exécuter la méthode de Policy appropriée (permettant ainsi à un auteur de modifier ou afficher ses propres articles).
