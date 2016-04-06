# Simple Ticket 2

Projet basé sur Symfony 2.8

## installation d'un environnement de développement

```bash
composer install
vagrant up
vagrant ssh
cd /var/www/website/
./reset-env.sh
```

## compilation des dépendances du front

```bash
cd web
bower install
npm run build
```

