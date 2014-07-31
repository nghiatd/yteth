<?php

/*
 * Create By Daitk @var Id, User
 */
include_once APPLICATION_PATH . '//modules/default/controllers/PublicdetailController.php';
class Websitefront_TintucController extends PublicdetailController {

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
		// $this->view->Thuvien = Websitefront_Model_Lienket::getLienKet(3,
		// $this->TblThongtincoquanbyId[0]['Id']);
		// $this->view->TinMoi = Websitefront_Model_Tintuc::getTintucByLoai(1,
		// $this->TblThongtincoquanbyId[0]['Id']);
		// $this->view->Lich = Websitefront_Model_Tintuc::getTintucByLoai(3,
		// $this->TblThongtincoquanbyId[0]['Id']);
		// $this->view->ThongBao = Websitefront_Model_Tintuc::getTintucByLoai(2,
		// $this->TblThongtincoquanbyId[0]['Id']);
		// $this->view->TinMoi =
		// Websitefront_Model_Tintuc::getTinMoi($this->TblThongtincoquanbyId[0]['Id']);
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
		// print_r($this->view->TinDaoTao);die;
		$request = $this->getRequest ()->getParams ();
		$titleplain = $request ['title'];
		$titleplain = explode ( '.', $titleplain );
		
		$page = $this->getRequest ()->getParam ( 'page' );
		$recordPerPage = 4;
		try{
			$this->view->DanhMucChiTiet = Websitefront_Model_Danhmuc::getByAlias ( $titleplain [0], $this->coquanId );
			//print_r($this->view->DanhMucChiTiet);die;
			$this->view->TinTuc = Websitefront_Model_Tintuc::getByCatePagia ( $this->view->DanhMucChiTiet ['Id'], $recordPerPage, $page, $this->coquanId );
			
		} catch(PDOException $e){
			//
		}
		
		$breadcrumbs = array (
				'Trang chủ' => '',
				$this->view->DanhMucChiTiet ['TieuDe'] => '' 
		);
		$this->view->breadcrumbs = $breadcrumbs;
		//
		$this->view->DanhMuc = Websitefront_Model_Danhmuc::getDanhMucObj ( 1, $this->coquanId );
		$this->view->LienKet = Websitefront_Model_Lienket::getLienKet ( 0, $this->coquanId );
		$this->view->LienKetDuoi = Websitefront_Model_Lienket::getLienKet ( 4, $this->coquanId );
		$this->view->QuangCao = Websitefront_Model_Lienket::getLienKet ( 1, $this->coquanId );
		$this->view->Banner = Websitefront_Model_Lienket::getLienKet ( 2, $this->coquanId );
		
