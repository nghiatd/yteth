<?php
include APPLICATION_PATH . '//modules/default/controllers/PublicdetailController.php';
/*
 * Create By Daitk @var Id, User
 */
class Quanlynguoidung_IndexController extends PublicdetailController {
	// private $_MIndex;
	private $_CoquanId;
	private $_Namhoatdong;
	private $_Tencoquan;
	public function init() {
	}
	// Begin Longnp
	public function indexAction() {
	}
	public function preDispatch() {
		if ($this->_request->getModuleName () == 'default') {
			$auth = Zend_Auth::getInstance ();
			if (! $auth->hasIdentity ()) {
				if ($this->_request->getActionName () != 'login') {
					$this->_redirect ( 'index/login' );
				}
			}
		}
	}
	public function logoutAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->initValue ();
		$history = new Model_History ();
		$temp = $history->insert ( $this->TblUserbyId [0] ['Id'], date ( 'Y-m-d h:i:s', time () ), 'tbladmin', 'Đăng xuất', $this->UserIP );
		$auth = Zend_Auth::getInstance ()->clearIdentity ();
		echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=index/login\">";
		Zend_Session::destroy ( 'Zend_Auth', true );
	}
	// End Longnp
	
	// thong tin Acount
	public function thongtinacountAction() {
		$auth = Zend_Auth::getInstance ();
		$infoUser = $auth->getIdentity ();
		// Doc Session User sau khi Login
		$Info = Zend_Auth::getInstance ()->getStorage ()->read ();
		// View Id
		$this->view->fullname = $Info->Fullname;
		// $this->_MIndex = new Model_Index ();
		// $kq = $this->_MIndex->getNamhoatdong ($Info->ThongtincoquanId);
		// echo $kq[0]['Namhoatdong'];
		// EDIT Daitk
		$this->initValue ();
		$this->view->namhoatdong = $this->TblThongtincoquanbyId [0] ['Namhoatdong']; // $kq[0]['Namhoatdong'];
		$this->view->thongtincoquanId = $this->TblThongtincoquanbyId [0] ['Id'];
		// END Daitk
	}
	// het thong tin Acount
	
	
	
	public function nhansutoolboxAction() {
			$this->initValue ();
		}
		
		
	public function nhansutreedataAction() {
		$this->initValue ();
		$this->view->Tencoquan = $this->TblThongtincoquanbyId [0] ['Tencoquan'];
	}
	
	
	public function dansotoolboxAction() {
		$this->initValue ();
	}
	
	
	public function dansotreedataAction() {
		$this->initValue ();
		$this->view->Tencoquan = $this->TblThongtincoquanbyId [0] ['Tencoquan'];
	}
	
	public function khambenhtoolboxAction() {
		$this->initValue ();
	}
	
	
	public function khambenhtreedataAction() {
		$this->initValue ();
		$this->view->Tencoquan = $this->TblThongtincoquanbyId [0] ['Tencoquan'];
	}
	
	public function thuocvattutoolboxAction() {
		$this->initValue ();
	}
	
	
	public function thuocvattutreedataAction() {
		$this->initValue ();
		$this->view->Tencoquan = $this->TblThongtincoquanbyId [0] ['Tencoquan'];
	}
}
?>