all: install

install:
	docker-compose up -d
	docker exec -ti alcalyn-php sh -c "composer install"
	docker exec -ti alcalyn-database sh -c "mysql -u root -proot -e 'create database if not exists ratchet;USE ratchet;CREATE TABLE IF NOT EXISTS sessions (sess_id varchar(255) NOT NULL, sess_data text NOT NULL, sess_time int(11) NOT NULL, sess_lifetime int(11) NOT NULL, PRIMARY KEY (sess_id)) ENGINE=InnoDB DEFAULT CHARSET=utf8;'"

update:
	docker-compose up --build --force-recreate -d
	docker exec -ti alcalyn-php sh -c "composer update"

logs:
	docker-compose logs -ft

bash:
	docker exec -ti alcalyn-php bash

restart_websocket_server:
	docker restart alcalyn-ws
