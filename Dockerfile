FROM ubuntu:bionic
MAINTAINER MoR

ENV DEBIAN_FRONTEND noninteractive

run apt-get -yq update

# Install the gnu make tool

RUN apt-get -yq install  build-essential

#sudo apt-get install build-essential cmake unzip pkg-config
 
# Install the curl script

RUN apt-get -yq install  curl

# Installing the PHP based Repo

#RUN add-apt-repository ppa:ondrej/php

# Install the PHP echo-system as recuired by specification 
#RUN apt-get install php7.1 php7.1-json php7.1-xml
RUN apt-get install php7.1 php-json php-xml
# Install packages: mysql adds a root user with no password
# ENV DEBIAN_FRONTEND noninteractive
RUN apt-get update && \
  apt-get -yq install mysql-server && \
  rm -rf /var/lib/apt/lists/*

# Change mysql to listen on 0.0.0.0
ADD bind_0.cnf /etc/mysql/conf.d/bind_0.cnf

# setup our entry point
ADD init.sh /init.sh
RUN chmod 755 /*.sh
ENTRYPOINT ["/init.sh"]

EXPOSE 3306
CMD ["mysqld_safe"]





# The command being executed from shell as specified by requirements


ENTRYPOINT 
