# Simple Ticket 2

Projet basé sur Symfony 2.8

## installer un environnement de développement

### prérequis

Vous avez besoin de [Git](https://git-scm.com/), [Oracle VM VirtualBox](https://www.virtualbox.org/) et de [Vagrant by HashiCorp](https://www.vagrantup.com/) pour pouvoir installer un environnement de développement pour cette application.

### installer les fichiers

Lancer ces commandes :

```bash
git clone https://github.com/Mutualab/simpleticket2.git
cd simpleticket2
```

### configurer la machine virtuelle

Avant de poursuivre l'installation, vous devez choisir une adresse ip pour la machine virtuelle et un nom de domaine pour le site.
Par défaut, l'adresse ip est `192.168.33.14` et le nom de domaine est `simpleticket2.mutualab.dev`.

#### changer l'adresse ip

Pour changer l'adresse ip, modifiez la ligne 30 du fichier `Vagrantfile` situé à la racine du projet.

#### changer le nom de domaine

Pour changer le nom de domaine, modifiez la ligne 4 du fichier `provision/website.conf`.
Vous pouvez également activer un alias à la ligne 5.

### configurez votre poste de travail

Pour que votre poste de travail puisse retrouver la machine virtuelle avec le nom de domaine, vous devez ajouter la ligne suivante dans votre fichier `/etc/hosts` après l'avoir adapté à l'adresse ip et au nom de domaine que vous avez choisi :

```bash
192.168.33.14 simpleticket2.mutualab.dev
```

### installer la machine virtuelle

```bash
vagrant up
vagrant ssh
cd /var/www/website/
```

### installer composer

Note : il se peut que la méthode d'installation de composer change. Se référer à la page [Composer](https://getcomposer.org/download/) pour obtenir des informations à jour.

```bash
php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php
php -r "if (hash_file('SHA384', 'composer-setup.php') === '7228c001f88bee97506740ef0888240bd8a760b046ee16db8f4095c0d8d525f2367663f22a46b48d072c816e7fe19959') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

### configurer l'application

```bash
./composer.phar install
```

Composer demande des informations pour générer le fichier `app/config/parameters.yml`.
Seuls les champs `database_name`, `database_user` et `database_password` doivent être renseignés.
Les autres champs peuvent garder la valeur par défaut.

```bash
database_host (127.0.0.1):
database_port (null):
database_name (symfony): simpleticket2
database_user (root): simpleticket2
database_password (null): 123
mailer_transport (smtp):
mailer_host (127.0.0.1):
mailer_user (null):
mailer_password (null):
secret (ThisTokenIsNotSoSecretChangeIt):
```

### tester l'installation

Le lien [http://simpleticket2.mutualab.dev/app_dev.php/member/](http://simpleticket2.mutualab.dev/app_dev.php/member/) devrait ouvrir la page de liste des membres.

Si le lien fonctionne, l'installation est terminée.

## remettre les données à zéro

```bash
vagrant up
vagrant ssh
cd /var/www/website/
./reset-env.sh
```

## compiler les dépendances du front

```bash
cd web
bower install
npm run build
```

