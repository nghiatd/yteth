<?php

/*
 * Create By Daitk @var Id, User
 */
include_once APPLICATION_PATH . '//modules/default/controllers/PublicdetailController.php';
class Websitefront_LichcongtacController extends PublicdetailController {
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
		$this->view->Files = Websitefront_Model_Lichcongtac::getAllObj($this->coquanId);

		
		
		
		
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
	
	public function viewAction(){
		
		
	try{
			$File = Websitefront_Model_Lichcongtac::getObjByFile($this->getRequest()->getParam('title'), $this->coquanId);
			
	}catch (Exception $e){
		$this->_redirect('websitefront/index');
	}
		$TempFilePath = $this->TempFielPath($File['File']); 

		$RealFlePath = $this->RealFilePath($File['Id'], $File['File']);
		


		if(!copy($RealFlePath, $TempFilePath)){
			$this->_redirect('websitefront/index');
		}
	}
	
	public function getRootPath(){
		if(strpos('\\', APPLICATION_PATH));
		$path = explode('\\', APPLICATION_PATH);
		if(count($path))
			foreach ($path as $key => $value){
			if($value == 'application')
				unset($path[$key]);
		}
		return implode('\\', $path);
	}
	
	public function TempFielPath($File = null){
		$path = $this->getRootPath().'\\temp';
		$path .= '\\' .Websitefront_Model_Lichcongtac::getFolder();
// 		print_r($path);die;
		if(!is_dir($path)){
			mkdir($path);
			chmod($path , 777);
			
		}		
		
		return $path.'\\'.$File;
	}
	
	public function RealFilePath($id = null, $File = null){
		$path = $this->getRootPath();
		return $path.'\\public\uploads\lichcongtac\\'.$id.'\\'.$File;
	}
	
}
?>