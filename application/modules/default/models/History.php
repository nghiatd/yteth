<?php
class Model_History {
	protected $db;
	// Khởi tạo hàm dựng của Class
	public function __construct() {
		$this->db = Zend_Registry::get ( "db" );
	}
	public function insert($_user_id, $_datetime, $_name_table, $_action, $_user_ip) {
		$stmt = $this->db->prepare ( 'CALL UPDATE_HISTORY(' . $_user_id . ', \'' . $_datetime . '\', \'' . $_name_table . '\', \'' . $_action . '\', \'' . $_user_ip . '\')' );
		$id = $stmt->execute ();
		return $id;
	}
	public function clearcopy($ThongtincoquanId,$UserId) {
		$Iddel = $this->db->delete ( 'tblrecbin', "ThongtincoquanId=$ThongtincoquanId and UserId=$UserId" );
		return $Iddel;
		
		
	}
}
?>