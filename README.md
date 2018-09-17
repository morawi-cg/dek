#docker-ubuntu-mysql
Dedicated PHP 7.2 & Mysql container, intended for application testing by MoR.
 
## About

This PHP/Mysql container is based on ubuntu:bionic, and has the following in addition:
This container application will runt the code that will extract data from input files and inject into MysqlDB, it can then be directed to an output file.
The output file will be an operation that is implemented via a specific script.
* curl
* Make
* PHP 7.2
* PHP XML
* PHP JSON
* mysql-server
* Listens on 0.0.0.0 instead of the default 127.0.0.1
* Port 3306 is exposed, in case you are not linking containers
* Allows for a root password to be set when run for the first time

## Example

### Running

Simple, not exposed,(mysql-element):


```shell
docker run -d --name="mysql-run" \
    -e "MYSQL_PASSWORD=password" \
    vasansr/ubuntu-mysql
```

Exposed: 

```shell
docker run -d --name="mysql-run" \
    -e "MYSQL_PASSWORD=password" \
    -p 3306:3306 \
    vasansr/ubuntu-mysql
```

Explanation:

* -d : Run daemonized
* --name : The name of the container
* -e MYSQL_PASSWORD : To set the root password for connecting from other containers/hosts. Change password to the password that you want to set. Use a strong password if you are exposing the container using -p
* -p : expose port 3306 as port 3306 on the host
* https://github.com/morawi-cg/dek
* To run the code, please use the console provided for your convenience:
```
php src/console.php --inputDirectory=<directory> --outputDirectory=<directory> deko:user-file-converter
```
* Where 'inputDirectory' is the location of the input files, and 'outputDirectory' 
* is where you want the result to be generated.

* The application is currently configured to write the results into MySql.
* The appropriate command to use would be:

```
php src/console.php --inputDirectory=data/input deko:user-file-converter
```

*  Running migrations

*  In order for this application to work in a new environment, there is a migration that prepares the database table

To run the migration:
```
make db-migrations
```

