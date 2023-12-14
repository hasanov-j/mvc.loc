##################################################
# 					Variabless
##################################################
DOCKER_COMPOSE = docker-compose -f docker-compose.yml

##################################################
# 				Docker compose
##################################################
init: down build up composer-install composer-init

build:
	${DOCKER_COMPOSE} build
down:
	${DOCKER_COMPOSE} down --remove-orphans
down-volumes:
	${DOCKER_COMPOSE} down --remove-orphans --volumes
up:
	${DOCKER_COMPOSE} up -d
restart:
	${DOCKER_COMPOSE} restart

##################################################
# 					App
##################################################
bash:
	${DOCKER_COMPOSE} run --rm mvc_loc_app bash

composer-install:
	${DOCKER_COMPOSE} run --rm mvc_loc_app composer install

composer-update:
	${DOCKER_COMPOSE} run --rm mvc_loc_app composer update

composer-init:
	${DOCKER_COMPOSE} run --rm mvc_loc_app composer p-init
websocket-conn:
	${DOCKER_COMPOSE} run --rm mvc_loc_app composer p-init
