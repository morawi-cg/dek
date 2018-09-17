FROM ubuntu:bionic

LABEL version="1.0"
LABEL candidate="MoR"
LABEL description="This is a PHP and mysql application testing container "

# Setup non-interactive mode
ENV DEBIAN_FRONTEND noninteractive

# Create a variable that point at the work directory. Regarded as useful in general

# These can be replaced with what ever is most appropriate 

ENV DIRPATH /usr
ENV DIRNAME dek
ENV INPUTDIR dek/data/input
ENV OUTPUTDIR dek/data/output
# Install the gnu make tool

#run apt-get -yq update

# Install the gnu make tool

RUN apt-get -y install  build-essential

#sudo apt-get install build-essential cmake unzip pkg-config
 
# Install the curl script

RUN apt-get -y install  curl

# Installing the PHP based Repo

#RUN add-apt-repository ppa:ondrej/php

# Install the PHP echo-system as recuired by specification 
#RUN apt-get install php7.1 php7.1-json php7.1-xml

RUN apt-get install -y php7.2 php-json php-xml

# Install packages: mysql adds a root user with no password
# ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && \
  apt-get -y install mysql-server && \
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

# The command being executed from shell as specified by requirements

# example usage recommended: ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]

# create home dir onto which all central activities will happen

RUN mkdir /usr/dek

# Moving into the work directory
WORKDIR $DIRPATH/$DIRNAME

# add the essential comonents that this application will need to be built on

ADD  bind_0.cnf .
ADD  composer.json .
ADD  composer.lock  .
ADD  config  .
ADD  data .  
ADD  init.sh  .
ADD  Makefile .
ADD  migrations .
ADD  spec .
ADD  src .


# Every time its built .i.e this file is used it will need the migrations to be done as instructed.

ENTRYPOINT ["/usr/bin/make" "db-migrations"]

# This command would run as needed to be executed. Its put in the CMD format to avoid issues with shell in case its not there.
# Also so that one can override it at command execution of the container with the command thats after it for testing DB 

CMD ["php","src/console.php", "--inputDirectory=$INPUTDIR", "--outputDirectory=$OUTPUTDIR","deko:user-file-converter"]

# Testing purpose

CMD ["php","src/console.php","--inputDirectory=$INPUTDIR","deko:user-file-converter"]

