<?php
use Doctrine\ORM\Mapping\Driver\YamlDriver;
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
//	protected function _initDatabase() {
//		$db = $this->getPluginResource ( 'db' )->getDbAdapter ();
//
//		$dbOption = $this->getOption ( 'resources' );
//		$dbOption = $dbOption ['db'];
//
//
//
//		$db = Zend_Db::factory ( $dbOption ['adapter'], $dbOption ['params'] );
//
//		try {$db->setFetchMode ( Zend_Db::FETCH_ASSOC );
//		}catch (Exception $e){
//			echo $e->getMessage();
//		}
//
//		// $db->query("SET NAMES 'utf8'");
//		// $db->query("SET CHARACTER SET 'utf8'");
//		Zend_Registry::set ( 'db', $db );
//
//		Zend_Db_Table::setDefaultAdapter ( $db );
//		return $db;
//	}

    /**
     * generate registry
     * @return Zend_Registry
     */
    protected function _initRegistry(){
        $registry = Zend_Registry::getInstance();
        return $registry;
    }

    /**
     * Register namespace Default_
     * @return Zend_Application_Module_Autoloader
     */
    protected function _initAutoload()
    {
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => 'Default_',
            'basePath'  => dirname(__FILE__),
        ));
        return $autoloader;
    }

    /**
     * Initialize Doctrine
     * @return Doctrine_Manager
     */
    public function _initDoctrine() {
        // include and register Doctrine's class loader
//        require_once('Doctrine/Common/ClassLoader.php');
//        require_once('library/vendor/Common/ClassLoader.php');

        require_once('library/vendor/autoload.php');

        $classLoader = new \Doctrine\Common\ClassLoader(
            'Doctrine',
            APPLICATION_PATH . '/../library/'
        );
        $classLoader->register();

        // create the Doctrine configuration
        $config = new \Doctrine\ORM\Configuration();

        // setting the cache ( to ArrayCache. Take a look at
        // the Doctrine manual for different options ! )
        $cache = new \Doctrine\Common\Cache\ArrayCache;
        $config->setMetadataCacheImpl($cache);
        $config->setQueryCacheImpl($cache);

        // choosing the driver for our database schema
        // we'll use annotations

        // $driver = $config->newDefaultAnnotationDriver(
        //     APPLICATION_PATH . '/models'
        // );
        $driver = new YamlDriver(array(APPLICATION_PATH . '/configs/yaml'));

        // var_dump($driver);die;
        $config->setMetadataDriverImpl($driver);
// var_dump($config);die;
        // set the proxy dir and set some options
        $config->setProxyDir(APPLICATION_PATH . '/models/Proxies');
        $config->setAutoGenerateProxyClasses(true);
        $config->setProxyNamespace('App\Proxies');

        // now create the entity manager and use the connection
        // settings we defined in our application.ini
        $connectionSettings = $this->getOption('doctrine');

        $conn = array(
            'driver'    => $connectionSettings['conn']['driv'],
            'user'      => $connectionSettings['conn']['user'],
            'password'  => $connectionSettings['conn']['pass'],
            'dbname'    => $connectionSettings['conn']['dbname'],
            'host'      => $connectionSettings['conn']['host']
        );
        $entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);
        $platform = $entityManager->getConnection()->getDatabasePlatform();
        $platform->registerDoctrineTypeMapping('enum', 'string');

        // push the entity manager into our registry for later use
        $registry = Zend_Registry::getInstance();
        $registry->entitymanager = $entityManager;

        return $entityManager;
    }
}

