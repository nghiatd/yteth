<?php
class Websitefront_Bootstrap extends Zend_Application_Module_Bootstrap
{
	protected function _initAutoload() {
		$autoloader = new Zend_Application_Module_Autoloader ( array (
				'namespace' => '',
				'basePath' => dirname ( __FILE__ )
		) );
	
	
	
		Zend_Session::start ();
		return $autoloader;
	}
	
	protected function _initRewrite(){
		$front = Zend_Controller_Front::getInstance();
		$route = $front->getRouter();
		$config = new Zend_Config_Ini(APPLICATION_PATH."/configs/routes.ini", 'production');
		$route->addConfig($config, 'routes');
		
	}
	
	protected function _initCache(){
		$frontend = array('lifetime' => null,
			'automatic_serialization'=>true	
		);
		
		$backend = array('cache_dir' => APPLICATION_PATH.'/temp');
		$cache = Zend_Cache::factory('Output', 'file', $frontend, $backend);
		Zend_Registry::set('cache', $cache);
	}
	
}

