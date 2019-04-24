FIG=docker-compose
EXEC=$(FIG) exec -T
CONSOLE=php app/console

.PHONY: help start stop build up reset config db-diff db-migrate vendor reload test assets

help:
	@echo "Please use \`make <target>' where <target> is one of"
	@echo "  reload   clear cache, reload database schema and load fixtures (only for dev environment)"

##
## Docker
##---------------------------------------------------------------------------

start:          ## Install and start the project
start: build up

stop:           ## Remove docker containers
	$(FIG) kill
	$(FIG) rm -v --force

reset:          ## Reset the whole project
reset: stop start

build:
	$(FIG) build

up:
	$(FIG) up -d

vendor:           ## Vendors
	$(EXEC) php composer install

config:        ## Init files required
	cp .env.dist .env
	cp config.ini.dist config.ini
	cp docker-compose.override.yml.dist docker-compose.override.yml

install:          ## Install the whole project
install: config start vendor
