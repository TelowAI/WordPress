# WordPress Base ![Boot Build](https://img.shields.io/badge/Build-0.0.4-green.svg)


### Requirements

* Node.js
* NPM (Node.js require for NPM) 
* PHP
* Docker

### Features

![Docker Build](https://img.shields.io/badge/Docker-00b6f0.svg)
![Bootstrap Build](https://img.shields.io/badge/Bootstrap-4.3.1-blue.svg)
![Babel Build](https://img.shields.io/badge/Babel-7.4.3-yellow.svg)
![Webpack Build](https://img.shields.io/badge/Webpack-4.29.6-9cf.svg)
![Webpack Dev Server Build](https://img.shields.io/badge/WebpackDevServer-4.2.1-9cf.svg)
![jQuery Build](https://img.shields.io/badge/jQuery-3.2.1-blue.svg)
![SCSS Build](https://img.shields.io/badge/SCSS-FFC0CB.svg)
![Next-Gen JS Build](https://img.shields.io/badge/NextGen-JS-yellow.svg)
![Timber Framework Build](https://img.shields.io/badge/Timber-54ffb9.svg)

# Table of Contents
1. [Get Started / Setup Enviroment](#get-started--setup-enviroment)
2. [Usage](#usage)
3. [SCSS Files](#scss-files)
4. [JS Files](#js-files)
5. [README-EDIT.md File](#js-files)
6. [Brand Guidelines](#brand-guidelines)
7. [Webpack Options](#webpack-options-webpackconfigjs)
8. [Writing Project Documentation](#writing-project-documentation)
9. [WordPress Base structure](#wordpress-base-structure)

---
## Get Started / Setup Enviroment
##### Create/Pull a copy of the WordPress-Base repository
```
git clone https://github.com/ncats/wordpress-base.git
```

##### Edit the theme `style.css` & `docker-compose.yml` files accordingly to the projects metadata.

- `style.css`: Replace all fields that are marked `--EDIT--`
- `docker-compose.yml`: Replace wordpress-cli options "--title" value to correspond with the projects title

##### Setup A Docker Container:
1. Locate to **/wordpress-base** folder from **Terminal** (example: `cd /Desktop/wordpress-base`)
2. Run the following command (docker must be installed on your machine):  
```
docker-compose up
``` 

##### Install project dependencies
1. Locate to **/wordpress-base/default** folder from **Terminal** (example: `cd /Desktop/wordpress-base/default`)
2. Run the following command ([node.js](https://nodejs.org/en/) must be installed on your machine): 
```
npm install or npm i
``` 

##### Activate Plugins in WP Admin
login to [localhost/wp-admin/](http://localhost/wp-admin/) and active all plugins. 

##### Visit [localhost](http://localhost:80) on your browser to confirm WordPress fron-end is running without any errors.

## Usage

### Development Mode
1. Locate to **/wordpress-base/default** folder from **Terminal** (example: `cd /Desktop/wordpress-base/default`)
2. Run the following command: 
```
npm start
``` 

This will open up your browser [localhost](http://localhost:).

**HOT RELOAD** 
(Everything is `--hot` reload, that means any changes made within `/default/` it will automatically be updated in your browser, no need to refresh)

### Building for QA (DEV) & Production
Run the following command from `/default/` folder to create optimized bundles.
```
npm run build
```

## SCSS Files
1. All custom styles should go under `src > scss > partials` partials folder. Example if we are creating a carousel element, the SCSS file structure will look as follow.

```
└──src                     
    ├── style.scss                     
    ├── scss                            # SCSS
    │   ├── partials                    # Create a SCSS file for your custom need. i.e example.scss
    |   |   └── _base.scss
    |   |   └── _custom.scss
    |   |   └── _carousel.scss <======= Carosuel Styles
    |   |   └── _fonts.scss
    |   |   └── _footer.scss
    |   |   └── _navigation.scss
    |   |   └── _variables.scss
```

2. Include your SCSS file in Entry point (**style.scss**):
```
@import './scss/partials/carousel'; 
```

## JS Files
1. All custom JS should go under `src > js` folder. Example if we are creating a carousel element, the JS file structure will look as follow.

```               
└──src
    └── js
        └── carousel.js <======= Carosuel Javascript
```

2. Include your JS file in Entry point (**index.js**):
```
import carousel from './js/carousel';
```

## README-EDIT.md File
We have provided a default README.md structure for everyone to follow. Please edit the fields as needed. Any item with `-- MESSAGE --` within the file require your attention.

* After completing the edit, please rename this file to `README.md` instead of `README-EDIT.md`.

## Brand Guidelines
All brand guidelines are stored in `src > scss > _variables.scss` into it's own section. variables start with client prefix, example: `$ncats_purple` to define purple color.

## Webpack Options (Webpack.config.babel.js)

### stats:
**errors:** `true` or `false` for error message          
**errorDetails:** `true` or `false` for error message and details     
**warnings:** `true` or `false` for Warnings        
### devServer
* writeToDisk - `true` to write files in build folder or `false` for in-memory file serving (WP need `true`)

* Proxy root (`*`):
    * **secure:** set to `true` or `false` for HTTPS/HTTP.
    * **target:** `http://localhost:80` by default, unless your using `3000` or `8080`.

## Writing Project Documentation
You can write documentation under `default > docs` folder. Use markdown language to write the document (using .md file extension).

## WordPress Base structure

```
.
├── webpack.config.babel.js             # Webpack configuration
├── docker-compose.yml                  # Docker Compose configuration
├── footer.php
├── 404.php
├── functions.php
├── header.php
├── index.php
├── single.php
├── search.php
├── .babelrc                            # Babel Preset File
├── package.json                        # Dependencies
├── page.php
├── images                              # Theme Images
│   ├── docs                            # WP User Guide Documentation Images
├── docs                                # Documentation Directory
├── views                               # Template/Views Directory
│   ├── tp   
    │   ├── header.twig                 # Header File using Twig
│   ├── base.twig                       
│   ├── index.twig                      
│   ├── single.twig     
├── admin                               # Admin Stuff 
│   ├── admin-style.css                 # Change Admin Styles   
├── templates                           # Create WordPress Themes in this folder.
│   ├── example.php                     # Example of Templates   
└──src
    ├── admin                           # Admin Assets Folder
    │   ├── scss                        # Create a SCSS file for your custom need on Admin (Back-end) Side
    │   ├── index.js                    # JS for Admin (Back-end) Side.
    ├── index.js                        # JS/Webpack entry point
    ├── style.scss                      # SCSS style entry point
    ├── scss                            # SCSS
    │   ├── partials                    # Create a SCSS file for your custom need. i.e example.scss
    |   |   └── _base.scss
    |   |   └── _custom.scss
    |   |   └── _fonts.scss
    |   |   └── _footer.scss
    |   |   └── _network_branding.scss
    |   |   └── _navigation.scss
    |   |   └── _variables.scss
    └── js
        └── app.js                      # Custom Theme Script
├── style.css                           # Style File that will be read by WordPress
```

