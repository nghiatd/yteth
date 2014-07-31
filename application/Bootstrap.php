<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
	protected function _initDatabase() {
		$db = $this->getPluginResource ( 'db' )->getDbAdapter ();
		
		$dbOption = $this->getOption ( 'resources' );
		$dbOption = $dbOption ['db'];
		
		
		
		$db = Zend_Db::factory ( $dbOption ['adapter'], $dbOption ['params'] );
		
		try {$db->setFetchMode ( Zend_Db::FETCH_ASSOC );
		}catch (Exception $e){
			echo $e->getMessage();
		}
		
		// $db->query("SET NAMES 'utf8'");
		// $db->query("SET CHARACTER SET 'utf8'");
		Zend_Registry::set ( 'db', $db );
		
		Zend_Db_Table::setDefaultAdapter ( $db );
		return $db;
	}
	
	protected function setConstants($constants)
	{
		foreach($constants as $name => $value)
		{
			if(!defined($name))
				define($name, $value);
		}
	
	}
}

