<?php
include APPLICATION_PATH . '//modules/default/controllers/PublicdetailController.php';
class Quanlynguoidung_QuanlynguoidungController extends PublicdetailController {
	private $_MHistory;
	public function indexAction() {
		$this->view->User = $this->TblUserbyId [0] ['User'];
		return $this->view;
	}
	public function init() {
		$this->initValue ();
		$option = array (
				"layout" => "mainlayout",
				"layoutPath" => APPLICATION_PATH . "/layouts/scripts/"
		);
		Zend_Layout::startMvc ( $option );
		$this->_MHistory = new Model_History ();
	}
	public function preDispatch() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			if ($this->_request->getActionName () != 'login') {
				$this->_redirect ( '/index/login' );
			}
		}
	}
	public function jsonAction() {
		$page = isset ( $_POST ['page'] ) ? intval ( $_POST ['page'] ) : 1;
		$rows = isset ( $_POST ['rows'] ) ? intval ( $_POST ['rows'] ) : 10;
		$sort = isset ( $_POST ['sort'] ) ? strval ( $_POST ['sort'] ) : 'Id';
		$order = isset ( $_POST ['order'] ) ? strval ( $_POST ['order'] ) : 'desc';
		$offset = ($page - 1) * $rows;
		
		$this->_helper->layout ()->disableLayout ();
		$mquanlynguoidung = new Quanlynguoidung_Model_Quanlynguoidung ();
		$jsonObj = json_encode ( $mquanlynguoidung->getFetObj ( $this->TblThongtincoquanbyId [0] ['Id'], $this->TblThongtincoquanbyId [0] ['Phuluc'], $sort, $order, $offset, $rows ) );
		
		return $this->view->jsonObj = $jsonObj;
	}
	public function addAction() {
		$this->_helper->layout ()->disableLayout ();
		$jsonObj = array ();
		$User = $_REQUEST ['User'];
		$Pass = $_REQUEST ['Pass'];
		$CPass = $_POST ['CPass'];
		$Email = $_REQUEST ['Email'];
		$Fullname = $_REQUEST ['Fullname'];
		$Address = $_REQUEST ['Address'];
		$Phone = $_REQUEST ['Phone'];
		$Fax = $_REQUEST ['Fax'];
		$Kichhoat = (isset ( $_POST ["KichhoatUS"] ) && $_POST ["KichhoatUS"] != "") ? $_POST ["KichhoatUS"] : "";
		if ($Kichhoat == 'on')
			$Kichhoat = 1;
		else
			$Kichhoat = 0;
		$CoquanId = $_REQUEST ['CoquanId'];
		$mquanlynguoidung = new Quanlynguoidung_Model_Quanlynguoidung ();
		$dup = $mquanlynguoidung->CheckValueObj ( 0, $User );
		
		if ($dup > 0) {
			echo "<script type=\"text/javascript\">
					    alert('Tên người dùng này đang hoạt động');
					</script>";
			$jsonObj ["success"] = false;
			return $this->view->jsonObj = json_encode ( $jsonObj );
		} else {
			if ($Pass != $CPass) {
				echo "<script type=\"text/javascript\">
						alert('Mật khẩu không chính xác!');
						</script>";
			} else {
				$id = $mquanlynguoidung->addObj ( $User, $Pass, $Email, $Fullname, $Address, $Phone, $Fax, $CoquanId, $Kichhoat );
				$this->_MHistory->insert ( $this->TblUserbyId [0] ['Id'], $this->Time_Ac, 'tbladmin', 'Thêm', $this->UserIP );
				$jsonObj ["success"] = true;
			}
		}
		
		return $this->view->jsonObj = json_encode ( $jsonObj );
	}
	public function updateAction() {
		$this->_helper->layout ()->disableLayout ();
		$id = $this->_getParam ( 'Id' );
		$o_user = $this->_getParam ( 'user' );
		$User = $_REQUEST ['User'];
		$Pass = $_REQUEST ['Pass'];
		$CPass = $_POST ['CPass'];
		$Email = $_REQUEST ['Email'];
		$Fullname = $_REQUEST ['Fullname'];
		$Address = $_REQUEST ['Address'];
		$Phone = $_REQUEST ['Phone'];
		$Fax = $_REQUEST ['Fax'];
		$Kichhoat = (isset ( $_POST ["KichhoatUS"] ) && $_POST ["KichhoatUS"] != "") ? $_POST ["KichhoatUS"] : "";
		if ($Kichhoat == 'on')
			$Kichhoat = 1;
		else
			$Kichhoat = 0;
		$ThongtincoquanId = $_REQUEST ['CoquanId'];
		$mquanlynguoidung = new Quanlynguoidung_Model_Quanlynguoidung ();
		if (md5 ( $Pass ) != md5 ( $CPass )) {
			echo "<script type=\"text/javascript\">
					    alert('Xác nhận mật khẩu không đúng');
					</script>";
		}
		if (isset ( $id ) && $id > 0) {
			if ($User == $o_user) {
				$mquanlynguoidung->updateObj ( $id, $User, $Pass, $Email, $Fullname, $Address, $Phone, $Fax, $ThongtincoquanId, $Kichhoat );
				$jsonObj ["success"] = true;
			} else {
				$dup = $mquanlynguoidung->CheckValueObj ( $id, $User );
				if ($dup > 0) {
					echo "<script type=\"text/javascript\">
					    alert('Đã có thông tin này');
					</script>";
					$jsonObj ["success"] = false;
					return $this->view->jsonObj = json_encode ( $jsonObj );
				} else {
					if ($Pass != $CPass) {
						echo "<script type=\"text/javascript\">
							alert('Mật khẩu không đúng');
							</script>";
					} else {
						$mquanlynguoidung->updateObj ( $id, $User, $Pass, $Email, $Fullname, $Address, $Phone, $Fax, $ThongtincoquanId, $Kichhoat );
						$this->_MHistory->insert ( $this->TblUserbyId [0] ['Id'], $this->Time_Ac, 'tbladmin', 'Sửa', $this->UserIP );
						$jsonObj ["success"] = true;
					}
				}
			}
		}
		return $this->view->jsonObj = json_encode ( $jsonObj );
	}
	public function delAction() {
		$this->_helper->layout ()->disableLayout ();
		$items = $_REQUEST ['items'];
		$jsonObj = array (
				'success' => false 
		);
		$mquanlynguoidung = new Quanlynguoidung_Model_Quanlynguoidung ();
		foreach ( $items as $item ) {
			if ($item ['Id'] != null) {
				$mquanlynguoidung->delObj ( $item ['Id'] );
				$jsonObj = array (
						'success' => true 
				);
			}
		}
		$this->_MHistory->insert ( $this->TblUserbyId [0] ['Id'], $this->Time_Ac, 'tbladmin', 'Xóa', $this->UserIP );
		return $this->view->jsonObj = json_encode ( $jsonObj );
	}
	public function searAction() {
		$this->_helper->layout ()->disableLayout ();
		
		$page = isset ( $_POST ['page'] ) ? intval ( $_POST ['page'] ) : 1;
		$rows = isset ( $_POST ['rows'] ) ? intval ( $_POST ['rows'] ) : 10;
		$sort = isset ( $_POST ['sort'] ) ? strval ( $_POST ['sort'] ) : 'Id';
		$order = isset ( $_POST ['order'] ) ? strval ( $_POST ['order'] ) : 'desc';
		$offset = ($page - 1) * $rows;
		
		$User = $this->_getParam ( 'user' );
		$Tentruong = $this->_getParam ( 'Tentruong' );
		$Address = $this->_getParam ( 'address' );
		
		$mquanlynguoidung = new Quanlynguoidung_Model_Quanlynguoidung ();
		$jsonObj = json_encode ( $mquanlynguoidung->searObj ( $this->TblUserbyId [0] ['Phuluc'], $this->TblTruonghocbyId [0] ['Id'], $User, $Tentruong, $Address, $sort, $order, $offset, $rows ) );
		
		return $this->view->jsonObj = $jsonObj;
	}
}