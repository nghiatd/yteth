<?php
include 'PublicdetailController.php';
/*
 * Create By Daitk @var Id, User
 */
class IndexController extends PublicdetailController {
	// private $_MIndex;
	private $_CoquanId;
	private $_Namhoatdong;
	private $_Tencoquan;
	public function init() {
	}
	// Begin Longnp
	public function indexAction() {
			$auth = Zend_Auth::getInstance ();
			$infoUser = $auth->getIdentity ();
			// Doc Session User sau khi Login
			$Info = Zend_Auth::getInstance ()->getStorage ()->read ();
			// View Id
			$this->view->Id = $Info->Id;
			// View User
			$this->view->User = $Info->User;
			$this->setlayout ();
	}
	public function preDispatch() {
		if ($this->_request->getModuleName () == 'default') {
			$auth = Zend_Auth::getInstance ();
			if (! $auth->hasIdentity ()) {
				if ($this->_request->getActionName () != 'login') {
					$this->_redirect ( 'websitefront' );
				}
			}
		}
	}
	public function loginAction() {
		$this->_helper->layout ()->disableLayout ();
		// khoi tao captcha
		$captcha = new Zend_Captcha_Image ();
		if (! $this->_request->isPost ()) {
			$captcha->setTimeout ( '180' )->setWordLen ( '4' )->setHeight ( '50' )->setWidth ( '200' )->setImgDir ( APPLICATION_PATH . '/../public/images/' )->setImgUrl ( '../public/images/' )->setDotNoiseLevel ( 20 )->setLineNoiseLevel ( 0 )->setFont ( 'public/font/LSANSDI.TTF' );
			$captcha->generate ();
			$this->view->captcha = $captcha->render ( $this->view );
			$this->view->captchaID = $captcha->getId ();
			// Dua chuoi Captcha vao session
			$captchaSession = new Zend_Session_Namespace ( 'Zend_Form_Captcha_' . $captcha->getId () );
			$captchaSession->word = $captcha->getWord ();
		} else {
			
			$captchaID = $this->_request->captcha_id;
			
			$captchaSession = new Zend_Session_Namespace ( 'Zend_Form_Captcha_' . $captchaID );
			$captchaIterator = $captchaSession->getIterator ();
			$captchaWord = $captchaIterator ['word'];
			
			if ($this->_request->captcha != $captchaWord) {
				$this->_redirect ( 'index/login' );
			}
			
			$this->_helper->viewRenderer->setNoRender ();
		}
		if ($this->_request->isPost ()) {
			// 1.Goi ket noi voi Zend Db
			$db = Zend_Registry::get ( 'db' );
			
			// 2. Khoi tao Zend Auth
			$auth = Zend_Auth::getInstance ();
			
			// 3. Khai bao bang va 2 cot se su dung so sanh trong qua trinh
			// login
			$authAdapter = new Zend_Auth_Adapter_DbTable ( $db );
			$authAdapter->setTableName ( 'tbladmin' )->setIdentityColumn ( 'User' )->setCredentialColumn ( 'Pass' )->setCredentialTreatment ( 'MD5(?)' );
			
			// 4. Lay gia tri duoc gui qua tu FORM
			$user = $this->_request->getParam ( 'User' );
			$pass = $this->_request->getParam ( 'Pass' );
			
			// 5. Dua vao so sanh voi du lieu khai bao o muc 3
			$authAdapter->setIdentity ( $user )->setCredential ( $pass );
			
			// 6. Kiem tra trang thai cua user neu status = 1 moi duoc login
			$select = $authAdapter->getDbSelect ();
			$select->where ( 'Kichhoat = 1' );
			
			// 7. Lay ket qua truy van
			$result = $auth->authenticate ( $authAdapter );
			$flag = false;
			if ($result->isValid ()) {
				$namespace = new Zend_Session_Namespace ( 'Zend_Auth' );
				$namespace->setExpirationSeconds ( 18000 );
				// 8. Lay nhung du lieu can thiet trong tbladmin neu login thanh
				// cong - Bo Pass k can lay ra.
				$data = $authAdapter->getResultRowObject ( null, 'Pass' );
				
				// 9. Luu nhung du lieu cua member vao session
				$auth->getStorage ()->write ( $data );
				
				$flag = true;
			} else {
				echo "<script type=\"text/javascript\">
					    alert('Sai ten dang nhap hoac mat khau hoặc người dùng chưa được kích hoạt!');
					</script>";
				echo "<META HTTP-EQUIV=\"refresh\" content=\"0;URL=index/login\">";
			}
			if ($flag == true && $this->_request->captcha == $captchaWord) {
				$this->initValue ();
				// Khởi tạo Session để lưu Mucxuly.
				$session = new Zend_Session_Namespace ( 'user_Mucxuly' );
				$mod = $session->user_Mucxuly ['mod'] = $this->TblThongtincoquanbyId [0] ['Phuluc'];
				$history = new Model_History ();
				$history->clearcopy ( $this->TblThongtincoquanbyId [0] ['Id'], $this->TblUserbyId [0] ['Id'] );
				$temp = $history->insert ( $this->TblUserbyId [0] ['Id'], date ( 'Y-m-d h:i:s', time () ), 'tbladmin', 'Đăng nhập', $this->UserIP );
				if ($mod == 1 || $mod == 4 || $mod == 3) {
					$this->_redirect ( '/index' );
				} else if ($mod == 2) {
					$this->_redirect ( 'soyte/' );
				} else if ($mod == 0) {
					$this->_redirect ( 'trungtam/' );
				}
				$this->_redirect ( '/index' );
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
		
		// $this->_MIndex = new Model_Index ();
		// $kq = $this->_MIndex->getNamhoatdong ($Info->ThongtincoquanId);
		// echo $kq[0]['Namhoatdong'];
		// EDIT Daitk
		$this->initValue ();
		
		// END Daitk
	}
	// het thong tin Acount
	
	public function nhansutreedataAction() {
		$this->initValue ();
		$this->view->Tencoquan = $this->TblThongtincoquanbyId [0] ['Tencoquan'];
	}
	public function muctieuquocgiatreedataAction() {
		$this->initValue ();
		$this->view->Tencoquan = $this->TblThongtincoquanbyId [0] ['Tencoquan'];
	}
	
	public function dansotreedataAction() {
		$this->initValue ();
		$this->view->Tencoquan = $this->TblThongtincoquanbyId [0] ['Tencoquan'];
	}
	
	public function khambenhtreedataAction() {
		$this->initValue ();
		$this->view->Tencoquan = $this->TblThongtincoquanbyId [0] ['Tencoquan'];
	}
	
	
	public function hethongtreedataAction() {
		$this->initValue ();
		$this->view->Tencoquan = $this->TblThongtincoquanbyId [0] ['Tencoquan'];
	}
	public function websitetreedataAction() {
		$this->initValue ();
		$this->view->Tencoquan = $this->TblThongtincoquanbyId [0] ['Tencoquan'];
	}
	
	public function tiemchungtreedataAction() {
		$this->initValue ();
		$this->view->Tencoquan = $this->TblThongtincoquanbyId [0] ['Tencoquan'];
	}
	
	
	public function thongkebaocaotoolboxAction() {
		$this->initValue ();
	}
	
	public function thuocvattutreedataAction() {
		$this->initValue ();
		$this->view->Tencoquan = $this->TblThongtincoquanbyId [0] ['Tencoquan'];
	}
}
?>