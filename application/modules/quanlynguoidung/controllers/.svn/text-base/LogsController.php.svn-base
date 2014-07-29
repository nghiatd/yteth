<?php
include APPLICATION_PATH . '//modules/default/controllers/PublicdetailController.php';

class Quanlynguoidung_LogsController extends PublicdetailController{
	private $_MLogs;
	private $_MHostory;
	
	public function init(){
		$this->initValue();
		$option = array (
				"layout" => "mainlayout",
				"layoutPath" => APPLICATION_PATH . "/layouts/scripts/"
		);
		Zend_Layout::startMvc ( $option );
		$this->_MLogs = new Quanlynguoidung_Model_Logs();
		$this->_MHostory = new Model_History();
	}
	
	/**
	 * - Check Login
	 * @see Zend_Controller_Action::preDispatch()
	 */
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
	public function indexAction() {
	}
	
	// hien thi du lieu theo phan trang
	public function jsonAction(){
		$page = isset ( $_POST ['page'] ) ? intval ( $_POST ['page'] ) : 1;
		$rows = isset ( $_POST ['rows'] ) ? intval ( $_POST ['rows'] ) : 10;
		$sort = isset ( $_POST ['sort'] ) ? strval ( $_POST ['sort'] ) : 'Id';
		$order = isset ( $_POST ['order'] ) ? strval ( $_POST ['order'] ) : 'desc';
		$offset = ($page - 1) * $rows;
		
		$this->_helper->layout()->disablelayout();
		$jsonObj = json_encode($this->_MLogs->getFetObj($sort, $order, $offset, $rows, $this->TblUserbyId[0]['Id']));
		return $this->view->jsonObj = $jsonObj;
	}
	
	public function delAction() {
		$this->_helper->layout ()->disableLayout ();
		$items = $_REQUEST ['items'];
		$jsonObj = array (
				'success' => false
		);
		foreach ( $items as $item ) {
			if ($item ['Id'] != null) {
				$this->_MLogs->delObj ( $item ['Id'], $this->TblUserbyId[0]['Id'] );
				$jsonObj = array (
						'success' => true
				);
			}
		}
		$this->_MHostory->insert($this->TblUserbyId[0]['Id'], $this->Time_Ac, 'tbl_users_history', 'Xóa', $this->UserIP);
		return $this->view->jsonObj = json_encode ( $jsonObj );
	}
}