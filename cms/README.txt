Structure de la base de données : 

La base de données contient 4 tables : 
Une pour les posts, qui contient le titre du post, le contenu et l’heure/date à laquelle il a été posté.
Une pour les tags, qui contient l’id du post (pour associer le post) et une pour le tag. 
Une seconde pour les tags, qui contient le nom du tag et l’heure/date à laquelle il a été posté. 
La dernière est celle qui contient les identifiants de l’utilisateur. Elle possède le mot de passe (crypté), le nom d’utilisateur et l’admin qui permet de reconnaître l’utilisateur qui se connecte.

Concept PHP : 

Pour ce blog, j’ai utilisé l’architecture Modèle Vue Contrôleur. 
Les vues sont toutes stockées dans un dossier et elles vont être affichées uniquement si le Contrôleur l’appel. 
Le Contrôleur joue donc un rôle d’intermédiaire entre les vues et le Modèle, qui lui permet de faire le lien avec la base de données. 
Pour faire plus simple, le Contrôleur appelle une vue et prend les données à afficher grâce au Model. 

Il a fallu créer aussi un routeur pour pouvoir créer les chemins pour le contrôleur. 

C’est plus compliqué à mettre en place, mais c’est beaucoup plus organisé et fluide. 

Certains éléments ne sont pas entièrement fonctionnels, je n’ai pas réussi à résoudre quelques problèmes dans les requêtes SQL.
Également, les tags ne fonctionnent pas, c’est ici que j’ai fais une erreur qui bloque mes requêtes. Cependant, toutes les routes sont accessibles, toutes les pages peuvent être visibles via les routes (panneau d’administration, Login…). 