		$this->view->TinMoiNhat = Websitefront_Model_Tintuc::getTinOderBy ( '', 'NgayTao DESC', 8, $this->coquanId );
		$this->view->TinXemNhieu = Websitefront_Model_Tintuc::getTinOderBy ( '', 'LuotXem DESC', 8, $this->coquanId );
		$this->view->LuotBL = Websitefront_Model_Tintuc::getTinOderBy ( '', 'LuotBL DESC', 8, $this->coquanId );
		
		
	}
	
	public function setValue(){
	
		$data ['Ten'] = $_REQUEST ['Ten'];
		$data ['Email'] = $_REQUEST ['Email'];
		$data ['ChuDe'] = $_REQUEST ['ChuDe'];
		$data ['NoiDung'] = $_REQUEST ['NoiDung'];
		$data ['captcha'] = $_REQUEST ['captcha'];
		$data['NgayTao'] = date('Y-m-d H:i:s');
		$data['ThongtincoquanId'] = $this->coquanId;
		$data['TintucId'] = (isset($_REQUEST['TintucId']))? $_REQUEST['TintucId'] : 0;
		$data['ParentId'] = (isset($_REQUEST['ParentId']))? $_REQUEST['ParentId'] : 0;
		$data['TrangThai'] = 1;
		return $data;
	}
	
	
	
	public function detailAction() {
		
		$request = $this->getRequest ()->getParams ();

        $this->view->Album = Websitefront_Model_Lienket::getLienKet(3, $this->coquanId);
		$titleplain = $request ['title'];
		$titleplain = explode ( '.', $titleplain );
		
		try{
		$this->view->DanhMucChiTiet = Websitefront_Model_Danhmuc::getByAlias ( $request ['cate'], $this->coquanId );
		
		$this->view->Tin = Websitefront_Model_Tintuc::getByAlias ( $titleplain[0], $this->coquanId );
		
		}catch (PDOException $e){
			
		}
		
		
		
		$form = new Websitefront_Form_Binhluan();
		
		$this->view->form = $form->formBL(array('TintucId'=>$this->view->Tin['Id']));
		
			if($this->getRequest()->isPost()){
				$data = $this->setValue($request);
					
				if($form->isValid($data)){
			
					unset($data['captcha']);
					$form->reset();
					Websitefront_Model_Binhluan::addBinhLuan($data);
					echo "<script>alert('Bạn đã gửi thành công!')</script>";
				}else{
					$this->view->error = $form->getMessages();
				}
			}
		
		
		$this->view->Binhluan = Websitefront_Model_Binhluan::getRoot($this->view->Tin['Id']);
		$_SESSION ['Tin'] [$this->view->Tin ['Id']] = $this->view->Tin ['Id'];
		
		//
		//print_r(implode(',',array_filter($_SESSION['Tin'])));die;
		try{
			if(!isset($this->view->DanhMucChiTiet ['Id']))
				$Cate = 0;
			else
				$Cate = $this->view->DanhMucChiTiet ['Id'];
		$this->view->TinLienQuan = Websitefront_Model_Tintuc::getTinLienQuan ( $Cate, $_SESSION ['Tin'], 5, $this->coquanId );
		}catch (PDOException $e){
			$this->_redirect('');
		}
		
		
		$breadcrumbs = array (
				'Trang chủ' => '',
				$this->view->DanhMucChiTiet ['TieuDe'] => Websitefront_Model_Danhmuc::getLink ( $this->view->DanhMucChiTiet ['Alias'] ),
				$this->view->Tin ['TieuDe'] => '' 
		);
		
		$this->view->breadcrumbs = $breadcrumbs;
		
		$this->view->TinMoiNhat = Websitefront_Model_Tintuc::getTinOderBy ( '', 'NgayTao DESC', 8, $this->coquanId );
		$this->view->TinXemNhieu = Websitefront_Model_Tintuc::getTinOderBy ( '', 'LuotXem DESC', 8, $this->coquanId );
		$this->view->LuotBL = Websitefront_Model_Tintuc::getTinOderBy ( '', 'LuotBL DESC', 8, $this->coquanId );
		
		
		$this->view->DanhMuc = Websitefront_Model_Danhmuc::getDanhMucObj ();
		$this->view->LienKet = Websitefront_Model_Lienket::getLienKet ( 0, $this->coquanId );
		$this->view->LienKetDuoi = Websitefront_Model_Lienket::getLienKet ( 4, $this->coquanId );
		$this->view->QuangCao = Websitefront_Model_Lienket::getLienKet ( 1, $this->coquanId );
		$this->view->Banner = Websitefront_Model_Lienket::getLienKet ( 2, $this->coquanId );
		$this->view->Thuvien = Websitefront_Model_Lienket::getLienKet ( 3, $this->coquanId );
		
		
		
		
	}
	
	public function formreplyAction(){
		//if($this->getRequest()->isXmlHttpRequest()){
		$this->_helper->layout()->disableLayout();
		$ParentId = $this->getRequest()->getParam('ParentId');
		$PostUrl = $this->getRequest()->getParam('PostUrl');
		$request = $this->getRequest()->getParams();
		//if($this->getRequest()->getParam('getForm')){
			$form = new Websitefront_Form_Binhluan();
			$this->view->form = $form->formReply(array('ParentId'=>$ParentId, 'PostUrl'=>$PostUrl, 'Request'=>$request));
		//}
		//}
		if($this->getRequest()->isPost()){
			if(!isset($PostUrl)){
				$this->_helper->viewRenderer->setNoRender(true);
				$data = $this->setReplyValue($request);
				if($form->isValid($data)){
					$data = $this->setReplyConvert($data);
					unset($data['captcha']);
					$form->reset();
					Websitefront_Model_Binhluan::addBinhLuan($data);
					echo json_encode(array('error_status'=>true));
				}else{
					
					echo json_encode( array('error'=>$form->getMessages(),'error_status'=>false));
					
				}
			}	
		}
		
		

	}
	
	
	
	public function setReplyValue($request){
		$data ['Ten_reply'] = $request ['Ten_reply'];
		$data ['Email_reply'] = $request ['Email_reply'];
		$data ['ChuDe_reply'] = $request ['ChuDe_reply'];
		$data ['NoiDung_reply'] = $request ['NoiDung_reply'];
		$data ['captcha_reply'] = $request ['captcha_reply'];
		$data['NgayTao'] = date('Y-m-d H:i:s');
		$data['ThongtincoquanId'] = $this->coquanId;
		$data['ParentId_reply'] = (isset($request['ParentId_reply']))? $request['ParentId_reply'] : 0;
		$data['TrangThai'] = 1;
		return $data;
	}
	
	public function setReplyConvert($data = array()){
		$arr ['Ten'] = $data ['Ten_reply'] ;
		$arr ['Email'] = $data ['Email_reply'];
		$arr ['ChuDe'] = $data ['ChuDe_reply'] ;
		$arr ['NoiDung'] = $data ['NoiDung_reply'];
		$arr ['ParentId'] = $data['ParentId_reply'];
		$arr ['TrangThai'] = 1;
		$arr ['NgayTao'] = $data['NgayTao'];
		$arr ['ThongtincoquanId'] = $data ['ThongtincoquanId'];
		return $arr;
	}
}
?>