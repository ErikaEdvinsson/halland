# Halland 🍲

Halland is a Wordpress theme built by Region Halland, based on [Sage](https://github.com/roots/sage).

<details><summary>
View theme structure
</summary>
<p>


```shell
themes/halland/           # → Root
├── app/                  # → Theme PHP
│   ├── Acf/              # → ACF Fields
│   ├── controllers/      # → Controller files
│   ├── Theme/            # → Enqueue files, register sidebars
│   ├── Traits/           # → Traits used in the theme
│   ├── admin.php         # → Theme customizer setup
│   ├── filters.php       # → Theme filters
│   ├── helpers.php       # → Helper functions
│   └── setup.php         # → Theme setup
├── composer.json         # → Autoloading for `app/` files
├── composer.lock         # → Composer lock file (never edit)
├── dist/                 # → Built theme assets (never edit)
├── node_modules/         # → Node.js packages (never edit)
├── package.json          # → Node.js dependencies and scripts
├── resources/            # → Theme assets and templates
│   ├── assets/           # → Front-end assets
│   │   ├── config.json   # → Settings for compiled assets
│   │   ├── build/        # → Webpack and ESLint config
│   │   ├── fonts/        # → Theme fonts
│   │   ├── images/       # → Theme images
│   │   ├── scripts/      # → Theme JS
│   │   └── styles/       # → Theme stylesheets
│   ├── functions.php     # → Composer autoloader, theme includes
│   ├── index.php         # → Never manually edit
│   ├── screenshot.png    # → Theme screenshot for WP admin
│   ├── style.css         # → Theme meta information
│   └── views/            # → Theme templates
│       ├── layouts/      # → Base templates
│       └── partials/     # → Partial templates
└── vendor/               # → Composer packages (never edit)
```
<p>
</details>

## Requirements

* [WordPress](https://wordpress.org/) >= 4.7
* [PHP](http://php.net/manual/en/install.php) >= 7.0
* [Composer](https://getcomposer.org/download/)
* [Node.js](http://nodejs.org/) >= 6.9.x
* [Yarn](https://yarnpkg.com/en/docs/install)

## Getting started
1. Clone Halland into the themes directory of [your Wordpress installation](https://github.com/RegionHalland/wordpress-example) and install dependencies:
```sh
$ cd <your site>/web/app/themes/
$ git clone https://github.com/RegionHalland/halland.git
$ cd halland
```

2. This theme requires ACF Pro. Rename `.env.example` to `.env` and add your key. If you don't have a key, ask someone involved in the project (.. or [buy one here](https://www.advancedcustomfields.com/pro/#pricing-table)):
```sh
$ mv .env.example .env
```

3. Install dependencies.
```sh
$ composer install && yarn
```

4. Update `resources/assets/config.json` settings:
- `devUrl` should reflect your local development hostname, for example `http://site.test`
- `publicPath` should reflect your WordPress directory structure (`/web/app/themes/halland` or `/wp-content/themes/halland` for non-[Bedrock](https://roots.io/bedrock/) installs)

5. Build commands
* `yarn start` — Compile assets when file changes are made, start Browsersync session
* `yarn build` — Compile and optimize the files in your assets directory
* `yarn build:production` — Compile assets for production

## Styleguide

Almost all of the CSS on the front-end is defined in our [styleguide](https://github.com/regionhalland/styleguide). Halland uses it by looking for the environment variable `COMPONENT_LIBRARY_URI`. If the variable can't be found, Halland defaults to the styleguide published on [Github Pages](https://regionhalland.github.io/styleguide).

If you want to work with CSS, set up up a local version of the styleguide by [following the instructions in it's repo](https://github.com/regionhalland/styleguide) and make your changes there.

### CORS

Allow requests to your local version of the styleguide by adding the following headers to it's nginx config: 

1. SSH into your Homestead server and edit the styleguides nginx config:
```sh
$ cd ~/Homestead
$ homestead ssh
$ sudo nano /etc/nginx/sites-enabled/styleguide.test
```

2. Place the headers in the server block of the nginx config:
```nginx
# Allow CORS
add_header 'Access-Control-Allow-Origin' '*' always;
add_header 'Access-Control-Allow-Credentials' 'true' always;
add_header 'Access-Control-Allow-Methods' 'GET, POST, PUT, DELETE, OPTIONS' always;
add_header 'Access-Control-Allow-Headers' 'Accept,Authorization,Cache-Control,Content-Type,DNT,If-Modified-Since,Keep-Alive,Origin,User-Agent,X-Requested-With' always;
```

3. Reload the nginx config.
```sh
$ sudo service nginx reload
```

## ACF Fields

Halland uses [Advanced Custom Fields](https://www.advancedcustomfields.com/) to create custom fields and [ACF Export Manager](https://github.com/helsingborg-stad/acf-export-manager/) to save the field definitions as `.php` and `.json` files, so that we can keep them under version control.



### Importing

The field definitions are imported automatically with [ACF Export Manager](https://github.com/helsingborg-stad/acf-export-manager/). The export manager will automatically import all field groups defined in [`/halland/Acf/Import.php`](https://github.com/RegionHalland/halland/blob/master/app/Acf/Import.php#L17).

To be imported, they must first be exported by following the instructions below. ⤵️

### Exporting

1. Create your field group in the Wordpress admin panel like you normally would under **Fields → Add new**.

2. Over the **Save / Publish** button to the right, you will find your field groups unique ID. It looks something like `group_5b716c7b279da`. Copy the field groups ID and add it to the array defined in [`/halland/Acf/Import.php`](https://github.com/RegionHalland/halland/blob/master/app/Acf/Import.php#L17):
```php
$acfExportManager->autoExport(array(
	...
	...
	'my-new-fieldgroup' => 'group_5b716c7b279da'
));
```

3. **Save / Publish** your field group and ACF Export Manager will create a `.php` and a `.json` file for your new field group in each respective folder. Make sure to commit these files.


### Editing existing field groups

1. First of you need to identify the filename of the field group you want to edit. The easiest way to do this is probably to look at the key-value pairs found in the import array in [`/halland/Acf/Import.php`](https://github.com/RegionHalland/halland/blob/master/app/Acf/Import.php#L17).

2. For minor changes you can edit the field groups directly in code. Remember to edit **both** the `.json` and the `.php` files found in `/halland/Acf/<json or php>/my-new-field-group.<json or php>`.

3. For bigger changes you might want to use the admin panels interface. Go to **Fields → Tools** and import your field groups `.json` file (found in `/halland/Acf/json/my-new-field-group.json`).

4. Edit your field group. When you **Save / Publish**, the changes will automatically be exported to code. Commit your changes! 🤓 


## Child themes

TBD
