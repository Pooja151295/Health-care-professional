FROM nginx:1.25

RUN sed -i -e 's/user www-data;/user www;/g' /etc/nginx/nginx.conf

RUN sed -i -e 's/user nginx;/user root;/g' /etc/nginx/nginx.conf

COPY . /var/www/api

COPY ./docker/nginx/conf.d/www.conf /etc/nginx/conf.d/default.conf
