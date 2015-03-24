# ci3-dt2
Codeigniter 3.0 integrated with Doctrine 2.5.0

Note that by the time when this version is writing, Codeigniter is at 3.0 rc3 and Doctrine ORM is at 2.4.7.

# Getting started
- config database on application/config/database.php
- run `php composer.phar update` to install required package(s)
- double check the database is up and running
- generate schemas using
  `vendor/bin/doctrine orm:schema-tool:create`
- to recreate your schemas
  `vendor/bin/doctrine orm:schema-tool:drop --force`
  `vendor/bin/doctrine orm:schema-tool:create`
- or force to update
  `vendor/bin/doctrine orm:schema-tool:update --force`
- checking results on http://localhost/{YOUR_PROJECT_DIR}/index.php


# Using models from other application
To use models from other app called `application`,
- we have an app with modles available in `applications/models`
- create new app with name admin: `admin.php` and app folder `admin`
- in `admin/config/autoload.php`, auto load library `doctrine`
- in `admin/config/autoload.php`, auto load package `application` with correct path
- free to use every models we have in `application` using Doctrine
