<?php

/*
 * Create By Daitk @var Id, User
 */
include_once APPLICATION_PATH . '//modules/default/controllers/PublicdetailController.php';
class Websitefront_AlbumController extends PublicdetailController {
public function initValue() {

		$cache = Zend_Registry::get('cache');
        $this->coquanId = 6;
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

		$this->view->Album = Websitefront_Model_Lienket::getLienKet(3, $this->coquanId);

		
		$this->view->DanhMuc = Websitefront_Model_Danhmuc::getDanhMucObj ();
		$this->view->LienKet = Websitefront_Model_Lienket::getLienKet ( 0, $this->coquanId );
		$this->view->LienKetDuoi = Websitefront_Model_Lienket::getLienKet ( 4, $this->coquanId );
		$this->view->QuangCao = Websitefront_Model_Lienket::getLienKet ( 1, $this->coquanId );
		$this->view->Banner = Websitefront_Model_Lienket::getLienKet ( 2, $this->coquanId );
		$this->view->Thuvien = Websitefront_Model_Lienket::getLienKet ( 3, $this->coquanId );
		$this->view->TinMoiNhat = Websitefront_Model_Tintuc::getTinOderBy ( '', 'NgayTao DESC', 8, $this->coquanId );
		$this->view->TinXemNhieu = Websitefront_Model_Tintuc::getTinOderBy ( '', 'LuotXem DESC', 8, $this->coquanId );
		
	}
}
?>