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
To use models from other application,
- we have an application with modles available in applications/models
- create new application with name admin
- in the admin.php, define COMMON_MODEL_PATH
  `define('COMMON_MODEL_PATH', APPPATH.'../application/models/');`
- in admin/libraries/Doctrine.php, adjust ClassLoader with models path for application
- in admin/config/autoload.php, auto load library 'doctrine'
- free to use every models we have in application using Doctrine

Note that we can also autoload packages(can be set in admin/config/autoload.php),
but not sure how that would work with Doctrine.