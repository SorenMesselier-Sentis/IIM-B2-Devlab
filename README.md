# "Pour l'amour de l'axe 🧡"

<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project 📁</a>
      <ul>
        <li><a href="#features">Features 📑</a></li>
      </ul>
    </li>
    <li>
      <a href="#Techs">Techs 💻</a>
    </li>
    <li><a href="#build-setup">Build Setup 🧑🏻‍💻</a></li>
    <li><a href="#contributors">Contributors 👥</a></li>
  </ol>
</details>

## About the project
This project was created in the context to build the best solution for all the students who are studying in coding digital and innovation just like us.
the objectiv ? make the best platform for them, to be able to manage there project in the best way has possible.
but did we did it actually ? 
let's find out ! 😮

### Features

- Register yourself on the webapp
- upload your projects on the platform
- get comments and feedback by all students and visitors with commentaries !
- get all the latest news about the tech world and the school !
- create yourself a profile and get reached out !
- and more to come ! 👀 

## Techs

- [Symfony](https://symfony.com/doc/current/index.html)
- [WebPack](https://symfony.com/doc/current/frontend.html#webpack-encore) symfony composer
- [EasyAdmin](https://symfony.com/bundles/EasyAdminBundle/current/index.html) symfony composer
- [Bootstrap](https://getbootstrap.com/docs/4.0/getting-started/introduction/) installed with EasyAdmin composer
- [Npm](https://docs.npmjs.com/) the latest LTS version
- [Sass](https://sass-lang.com/documentation) 1.51

## Build Setup

```bash
# install dependencies
$ composer install
$ npm install

# create your .env.local file and write it correctly
db_user : root
db_password : depends on your environment
db_name : it can be anything you want be fun !

# create your database
$ php bin/console doctrine:database:create
#or
$ php bin/console d:d:c

# load the migrations
$ php bin/console doctrine:migrations:migrate

# load the fixtures
$ php bin/console doctrine:fixtures:load -n

# enable sass loader
# in the webpack.config.js file, find this : 
//.enableSassLoader() and uncomment it

# then just run :     
$ npm run watch

# build for dev and launch server
$ symfony serve
$ npm run watch

```
## Contributors

- [Clément Duvivier](https://github.com/ClemOurs) also the author of this README 👋🏻
- [Soren Messelier](https://github.com/SorenMesselier-Sentis/)
- [Vincent Michel](https://github.com/CanarDev)
- [Antoine Bendafi-Schulmann](https://github.com/AntoineBendafiSchulmann)
- [Patrick Bartosik](https://github.com/GrandEmpereur/)
