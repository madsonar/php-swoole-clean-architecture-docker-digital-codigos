# Definindo o 'init-script' para executar o script init-local.sh
USER := $(shell id -un)
UID := $(shell id -u)
GID := $(shell id -g)

init-script:
	@echo "Executando o script start..."
	@sh ./.docker/scripts/init-local.sh

up: init-script
	@echo "Iniciando o Docker Compose..."
	@docker-compose up

down: init-script
	@echo "Parando os contêineres do Docker Compose..."
	@docker-compose down

up-d: init-script
	@echo "Iniciando o Docker Compose em modo detached..."
	@docker-compose up -d

up-build: init-script
	@echo "Construindo as imagens do Docker Compose..."
	@echo "USER_ID: $(UID)"
	@echo "GROUP_ID: $(GID)"
	@echo "USER_NAME: $(USER)"
	@docker-compose build --build-arg UID=$(UID) --build-arg GID=$(GID) --build-arg USER=$(USER)
	@docker-compose up

tests:
	@echo "Executando os testes dentro do container PHP..."
	@docker-compose exec php vendor/bin/phpunit --coverage-text=php://stdout

cmd:
	@echo "Executando o comando dentro do container PHP..."
	@docker-compose exec php $(c)
	