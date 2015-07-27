#!/usr/bin/env bash

block1="server {
    listen 80;
    server_name $1;
    root $2;

    index app_dev.php index.html index.htm info.php;

    charset utf-8;

    location / {
        try_files \$uri \$uri/ /app_dev.php?\$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    access_log off;
    error_log  /var/log/nginx/$1-error.log error;

    error_page 404 /index.php;

    sendfile off;

    location ~ ^/(app|app_dev|config|info)\.php(/|$) {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php5-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
"

block2="upstream phpfcgi {
    server 127.0.0.1:9000;
    # server unix:/var/run/php5-fpm.sock; #for PHP-FPM running on UNIX socket
}
server {
    listen 80;

    server_name $1;
    root $2;

    error_log /var/log/nginx/$1-error.log;

    # strip app.php/ prefix if it is present
    rewrite ^/app\.php/?(.*)$ /$1 permanent;

    location / {
        index app.php;
        try_files \$uri \$uri/ /app_dev.php?\$query_string;
    }

    location @rewriteapp {
        rewrite ^(.*)$ /app.php/$1 last;
    }

    # pass the PHP scripts to FastCGI server from upstream phpfcgi
    location ~ ^/(app|app_dev|config)\.php(/|$) {
        fastcgi_pass phpfcgi;
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include fastcgi_params;
    }
}"

echo "$block2" > "/etc/nginx/sites-available/$1"
ln -fs "/etc/nginx/sites-available/$1" "/etc/nginx/sites-enabled/$1"
service nginx restart
service php5-fpm restart
