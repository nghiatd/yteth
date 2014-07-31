<?php

/*
 * Create By Daitk @var Id, User
 */
include_once APPLICATION_PATH . '//modules/default/controllers/PublicdetailController.php';
class Websitefront_BandoController extends PublicdetailController {
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
	public function setValue(){
		
		$data ['Ten'] = $_REQUEST ['Ten'];
		$data ['Email'] = $_REQUEST ['Email'];
		$data ['ChuDe'] = $_REQUEST ['ChuDe'];
		$data ['NoiDung'] = $_REQUEST ['NoiDung'];
		$data ['DaDoc'] = 0;
		$data ['captcha'] = $_REQUEST ['captcha'];
		$data['ThongtincoquanId'] = $this->coquanId;
		return $data;
	}
	
	

	public function indexAction() {
        $this->view->Album = Websitefront_Model_Lienket::getLienKet(3, $this->coquanId);
		$form = new Websitefront_Form_Lienhe();
		$this->view->form = $form;
		//$this->view->message = $this->_helper->flashMessenger->getMessages();
		if($this->getRequest()->isPost()){
			$data = $this->setValue();
			if($form->isValid($data)){
				$data['NgayTao'] = date('Y-m-d');
				unset($data['captcha']);
				$form->reset();
				Websitefront_Model_Lienhe::addObj($data);
				echo "<script>alert('Bạn đã gửi thành công!')</script>";
				//$this->_helper->flashMessenger->addMessage('Bạn đã gửi thành công');
			}else{
				$this->view->error = $form->getMessages();
				
			//print_r($form->getMessages());die;
			}
		}
		
		
		
		
		$this->view->Bando = Websitefront_Model_Bando::getBando($this->coquanId);
		$this->view->DanhMuc = Websitefront_Model_Danhmuc::getDanhMucObj ();
		$this->view->LienKet = Websitefront_Model_Lienket::getLienKet ( 0, $this->coquanId );
		$this->view->LienKetDuoi = Websitefront_Model_Lienket::getLienKet ( 4, $this->coquanId );
		$this->view->QuangCao = Websitefront_Model_Lienket::getLienKet ( 1, $this->coquanId );
		$this->view->Banner = Websitefront_Model_Lienket::getLienKet ( 2, $this->coquanId );
		$this->view->Thuvien = Websitefront_Model_Lienket::getLienKet ( 3, $this->coquanId );
		$this->view->TinMoiNhat = Websitefront_Model_Tintuc::getTinOderBy ( '', 'NgayTao DESC', 8, $this->coquanId );
		$this->view->TinXemNhieu = Websitefront_Model_Tintuc::getTinOderBy ( '', 'LuotXem DESC', 8, $this->coquanId );
		if ($this->getRequest ()->isPost ()) {
			$data = $this->setValue();
		}
	}
}
?>