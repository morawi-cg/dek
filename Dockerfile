FROM ubuntu:18.04

LABEL version="1.0.1"
LABEL candidate="MoR"
LABEL description="This is a PHP and mysql application testing container "
# Setup non-interactive mode
ENV DEBIAN_FRONTEND noninteractive

# create work directory

RUN mkdir /usr/dek


# Create a variable that point at the work directory. Regarded as useful in general

# These can be replaced with what ever is most appropriate 

ENV DIRPATH /usr
ENV DIRNAME dek
ENV INPUTDIR DIRPATH/DIRNAME/data/input
ENV OUTPUTDIR DIRPATH/DIRNAME/data/output
# Install the gnu make tool

RUN apt-get -yq update
RUN apt-get install -y bash
# Install the gnu make tool
#RUN apt-get install -y apt-utils # the install to stop error, later discovered not an effective method

RUN apt-get -y update # essential for the line below to work
RUN apt-get install -y  build-essential
RUN apt-get install -y gcc
RUN apt-get install -y make
RUN apt-get install -y software-properties-common # This will enable the special reposiory for PHP to work
RUN apt-get install -y git 
# this above was due to a dependency error that was detected during testing.
RUN apt-get install zip unzip
# Above line was a detected dependency, verified during testing.
#RUN apt-get install -y apt-utils # the install sent errors relating to this matter.
#sudo apt-get install build-essential cmake unzip pkg-config
 
# Install the curl script

RUN apt-get -y install  curl

# Installing the PHP based Repo

# RUN add-apt-repository ppa:ondrej/php # error faced and reflected in output from docker builder hence the line below

#RUN LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php

# Install the PHP echo-system as recuired by specification 
#RUN apt-get install php7.1 php7.1-json php7.1-xml

# Blank line below for ubuntu 16.04
#RUN apt-get install -y php7.2 php-json php-xml


# Blank line below for ubuntu 18.04
RUN apt-get install -y php7.2 php-json php-xml

# Install packages: mysql adds a root user with no password
# ENV DEBIAN_FRONTEND noninteractive

 
#RUN apt-get -y install mysql-server && \
  #rm -rf /var/lib/apt/lists/*
#RUN apt-get install -y mysql-server
# Change mysql to listen on 0.0.0.0
#ADD bind_0.cnf /etc/mysql/conf.d/bind_0.cnf

# setup our entry point
#ADD init.sh /init.sh
#RUN chmod 755 /*.sh
#ENTRYPOINT ["/init.sh"]

#EXPOSE 3306
#CMD ["mysqld_safe"]





# The command being executed from shell as specified by requirements

# The command being executed from shell as specified by requirements

# example usage recommended: ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]

# create home dir onto which all central activities will happen

#RUN mkdir /usr/dek

# Moving into the work directory
WORKDIR $DIRPATH/$DIRNAME

# add the essential comonents that this application will need to be built on

ADD  bind_0.cnf .
ADD  composer.json .
#ADD  composer.lock  .
ADD  config  .
ADD  data .  
ADD  Makefile .
ADD  migrations .
ADD  spec .
ADD  src .

RUN ["/usr/bin/make","init"]

CMD ["/usr/bin/python","print('Finished the PHP init update')"]
# Every time its built .i.e this file is used it will need the migrations to be done as instructed.

#ENTRYPOINT ["/usr/bin/make","db-migrations"]

# This command would run as needed to be executed. Its put in the CMD format to avoid issues with shell,(in case its not there).
# Also so that one can override it at command execution of the container with the command thats after it for testing DB 

#CMD ["/usr/bin/php","/usr/dek/src/console.php", "--inputDirectory=$INPUTDIR", "--outputDirectory=$OUTPUTDIR","deko:user-file-converter"]

# Testing purpose

#CMD ["/usr/bin/php","/usr/dek/src/console.php","--inputDirectory=$INPUTDIR","deko:user-file-converter"]

EXPOSE 8000
