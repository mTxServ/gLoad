![gLoad Header](https://steamuserimages-a.akamaihd.net/ugc/963116903891754210/EEB4623A14D0CFDFA49B511B1118633EDE420CDC/)
# gLoad
**gLoad** is a *Garry's Mod* loading-screen designed with frontend developers in mind. The goal is to let developers create their own loading-screen in a super-easy way.

## What is it
Designed for frontend developers, **gLoad** is a *Garry's Mod* loading screen including a complete admin panel.
If you are a server owner, you'll appreciate it for its robustness. If you are a frontend developer, stop waiting and start creating a theme for **gLoad** ! 

## Installing
### Installing through `Docker` (dev only)
1. Clone the repository with Git : ``git clone https://github.com/Gabyfle/gLoad``
2. Init docker containers : ``make install``
3. Follow the installation instruction

### Installing through `Composer`
1. Clone the repository with Git : ``git clone https://github.com/Gabyfle/gLoad``
2. Create the autoloader with Composer : ``composer install``
3. Follow the installation instruction

### Installing a release
1. Download the latest release here : [gLoad/releases](https://github.com/Gabyfle/gLoad/releases)
2. Drag'n'drop the release in your web-host's server (can be done with any FTP client)
3. Follow the installation instruction

## Developers
Your are a developer and you wanted to know how **gLoad** theming is working ? See : [THEME_STRUCTURE.md](https://github.com/Gabyfle/gLoad/blob/master/themes/THEME_STRUCTURE.md) for more informations.

#### How does it works
Every theme is located in its own folder in  the `theme` folder. When the page is loaded, the PHP script get the theme's name in the `config.ini` file and load the theme located in  `themes/<theme-name>/`.

~~**gLoad** allows you to use built-in Javascripts functions to get data from *Garry's Mod*.~~

#### Using Docker in your environment
Start using `Docker` to start contributing to gLoad!

##### Installation

```
make install
```

##### Start

```
$ make start
```

##### Stop

```
$ make stop
```

##### List container

```
$ docker-compose ps
```

##### Useful commands

```
# Get mysql 
$ docker-compose exec mysql bash
$ mysql .. mtxserv < mtxserv.sql
```
```
# Get bash
$ docker-compose exec php bash
```
```
# Composer (e.g. composer update)
$ docker-compose exec php-cli composer update
```

## Credits

#### Front-end development
- [JQuery](https://jquery.com/) write less, do more.
- [popper.js](https://popper.js.org/) A kickass library used to manage poppers in web applications.
- [Bootstrap](https://getbootstrap.com) the world’s most popular front-end component library.


#### Back-end development
- [gSteam-Auth](https://github.com/Gabyfle/gSteam-Auth) An object oriented Steam authentication PHP library.
- [write_ini_file](https://gist.github.com/Gabyfle/3ea2a2ec1125f967fc06736c91d27df9) Write and modify a parameter in an ini file.
- [get_latest_release_name](https://gist.github.com/Gabyfle/3ea2a2ec1125f967fc06736c91d27df9) Gets the latest release (includes pre-releases) name (based on Tag names) of a Github-hosted repository.
- [composer](https://getcomposer.org/) Dependency Manager for PHP.

## License
This code is distributed free of charge under the [Apache 2.0 license](https://www.apache.org/licenses/LICENSE-2.0). The code is distributed "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND.  For more information, please visit [LICENSE](https://github.com/Gabyfle/gLoad/blob/master/LICENSE)
