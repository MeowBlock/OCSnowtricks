
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/20405a4f24af429b900f9eaf70f58244)](https://app.codacy.com/gh/MeowBlock/OCSnowtricks/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)

# Snowtricks

This project is a collaborative blog about Snowboarding with articles and comments



## Installation

### Pre-requisites

in order to install my project you first need

- A webserver
- PHP version 8.1+
- Mysql version 8.0+
- Composer
- npm

#### What webserver do i use ?
I use Symfony's default webserver via Symfony CLI version 5.5.8, you can download Symfony's CLI [here](https://symfony.com/download)

#### How to install Composer
You may download and install the latest version of Composer [here](https://getcomposer.org/download/)

#### How to install npm
Follow this tutorial to download the latest version of node.js and npm (node package manager) [here](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm)

### Installation process

#### Download the files
download the files directly from github or clone the repository using 
```git clone https://github.com/MeowBlock/OCSnowtricks.git```

#### Install the Composer dependencies
Install the required librairies using Composer with the command ```composer install```

#### Install the npm dependencies
Install the required librairies using npm with the command ```npm install```

#### Set up the environment
you need to create a file named .env.local to set up the local environment variables.
the file must contain the same variables as the .env file - including DATABASE_URL

#### Import the database
Once you set up the DATABASE_URL variable to fit your local database you may import the database schema.
##### Import the schema
In order to import the database schema you have to use Doctrine.
Use the command ```php bin/console doctrine:migrations:migrate``` to import the latest migration.
##### Import the data
The project comes with a precompiled dataset. you may include it by importing the ```snowtricks.sql``` file contained at the root of the repository.

- using command line Mysql ```mysql -u username -p database_name < file.sql```

- using phpmyadmin by clicking ```Import``` in the header menu and submitting the file in the form

Alternatively you can get it by running the fixture script inside the project with the command ```php bin/console doctrine:fixtures:load```