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

## Menaces et sénarios d'attaque

//TODO, trouver bout de code à montrer

### Authentification

Plusieurs problème lié à l'authentification ont pu être identifié tel que : 

- Mots de passe circulant en clair
- Politique de mot de passe faible

Les sénarios d'attaque pour chacune de ces vulnérabilités sont les suivantes : 

- **Man in the middle.** Il est possible pour n'importe quel attaquant de récupérer le mot de passe pendant une authentification ou lors d'une création de compte si ils ont la possibilité de visualiser le traffic.
- **Brute-force** En aillant aucune politique de mot de passe, et aucun hachage, il est possible d'effectuer du brute-force sur l'api de connexion sans aucune limitation de vitesse (sauf celle du réseau) et il a de grande chance que les utilisateurs utilisent des mots de passe faible.
- **Dump de la base de donnée** Si un attaquant arrive à accéder à la base de donnée, il aura accès à tous les mot de passe du site.
- Il y en a plus, à voir.

### Accès aux ressources

Il a été identifié sur plusieurs page que les accès étaient bloqué pour le formulaire, mais il ne l'étaient pas lors de la vérification du formulaire. Donc il est possible de forger des requêtes sans passer par le processus d'authentification

## Contre-Mesure

### Authentification

Nous avons améliorer l'authentification du site avec un hashage de type b_crypt. Lors de la création d'un compte, le mot de passe sera hâché lors de la vérification de la validé de celui-ci. Ensuite, quand cet utilisateur souhaitera s'authentifier, son mot de passe sera hâché à nouveau pour comparer le résultat.

#### B-Crypt

Nous avons séléctionner cet algorithme pour la bonne raison qu'il est lent. Lors d'une attaque de brute-force, il faudra donc plus de temps pour essayer plusieurs combinaisons. 

#### Validité d'un mot de passe

Un mot de passe doit respecter les conditions suivantes

- Doit avoir un minimum de 8 charactère
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
