#!/bin/bash
docker stop sti_project || true && docker rm sti_project || true
docker run -ti -v "$PWD/site":/usr/share/nginx/ -d -p 8080:80 --name sti_project --hostname sti arubinst/sti:project2018

docker exec -u root sti_project service nginx start
docker exec -u root sti_project service php5-fpm start

docker cp ./www/html sti_project:/usr/share/nginx
docker cp ./www/databases sti_project:/usr/share/nginx

docker exec -u root sti_project bash -c 'chmod 777 /usr/share/nginx/databases/database.sqlite'
docker exec -u root sti_project bash -c 'chmod 777 /usr/share/nginx/databases'