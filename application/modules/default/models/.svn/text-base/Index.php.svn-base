<?php
/*
 * Created By Daitk 1, Zend_Db
 */
class Model_Index {
	protected $db;
	public function __construct() {
		$this->db = Zend_Registry::get ( "db" );
	}
	public function getFetObj($CoquanId,$Tencoquan) {
		$data = array ();
		$data [0] ['id'] = 0;
		$data [0] ['text'] = 'Thon';
		$doituong = array ();
		$childs = array ();
		$sub_childs = array ();
		$query = $this->db->query ( "SELECT Id AS id, Tenthonto AS text FROM tbldm_thonto WHERE XaId  = $CoquanId" );
		$doituong = $query->fetchAll ();
		$data [0] ['children'] = $doituong;
		return $data;
	}
	public function getNamhoatdong($id) {
		$query = $this->db->query ( "SELECT Id , Namhoatdong FROM tblthongtincoquan WHERE Id = $id" );
		$row = $query->fetchAll();
		if(count($row)>0)
		$this->Namhoatdong = $row[0]['Namhoatdong'];
		return $row;
	}
	
	
}