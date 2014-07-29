<?php
/*
 * Created By Daitk 1, Zend_Db
 */
class Websitefront_Model_Lichcongtac {
	protected static $db;
	
	public function __construct() {
		self::$db = Zend_Registry::get ( "db" );
	}
	
	/*
	 * Use Zend_Db_Table
	 */
	
	public static function getAllObj($coquanId) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
	
		$query = self::$db->query ( "SELECT Id, File, TieuDe, NgayTao 
				FROM tbl_lichcongtac WHERE TrangThai = 1 AND ThongtincoquanId = $coquanId Order by Id" );
				$result = array ();
				$result = $query->fetchAll ();
				return $result;
	}
	
	public static function getFileLink($File = null){
		return '/websitefront/lichcongtac/'.$File;
	}
	
	public static function getFolder(){
		return md5(date('Y-m-d'));
	}
	
	public static function getObjByFile($File = null, $coquanId) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		$query = self::$db->query("SELECT Id, File From tbl_lichcongtac WHERE File = '$File' AND ThongtincoquanId = $coquanId AND TrangThai = 1");
		
		return $query->fetch();
	
	}
	
}