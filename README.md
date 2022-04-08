# PSPA

[![License: MIT](https://img.shields.io/badge/License-MIT-brightgreen.svg)](https://opensource.org/licenses/MIT)

PHP-SPA (PSPA) is a lightweight PHP framework and a foundation for building your own framework. It does not compete with
other out-of-the-box PHP frameworks such as Yii2 or Laravel because it doesn't have a full list of out-of-the-box tools
for specific tasks, instead it only has basic SPA functionality, PJAX, PSR-4 autoloading (via composer) and some basic
tools for general tasks.

You may notice that the directory [`/core`](#_rootcore_), which is the PSPA core, is located directly in the files, so
this means that it's not just read-only files, you can improve, replace, add new features right there. You can use the
standard build or create your own framework by adding different tools to the core.

## Instalation

It's not a package, so you can just clone it or download it raw.

### Download

`git clone https://github.com/khasandesign/pspa.git` or download raw.

---

## Usage

Using PSPA is fairly straightforward. Similar to other popular PHP frameworks, but much simpler.

### Apache setup

Configure the Apache server the way you want, PSPA has no "mandatory" rules. Here is an example for XAMPP. Replace
DocumentRoot to your path and change the domain name.

```
<VirtualHost *:80>
    ServerAdmin webmaster@khasan.com
    DocumentRoot "/opt/lampp/htdocs/projects/projectName"
    ServerName yourdomain.test
    ErrorLog "logs/yourdomain.test-error_log"
    CustomLog "logs/yourdomain.test-access_log" common
</VirtualHost>
```

In fact, you can set it up on any other web server, as already mentioned: no special or extraordinary rules, just follow
your own practices.

### Change host

According to the web server settings, you also need to change the host.

- Windows: `c:\Windows\System32\Drivers\etc\hosts`
- Linux or MacOS: `/etc/hosts`

Add the following rule to it (you can have different localhost IP address):

```
127.0.0.1       yourdomain.test
```

### PSR-4 Autoload

It does not include third-party packages, it only has PSR-4 autoload for classes.

`composer i`

`composer dump-autoload -o`

---

- Minimum required PHP version of PSPA is PHP 5.6.
- It works best with PHP 7.

## Documentation

PSPA has no special documentation rules or anything like that, so all you have to take into account is the file
structure. PSPA implements the MVC architecture, so if you have experience with Yii2 or Laravel, consider that you
already know PSPA. If you don't know about MVC, look it
up: [Model-View-Controller](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller).

---

### _Root_

The root `/` directory follows basic MVC practices and is completely free to expand.

    .
    ├── assets                 # Asset bundles with css/js/depencies config
    ├── config                 # Configuration files (e.g. database connection)
    ├── controllers            # Controllers from MVC
    ├── core                   # PSPA core with all prepared tools
    ├── models                 # Models from MVC (Empty)
    ├── vendor                 # Composer packages
    ├── views                  # Views from MVC
    ├── web                    # Asset files, layouts and index.php
    └── ...

### _Root/web_

The `/web` directory contains the index.php file; All asset files are separated by asset packages names; Application
layouts.

The directories of each asset package are non-structured, which means that you can arrange the asset files however you
like.

    .
    ├── ...
    ├── web                    
    │   ├── assets             # Assets files linked from asset bundles
    │   │   └── base           # Folder named according to asset bundle's name
    │   │       └── ...        # Asset files (.css, .js, fonts, etc.)
    │   ├── layouts            # Application layouts
    │   │   └── base.php       # Base layout
    │   └── index.php
    └── ...

### _Root/config_

The `/config` directory contains all configuration files used in the application. The first you have to do after
installing the PSPA is to check `/config/main.php`, because it has quite important configurations that affect the whole
project.

    .
    ├── ...
    ├── config
    │   ├── db.php            # Connection to Database using PDO
    │   └── main.php          # The project configuration file
    └── ...

### _Root/core_

The `/core` directory contains all the core functionality. It is not packaged separately (as most popular PHP
frameworks) because the PSPA is the foundation for creating your own framework, so after adding various tools you can
brand it for yourself or your project.

Feel free to expand `/core` with other folders to categorize instruments.
Follow [PSR-4 practices](https://www.php-fig.org/psr/psr-4/) when creating new classes.

    .
    ├── ...
    ├── core                   
    │   ├── assets             # Assets working classes
    │   ├── exceptions         # Exception classes (Exception chain)
    │   └── mvc                # MVC base classes
    └── ...

### _Root/views_

The `/views` directory contains folders named according to their controllers. The view files are named according to the
actions in its controller.

E.g. **Base**Controller.php (action**Index**) –> /views/**base**/**index**.php

    .
    ├── ...
    ├── controllers              
    │   └── BaseController.php   # Controller class
    ├── ...
    ├── views                    
    │   └── base                 # Folder attached to BaseController.php
    │       └── index.php        # View file of index action from BaseController.php
    └── ...

---

## Contribution

I'm not greedy enough to ask you to donate to such a young product. The best thing you can do is to share your thoughts
if you know how to improve it or distribute it better.

Optional: I would be happy if you would post Powered by budget in the Readme if you used PSPA for your project. Simply
copy the code below into your Readme.

```
[![PSPA](https://img.shields.io/badge/Thanks%20to-PSPA-brightgreen)](https://github.com/khasandesign/pspa)
```

You will see:

[![PSPA](https://img.shields.io/badge/Thanks%20to-PSPA-blue)](https://github.com/khasandesign/pspa)