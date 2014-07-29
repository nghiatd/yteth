<?php
/**
 * 
 * @author Phadh
 *
 */
class Quanlynguoidung_Model_Logs{
	protected $db;
	
	public function __construct(){
		$this->db = Zend_Registry::get("db");
	}
	
	// hien thi danh sach theo phan trang
	public function getFetObj($sort, $order, $offset, $rows, $UserId){
		$result = array();
		$query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_users_history WHERE User_Id = $UserId");
		$row = $query->fetchAll();
		
		$query = $this->db->query("SELECT Id, User_Id, DATE_FORMAT(Datetime_Action,'%d/%m/%Y - %H:%i:%s') AS Datetime_Action, Action, User_Ip, Name_Table,
								IF(TRIM(Name_Table) = '', Action, CONCAT(Action, ' - ', (SELECT Tenbang FROM tbl_name_tables WHERE Name_Table = tbl_users_history.Name_Table))) AS Thaotac,
								(SELECT User FROM tbladmin WHERE Id = User_Id) AS User FROM tbl_users_history WHERE User_Id = $UserId 
								ORDER BY $sort $order LIMIT $offset,$rows");
		$result["total"] = $row[0]['Total'];
		$result ["rows"] = $query->fetchAll ();
		return $result;
	}
	
	// xoa du lieu 
	public function delObj($id, $userId) {
		$where[] = "Id = $id";
		$where[] = "User_Id = $userId";
		$id = $this->db->delete ( 'tbl_users_history', $where );
		return $id;
	}
}