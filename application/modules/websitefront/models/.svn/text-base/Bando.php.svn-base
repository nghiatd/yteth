<?php
class Websitefront_Model_Bando {
	protected static $db;
	public function __construct() {
		self::$db = Zend_Registry::get ( 'db' );
	}
	public static function getBando($thongTinCoquanId) {
		if(self::$db == null){
			self::$db = Zend_Registry::get('db');
		}
		
		$query = self::$db->query("SELECT Id, Bando from tblthongtincoquan WHERE Id = $thongTinCoquanId");
		return $query->fetch();
	}
}