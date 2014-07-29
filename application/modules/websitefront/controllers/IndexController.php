<?php

/*
 * Create By Daitk @var Id, User
 */
include_once APPLICATION_PATH . '//modules/default/controllers/PublicdetailController.php';
class Websitefront_IndexController extends PublicdetailController {
	
	public function initValue() {		
		$cache = Zend_Registry::get('cache');
		
		$strIP = str_replace('.', '', $_SERVER['REMOTE_ADDR']);
		if ($this->getRequest ()->isPost ()) {
			$coquanId[$strIP] = $this->getRequest ()->getParam ( 'coquanId' );
			$this->coquanId = $coquanId;
			$cache->save($coquanId, 'IP');
		}
		
		if($cache->test('IP')){
			
			$IP = $cache->load('IP');
			
			if(isset($IP[$strIP]))
				$this->coquanId = $IP[$strIP];
			else
				$this->coquanId = 1;
		}
		
		
	}
	public function init() {
		$this->_helper->layout->setLayout ( 'websiteyte_layout' );
		$this->initValue ();
	}
	public function indexAction() {
		
		
		
		$this->view->CoQuanId = $this->coquanId;
		$this->view->DanhMuc = Websitefront_Model_Danhmuc::getDanhMucObj ( 1, $this->coquanId );
		
		$this->view->DanhMucBoDy = Websitefront_Model_Danhmuc::getDanhMucObj ( 0, $this->coquanId );
		// print_r($this->view->DanhMucBody);die;
		
		$this->view->LienKet = Websitefront_Model_Lienket::getLienKet ( 0, $this->coquanId );
		$this->view->LienKettrangchu = Websitefront_Model_Lienket::getLientrangchu ();
		$this->view->LienKetDuoi = Websitefront_Model_Lienket::getLienKet ( 4, $this->coquanId );
		$this->view->QuangCao = Websitefront_Model_Lienket::getLienKet ( 1, $this->coquanId );
		$this->view->Banner = Websitefront_Model_Lienket::getLienKet ( 2, $this->coquanId );
		//print_r($this->view->Banner[0]['Id']);die;
		$this->view->Thuvien = Websitefront_Model_Lienket::getLienKet ( 3, $this->coquanId );
		//$this->view->TinMoi = Websitefront_Model_Tintuc::getTintucByLoai ( 1, $this->coquanId );
		
		$this->view->Lich = Websitefront_Model_Tintuc::getTintucByLoai ( 3, $this->coquanId );
		$this->view->ThongBao = Websitefront_Model_Tintuc::getTintucByLoai ( 2, $this->coquanId );
		$this->view->TinMoi = Websitefront_Model_Tintuc::getTinMoi ( $this->coquanId );
		//print_r($this->view->TinMoi);die;
		// $this->view->TinHoatDong =
		// Websitefront_Model_Tintuc::getTinTheoDanhMuc(20, 10,
		// $this->TblThongtincoquanbyId[0]['Id']);
		// $this->view->TinDaoTao =
		// Websitefront_Model_Tintuc::getTinTheoDanhMuc(21, 7,
		// $this->TblThongtincoquanbyId[0]['Id']);
		// $this->view->NghienCuu =
		// Websitefront_Model_Tintuc::getTinTheoDanhMuc(19, 3,
		// $this->TblThongtincoquanbyId[0]['Id']);
		// $this->view->HopTac =
		// Websitefront_Model_Tintuc::getTinTheoDanhMuc(22, 3,
		// $this->TblThongtincoquanbyId[0]['Id']);
		
		$this->view->TinMoiNhat = Websitefront_Model_Tintuc::getTinOderBy ( '', 'NgayTao DESC', 8, $this->coquanId );
		$this->view->TinXemNhieu = Websitefront_Model_Tintuc::getTinOderBy ( '', 'LuotXem DESC', 8, $this->coquanId );
		$this->view->LuotBL = Websitefront_Model_Tintuc::getTinOderBy ( '', 'LuotBL DESC', 8, $this->coquanId );
	}
}
?>