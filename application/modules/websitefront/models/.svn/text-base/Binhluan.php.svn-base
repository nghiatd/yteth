<?php
/*
 * Created By Daitk 1, Zend_Db
 */
class Websitefront_Model_Binhluan {
	protected static  $db ;
	public static function addBinhLuan($data){
		if(self::$db == null)
			self::$db = Zend_Registry::get('db');
		$id = self::$db->insert( 'tbl_binhluan', $data);
	}
	
	public static function getRoot($TintucId = 0){
		if(self::$db == null)
			self::$db = Zend_Registry::get('db');
		$query = self::$db->query("SELECT * FROM tbl_binhluan WHERE  ParentId = 0 AND TintucId =$TintucId AND TrangThai=1");
		return $query->fetchAll();
	}
	
	public static function getChildren($ParentId = 0){
		if(self::$db == null)
			self::$db = Zend_Registry::get('db');
		$query = self::$db->query("SELECT * FROM tbl_binhluan WHERE ParentId =$ParentId AND TrangThai=1");
		return $query->fetchAll();
	}
}