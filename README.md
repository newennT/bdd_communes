# Communes de Bretagne

## Description

This project lists all the communes of Brittany as well as their name in Gallo and Breton and indicates in which province and which traditional country they are located. A map allows to display the communes, to filter them and to access their individual page. The project also presents the list of provinces and the list of countries.


## FRONT

- [Twig](https://twig.symfony.com) : Template engine or PHP
- [Sass](https://sass-lang.com) : CSS extension language
- [Bootstrap](https://getbootstrap.com) : CSS framework
- [OpenStreetMaps](https://leafletjs.com/) : map API
- [MySQL](https://www.mysql.com) : Database language


## BACK

- [PHP 7.4](https://www.php.net) : Language
- [Symfony 7](https://symfony.com) : Framework based on [symfony-docker](https://github.com/dunglas/symfony-docker/tree/main)
- [Composer](https://getcomposer.org/) : Dependency manager por PHP


## Versions

Version 1.0.0


## Install

1. [Install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run `docker compose build --no-cache` to build fresh images
3. Run `docker compose up --pull always -d --wait` to set up and start a fresh Symfony project
4. Open `https://localhost` in your web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
5. Run `docker compose down --remove-orphans` to stop the Docker containers.


## Structure

The project uses an MVC type structure using POO.


### Main routes

- Home page : `/`
- Admin space (protected by a middleware): `/admin`
- "Communes" space: `/commune`
- "Province" space: `/province`
- "Pays" space: `/pays`


#### CRUD gestion

For each main route there are different actions:
- index: show all
- show: show one (selected by ID)
- new (protected by a middleware): add or edit one
- delete (protected by a middleware): delete one


### Controllers

Controllers respond to requests by distributing routes and applying necessary restrictions on admin spaces. They all inherit from AbstractController. Those at the root of /Controller distribute routes visible to all visitors, and those contained in Controller\Admin distribute routes visible to admins.



### Views

Views are contained in src\templates.


### Entities

Entities describe how entities work and communicate with the database via Doctrine.