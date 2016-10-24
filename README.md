# [BigUniverse](https://biguniverse.ru/)

BigUniverse is a WordPress-based astronomy news website.

**BigUniverse 3 is in active development and is currently in alpha. The `master` branch tracks BigUniverse 3 development. The website production enironment is still uses [BigUniverse 2 release](https://github.com/rslnk/biguniverse/releases).**

## Features

* Dependency management with [Composer](https://getcomposer.org)
* Environment variables with [Dotenv](https://github.com/vlucas/phpdotenv)
* Autoloader for mu-plugins (use regular plugins as mu-plugins)
* Enhanced security (separated web root and secure passwords with [wp-password-bcrypt](https://github.com/roots/wp-password-bcrypt))
* Stylus for stylesheets
* [Jeet](https://jeet.gs), [Rupture](https://github.com/jescalan/rupture), [Kouto-Swiss](http://kouto-swiss.io/) front-end tools
* ES6 for JavaScript
* [Webpack](https://webpack.github.io/) for compiling assets, optimizing images, and concatenating and minifying files
* [BrowserSync](http://www.browsersync.io/) for synchronized browser testing
* Template inheritance with the [`Sage` theme wrapper](https://roots.io/sage/docs/theme-wrapper/)

## Requirements

Make sure all dependencies have been installed before moving on:

* [PHP](http://php.net/manual/en/install.php) >= 5.6
* [Composer](https://getcomposer.org/download/)
* [Node.js](http://nodejs.org/) >= 4.5

## Project structure

BigUniverse website utilizes [Bedrock project organization](https://github.com/roots/bedrock/wiki/Folder-structure),
which is similar to putting WordPress in its own subdirectory:

-   All required files are stored in `web/` directory including the vendor'd `wp/` source, and the `wp-content` source.
-   `wp-content` has been named `app` to better reflect its contents.
-   `wp-config.php` remains in the `web/` because it's required by WordPress, but it only acts as a loader. The actual configuration files have been moved to `config/` for better separation.
-   `vendor/` is where the Composer managed dependencies are installed to.
-   `wp/` is where the WordPress core lives.

```shell
site/
├── composer.json
├── config/
│   ├── application.php
│   └── environments/
│       ├── development.php
│       ├── staging.php
│       └── production.php
├── vendor/
└── web/
    ├── app/
    │   ├── mu-plugins/
    │   ├── plugins/
    │   └── themes/
    ├── media/
    ├── index.php
    ├── wp-config.php
    └── wp/
```

Note: `config/application.php` is the main config file that contains what
`wp-config.php` usually would. Base options are set in there.

## Theme structure

```shell
themes/cosmos/            # → Theme root
├── assets                # → Front-end assets
│   ├── config.json       # → Settings for compiled assets
│   ├── build/            # → Webpack and ESLint config
│   ├── fonts/            # → Theme fonts
│   ├── images/           # → Theme images
│   ├── scripts/          # → Theme JS
│   └── styles/           # → Theme stylesheets
├── composer.json         # → Autoloading for `src/` files
├── composer.lock         # → Composer lock file (never edit)
├── dist/                 # → Built theme assets (never edit)
├── functions.php         # → Composer autoloader, theme includes
├── index.php             # → Never manually edit
├── node_modules/         # → Node.js packages (never edit)
├── package.json          # → Node.js dependencies and scripts
├── screenshot.png        # → Theme screenshot for WP admin
├── src/                  # → Theme PHP
│   ├── lib/Sage/         # → Theme wrapper, asset manifest
│   ├── admin.php         # → Theme customizer setup
│   ├── filters.php       # → Theme filters
│   ├── helpers.php       # → Helper functions
│   └── setup.php         # → Theme setup
├── style.css             # → Theme meta information
├── templates/            # → Theme templates
│   ├── layouts/          # → Base templates
│   └── partials/         # → Partial templates
└── vendor/               # → Composer packages (never edit)
```

## Theme setup

Edit `src/setup.php` to enable or disable theme features, setup navigation menus, post thumbnail sizes, post formats, and sidebars.

## Theme development

BigUniverse uses [Webpack](https://webpack.github.io/) as a build tool and [npm](https://www.npmjs.com/) to manage front-end packages.

### Install dependencies

From the command line on your host machine (not on your Vagrant development box), navigate to the theme directory then run `npm install`:

```shell
# @ example.com/site/web/app/themes/your-theme-name
$ npm install
```

You now have all the necessary dependencies to run the build process.

### Build commands

* `npm start` — Compile assets when file changes are made, start BrowserSync session
* `npm run build` — Compile and optimize the files in your assets directory
* `npm run build:production` — Compile assets for production

#### Additional commands

* `npm run clean` — Remove your `dist/` folder
* `npm run lint` — Run eslint against your assets and build scripts
* `composer test` — Check your PHP for code smells with `phpmd` and PSR-2 compliance with `phpcs`
