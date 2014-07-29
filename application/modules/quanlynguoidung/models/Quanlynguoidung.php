<?php
class Quanlynguoidung_Model_Quanlynguoidung extends Zend_Db_Table_Abstract {
	
	// longnp
	
	// Ten bang
	protected $_name = "tbladmin";
	// Khoa chinh
	protected $_primary = "Id";
	// Su dung Zend_Db
	protected $DataAp;
	public function __construct() {
		$this->DataAp = Zend_Registry::get ( "db" );
	}
	public function getFetObj($ThongtincoquanId,$Phuluc,$sort, $order, $offset, $rows) {
		$result = array ();
		// Lay tong so ban ghi
		$query = $this->DataAp->query ( "SELECT COUNT(*) AS Total FROM tbladmin where ThongtincoquanId=$ThongtincoquanId" );
		$row = $query->fetchAll ();
		$result ["total"] = $row [0] ['Total'];
		// Thuc hien cau lenh truy xuat du lieu
		//la phong
		if($Phuluc==0)
			// lay thang cha
		{
		$sql1=" select 
				Id, User,Email,Fullname,Phone,Fax,Address,ThongtincoquanId as CoquanId,Kichhoat
				,
				 (SELECT Tencoquan FROM tblthongtincoquan WHERE Id = ThongtincoquanId) AS Tencoquan FROM tbladmin
				where ThongtincoquanId=$ThongtincoquanId 
				union 				
				Id, User,Pass,Email,Fullname,Phone,Fax,Address,ThongtincoquanId as CoquanId,Kichhoat,
				 (SELECT Tencoquan FROM tblthongtincoquan WHERE Id = ThongtincoquanId) AS Tencoquan FROM tbladmin
				where ThongtincoquanId in (select Id from tblthongtincoquanId where CoquanId= $ThongtincoquanId )  
				
		";
		// lay chinh no
		
		// lay thang con
		$query = $this->DataAp->query ( "$sql1" );
		}
		else
			$query = $this->DataAp->query ( "select Id, User,Email,Fullname,Phone,Fax,Address,ThongtincoquanId as CoquanId,Kichhoat,
					(SELECT Tencoquan FROM tblthongtincoquan WHERE Id = ThongtincoquanId) AS Tencoquan 
					FROM tbladmin where ThongtincoquanId=$ThongtincoquanId ORDER BY $sort $order LIMIT $offset, $rows" );
		$result ['rows'] = $query->fetchAll ();
		
		return $result;
	}
	public function addObj($User, $Pass, $Email, $Fullname, $Address, $Phone, $Fax, $ThongtincoquanId, $Kichhoat) {
		$data = array (
				'User' => $User,
				'Pass' => md5 ( $Pass ),
				'Email' => $Email,
				'ThongtincoquanId' => $ThongtincoquanId,
				'Fullname' => $Fullname,
				'Address' => $Address,
				'Phone' => $Phone,
				'Fax' => $Fax,
				'Kichhoat' => $Kichhoat
				
		);
		$id = $this->DataAp->insert ( 'tbladmin', $data );
		
		return $id;
	}
	public function updateObj($id, $User, $Pass, $Email, $Fullname, $Address, $Phone, $Fax, $ThongtincoquanId, $Kichhoat) {
		$data = array (
				'User' => $User,
				'Pass' => md5 ( $Pass ),
				'Email' => $Email,
				'ThongtincoquanId' => $ThongtincoquanId,
				'Fullname' => $Fullname,
				'Address' => $Address,
				'Phone' => $Phone,
				'Fax' => $Fax,
				'Kichhoat' => $Kichhoat
		);
		$this->DataAp->update ( 'tbladmin', $data, 'Id = ' . $id );
	}
	public function updateObjNoPass($id, $User, $Pass, $Email, $Fullname, $Address, $Phone, $Fax, $ThongtincoquanId, $Kichhoat) {
		$data = array (
				'User' => $User,
				'Pass' => md5($Pass),
				'Email' => $Email,
				'ThongtincoquanId' => $ThongtincoquanId,
				'Fullname' => $Fullname,
				'Address' => $Address,
				'Phone' => $Phone,
				'Fax' => $Fax,
				'Kichhoat' => $Kichhoat
				
		);
		$this->DataAp->update ( 'tbladmin', $data, 'Id = ' . $id );
	}
	public function delObj($id) {
		$idDel = $this->DataAp->delete ( 'tbladmin', 'Id = ' . $id );
		return $idDel;
	}
	public function CheckValueObj($id, $User) {
		
		
		
		$query = $this->DataAp->query ( "SELECT COUNT(Id) AS Total FROM tbladmin WHERE    User = '$User' " );
		if ($id != 0) {
			$query = $this->DataAp->query ( "SELECT COUNT(Id) AS Total FROM tbladmin 
					WHERE    Id !=$id and User = '$User'" );
		}
		$row = $query->fetchAll ();
		$total = $row [0] ['Total'];
		return $total;
	}
}