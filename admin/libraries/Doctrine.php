<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Doctrine\Common\ClassLoader,
  Doctrine\ORM\Configuration,
  Doctrine\ORM\EntityManager,
  Doctrine\Common\Cache\ArrayCache,
  Doctrine\DBAL\Logging\EchoSQLLogger,
  Doctrine\Common\Cache\ApcCache;

class Doctrine {

  public $em = null;

  public function __construct()
  {
    // load database configuration from CodeIgniter
    require_once APPPATH.'config/database.php';

    // Doctrine will look for:
    // model classes defined in $modelsPath/$entitiesNamespace
    // with namespace Entities
    $modelsPath = rtrim(COMMON_MODEL_PATH, '/');
    $entitiesNamespace = "Entities";
    $entitiesClassLoader = new ClassLoader($entitiesNamespace, $modelsPath);
    $entitiesClassLoader->register();

    // default models, when defining the model, make sure you specific
    // the namespace for it: namespace models;
    // Doctrine will look for:
    // model classes defined in $modelsPath/models
    // with namespace models
    $modelsPath = COMMON_MODEL_PATH.'..';
    $defaultEntitiesClassLoader = new ClassLoader('models', $modelsPath);
    $defaultEntitiesClassLoader->register();
    
    $proxiesClassLoader = new ClassLoader('Proxies', COMMON_MODEL_PATH.'Proxies');
    $proxiesClassLoader->register();

    $config = new Configuration;
    $driverImpl = $config->newDefaultAnnotationDriver(array(COMMON_MODEL_PATH));
    $config->setMetadataDriverImpl($driverImpl);

    // Proxy configuration
    $config->setProxyDir(COMMON_MODEL_PATH.'Proxies');
    $config->setProxyNamespace('Proxies');

    // please refer to http://doctrine-orm.readthedocs.org/en/latest/reference/caching.html?highlight=apc%20cache
    // In order to use the APC cache driver you must have it compiled and enabled in your php.ini.
    // other alternatives are Memcache, Memcached, Xcache, Redis, etc.
    /* if(ENVIRONMENT == 'development') */
    /*   $cache = new ArrayCache; */
    /* else */
    /*   $cache = new ApcCache; */
    /* $config->setMetadataCacheImpl($cache); */
    /* $config->setQueryCacheImpl($cache); */

    // Logger, uncomment these two lines when debugging
    /* $logger = new EchoSQLLogger; */
    /* $config->setSQLLogger($logger); */

    $config->setAutoGenerateProxyClasses( ENVIRONMENT == 'development' );

    // Database connection information
    $connectionOptions = array(
			       'driver' => 'pdo_mysql',
			       'user' =>     $db['default']['username'],
			       'password' => $db['default']['password'],
			       'host' =>     $db['default']['hostname'],
			       'dbname' =>   $db['default']['database'],
			       'charset' => $db['default']['char_set'],
			       'driverOptions' =>
			       array('charset' => $db['default']['char_set']));

    // Create EntityManager
    $this->em = EntityManager::create($connectionOptions, $config);
  }
}