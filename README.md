# STI-Projet2

## Structure du rapport
- Introduction
- Décrire le système
- Identifier les sources de menaces
- Identifier les scénarios d'attaques
- Identifier les contre-mesures
- Conclusion

## Securité à implémenter

Seulement au niveau applicatif (consigne)

1. Authentification : 4h (Choix crypto ) **Axel**
2. Sanitazer (éviter insertion de code, Injections XSS ? ) : 6h **Noémie**
3. Éviter injection SQL 2h **Noémie**
4. Vérifier accès aux ressource 2h **Axel**
5. Erreurs logiques 3h **Axel**
7. Add more here if needed

## Contre-Mesure

### Authentification

Nous avons amélioré l'authentification du site avec l'algorithme de hachage `b_crypt`. Lors de la création d'un compte, le mot de passe sera haché lors de la vérification de la validé de celui-ci. Ensuite, quand cet utilisateur souhaitera s'authentifier, let mot de passe entré sera haché à nouveau, puis les deux seront comparés.

#### B-Crypt

Nous avons séléctionné cet algorithme pour la bonne raison qu'il est lent. Lors d'une attaque de brute-force, il faudra donc plus de temps pour essayer plusieurs combinaisons. De plus, il s'agit de l'algorithme recommandé par PHP.

#### Validité d'un mot de passe

Un mot de passe doit respecter les conditions suivantes

- Doit avoir un minimum de 8 charactères
- Doit avoir au moins un nombre
- Doit avoir au moins une majuscule
- Doit avoir au moins une minuscule
- Doit avoir au moins un charactère spécial (#?!@$%^&*-)

Cette combinaison est suffisante pour avoir une authentification à unique facteur suffistante.

### Autorisation

Afin de valider au mieux les autorisations pour les différentes ressource disponible sur le site, nous avons centralisé les fonctions d'accès dans une unique classe, afin de gérer d'un seul côté tous les accès. Il suffit avec ce genre de méthodologie d'appeler les différentes fonctions d'accès sur chacune des pages, de la manière suivantes :

```php
include_once "classes/AccessControl.php"; //ajout de la classe qui gère les autorisations
AccessControl::connectionVerification("index.php?error=401"); //vérification de l'authentification
AccessControl::adminVerification("messagerie.php?error=403"); //vérification de l'autorisation
```

Il est donc facile de vérifier sur le début de chaque fichier que tout est bien mis en place.

De plus, nous avons rajouté dans `messagerie.php` et dans `detailsMessage.php` des conditions supplémentaire évitant un utilisateur malveillant de voir ou supprimer des message destiné à quelqu'un d'autre.

### Injection de script (XSS)

Afin d'éviter qu'un utilisateur puisse injecter un script malveillant, il a fallu mettre en place une protection. Cette protection est très simple à mettre en place, et il suffit d'encoder à l'affichage tout ce qui pourrait venir d'un utilisateur. Afin de faire cela, nous avons simplement appelé la méthode `htmlspecialchars()` qui va convertir les caractères qui permettent un script malveillant d'être exécuté.

```php
return htmlspecialchars($content, ENT_QUOTES, "UTF-8");
```

Ceci va effectuer les remplacements de caractères comme si-dessous, afin qu'ils ne soient plus interprété comme du code exécutable.

| Caractère               | Remplacement |
| :---------------------- | :----------- |
| `&` (ET commercial)     | `&amp;`      |
| `"` (double guillement) | `&quot;`     |
| `'` (simple guillemet)  | `&#039;`     |
| `<` (inférieur à)       | `&lt;`       |
| `>` (supérieur à)       | `&gt;`       |

https://www.php.net/manual/fr/function.htmlspecialchars.php

Nous n'avons pas modifier les entrées utilisateurs pour deux raisons : 

- La première est qu'en cas de modification dans la source de donnée, cette protection ne servirait à rien
- La deuxième est que cela modifierait les données entrées pas l'utilisateur. Exemple : si un utilisateur crée un mot de passe avec le caractère `>`, alors celui-ci ne doit pas être changé en `&gt;`. Cela ne changerait rien à l'utilisateur, mais pourrait être contre productif en cas d'analyse des données, ou autres.

### CSRF

Afin d'empêcher le genre d'attaque pour forcer une action à un utilisateur, la solution qui a été mise en place a été l'utilisation d'un token anti-CSRF. 

La solution définie est que lors de chaque visite d'une page contenant un formulaire, un token CSRF sera géré du côté du serveur, envoyée au client, puis pour finir inclus et caché dans le formulaire que l'utilisateur peut envoyer. Si cet utilisateur envoie ce formulaire, alors le token sera lui-même inclus et sera vérifié lors de la vérification des données reçues par le serveur.

Le token est généré lors de chaque visite sur un formulaire, afin que lors de chaque envoie de formulaire, afin que le token précédent ne soit plus valide. 



