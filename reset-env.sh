#!/bin/bash

default_environment="dev"

if [ "$1" == "dev" ] || [ "$1" == "prod" ]; then
	environment="$1"
else
	environment="$default_environment"
fi

echo "environment: $environment"

php app/console doctrine:schema:drop --force --env=$environment
php app/console doctrine:schema:create --env=$environment
php app/console hautelook_alice:doctrine:fixtures:load -n --env=$environment

