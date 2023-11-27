FROM httpd:latest

RUN apt-get update
RUN apt-get -y install vim wget curl 
##RUN a2enmod ssl



COPY ./server.key  /usr/local/apache2/conf/server.key
COPY ./server.crt  /usr/local/apache2/conf/server.crt
COPY ./httpd.conf /usr/local/apache2/conf/httpd.conf
COPY ./httpd-ssl.conf /usr/local/apache2/conf/extra/httpd-ssl.conf


#WORKDIR /var/www/html

EXPOSE 80
EXPOSE 443
