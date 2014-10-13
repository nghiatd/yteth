<?php
/*
 * Created By Daitk 1, Zend_Db
 */
class Websitefront_Model_Video {
    protected static $db;

	public function __construct() {
		self::$db = Zend_Registry::get ( "db" );
	}
	

	public static function getFetObj($thongtincoquanid) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}

		$query = self::$db->query ( "SELECT * FROM tbl_video WHERE TrangThai = 1 AND ThongtincoquanId = $thongtincoquanid" );
		$result = $query->fetchAll ();
		return $result;
	}

	public static function getLink($Id = 0, $Video = null) {
		return '/public/uploads/videos/' . $Id . '/' . $Video;
	}

	public static function getLastInsertId() {
		return Zend_Registry::get ( "db" )->lastInsertId ();
	}
}