# STI - Application de messagerie sécurisée

Auteurs : Axel Vallon et Lev Pozniakoff

Modifications sécuritaires : Axel Vallon et Noémie Plancherel

Date : 20.01.2022

## Sécurité

Ce site internet est une amélioration d'un site web non sécurisé, le tout construit sans plugin et basé uniquement sur PHP, JavaScript et HTML. Un rapport contenant l'analyse des menaces et les contre-mesures est disponible dans ce repository.

## Manuel d'installation

Pour déployer le site de messagerie, il suffit de d'exécuter le script `./script.sh` situé à la racine de ce repository git tout en aillant Docker allumé. Cette procédure vous permettra si le port 8080 est accessible d'accéder au site via l'adresse http://localhost:8080. Cette installation est fonctionnelle avec Windows mais devrait aussi l'être avec Linux.

## Manuel d'utilisation

Les fonctionnalités ce ce site sont accordées au cahier des charges qui nous a été délivré et présenté lors du cours STI à la HEIG-VD en 2021. 

### Page de connexion

Pour vous connecter, il suffit de rentrer vos identifiants demandés. Par défaut, il existe un compte administrateur `admin` ayant pour mot de passe `Admin$2021` et un utilisateur collaborateur `user` ayant pour mot de passe `User$2021`.

![image-20211012103104447](figures/image-20211012103104447.png)

### Envoyer un message

Dès que vous être connecté, vous verrez une barre de navigation qui vous permettra de sélectionner `Envoyer un message`. Ceci effectué, vous pouvez rédiger votre message et l'envoyer.

![image-20211012103204163](figures/image-20211012103204163.png)

### Répondre à un message

Dans votre liste de message (Ou Boîte de réception), vous pouvez répondre à un message.

![image-20211012103346595](figures/image-20211012103346595.png)

Vous aurez alors un nouvelle interface qui vous permettra d'envoyer un message au même destinataire avec le même sujet.

![image-20211012103444138](figures/image-20211012103444138.png)

### Détails d'un message

Dans votre liste de message, vous pouvez visualiser le corps d'un message qui n'est pas pas visible sur la liste des message

![image-20211012103631748](figures/image-20211012103631748.png)

![image-20211012103653555](figures/image-20211012103653555.png)

### Changement de mot de passe

Vous avez la possibilité de modifier votre mot de passe en insérant deux fois le même nouveau mot passe en accédant à l'onglet `Changement de mot de passe` dans la barre de navigation.

![image-20211012103851082](figures/image-20211012103851082.png)

### Administrateur

Il y a deux types de compte : "Collaborateur" et "Modérateur". En vous connectant en temps que modérateur, vous aurez les même droits qu'un collaborateur en plus la gestion des utilisateurs (modification, création, suppression). La barre de navigation contient donc plus de fonctionnalités que pour un collaborateur normal.

![image-20211012104304770](figures/image-20211012104304770.png)

#### modifier les utilisateurs

Pour modifier un utilisateur, il faut vous rendre dans liste des utilisateurs dans la barre de navigation

![image-20211012104336364](figures/image-20211012104336364.png)

Ensuite, sélectionnez le champs de l'utilisateur que vous souhaitez modifier (sauf le Login qui n'est pas modifiable) et cliquez sur le bouton `Update` qui permettra d'effectuer ces modifications. Vous avez aussi la possibilité de supprimer un utilisateur dans cette liste.

#### Admin : Créer un utilisateur

Vous pouvez en tant que Administrateur créer n'importe quel type de compte, au temps un administrateur qu'un compte inactif (un utilisateur ne pourra pas se connecter sur un compte inactif)

![image-20211012104723844](figures/image-20211012104723844.png)

