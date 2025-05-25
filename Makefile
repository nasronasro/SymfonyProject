start:
	docker compose up -d --no-recreate --remove-orphans
build:
	docker compose up --build --force-recreate -d
stop:
	docker compose stop
enter: 
	docker compose exec symfony bash
delete:
	docker compose down
up: 
	docker compose up -d