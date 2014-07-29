<?php
class PublicdetailController extends Zend_Controller_Action {
	
	protected $TblUserbyId;
	protected $IdUser, $TblTencoquan;
	// field: Id,User,
	// Pass,Email,FullName,Address,Phone,Fax,ThongtincoquanId,Kichhoat
	protected $TblThongtincoquanbyId;
	protected $TblDongia;
	// field: Id,Matram,Tencoquan,Nguoidaidien,Dienthoai,PhanloaixaId,Diachi,
	// Email,Website,CoquanId,Phuluc,Logo,Namhoatdong
	protected $TblTinhbytramId;
	protected $UserIP;
	protected $Time_Ac;
	protected  $layout ;
	/*
	 * Chú ý: Phụ lục = 1 Đang đăng nhập Trạm Phụ lục =2 Đang đăng nhập của
	 * Huyện
	 */
	public function initValue() {
		
		
		$Info = Zend_Auth::getInstance ()->getStorage ()->read ();
		
		$this->IdUser = $Info->Id;
		if ($this->IdUser == null) {
			$auth = Zend_Auth::getInstance ();
			if (! $auth->hasIdentity ()) {
				if ($this->_request->getActionName () != 'login') {
					$this->_redirect ( '/index/login' );
				}
			}
		}
		Model_Publicdetail::GetIdUser ( $this->IdUser );
		$this->setfortblAction ();
		$this->UserIP = $_SERVER ['REMOTE_ADDR'];
		$this->Time_Ac = date ( 'Y-m-d h:i:s', time () );
		$this->view->rowquoctich= Model_Publicdetail::rowquoctich();
		$this->view->rowdantoc= Model_Publicdetail::rowdantoc();
		$this->view->rowtongiao= Model_Publicdetail::rowtongiao();
		$this->setlayout();
	}
	public function indexAction() {
		
	}
	
	protected function setfortblAction() {
		$this->TblUserbyId = Model_Publicdetail::ReturnTblAdminbyId ();
		$this->TblThongtincoquanbyId = Model_Publicdetail::ReturnTblThongtincoquanById ();
		$this->TblTinhbytramId = Model_Publicdetail::ReturnTblTinhByTramId ();
		$this->TblDongia = Model_Publicdetail::ReturnTblDongia ();
		$this->TblTencoquan = $this->TblThongtincoquanbyId;
		
	}
	public  function setlayout()
	{
		$this->layout = new Zend_Layout();
	
		$Info = Zend_Auth::getInstance ()->getStorage ()->read ();
		$this->IdUser = $Info->Id;
		Model_Publicdetail::GetIdUser ( $this->IdUser );
		$this->setfortblAction ();		
		$this->layout->Hethong=$this->TblUserbyId [0] ['Hethong'];
		$this->layout->Nhansu=$this->TblUserbyId [0] ['Nhansu'];
		$this->layout->Danso=$this->TblUserbyId [0]['Danso'];
		$this->layout->Khambenh=$this->TblUserbyId [0]['Khambenh'];
		$this->layout->Tiemchung=$this->TblUserbyId [0]['Khambenh'];
		$this->layout->Muctieuquocgia=$this->TblUserbyId [0]['Muctieuquocgia'];
		$this->layout->Thuocvattu=$this->TblUserbyId [0]['Thuocvattu'];
		$this->layout->Thongkebaocao=$this->TblUserbyId [0]['Thongkebaocao'];
		$this->layout->Website=$this->TblUserbyId [0]['Website'];
		$this->layout->Nguoidung=$this->TblUserbyId [0]['FullName'];
		$this->layout->Namhoatdong= $this->TblTencoquan[0]['Namhoatdong'];
		$this->layout->ThongtincoquanId= $this->TblTencoquan[0]['Id'];
		$this->layout->Hethongchild='none';
		$this->layout->Nhansuchild='none';
	
	}
	/**
	 * $this->view->namhoatdong = $this->TblThongtincoquanbyId [0] ['Namhoatdong']; // $kq[0]['Namhoatdong'];
		$this->view->thongtincoquanId = $this->TblThongtincoquanbyId [0] ['Id'];
		
	 * - convertDate(text) Chuyển đổi định dạng ngày tháng từ ngày/tháng/năm =>
	 * năm-tháng-ngày
	 *
	 * @author Daitk
	 * @param String $text        	
	 * @return String
	 */
	public function convertDate($text) {
		if ($text != '') {
			list ( $date, $month, $year ) = explode ( "/", $text );
			$text = $year . '-' . $month . '-' . $date;
		}
		return $text;
	}
	/**
	 * Chỉ sử dụng hàm convertDate($txtDate) khi chuỗi có định dạng 'dd$mm$yyyy'
	 */
	public function convertDateSearch($txtDate) {
		if (isset ( $txtDate )) {
			list ( $date, $month, $year ) = explode ( "$", $txtDate );
			$_date_converted = $year . '-' . $month . '-' . $date;
			return $_date_converted;
		}
		return '';
	}
	/**
	 * Chỉ sử dụng hàm convertDategrid($txtDate) khi chuỗi có định dạng 'yyyy$mm$dd'
	 */
	public function convertDategrid($txtDate) {
		if (isset ( $txtDate )) {
			list ( $year, $month, $date ) = explode ( "$", $txtDate );
			$_date_converted = $year . '-' . $month . '-' . $date;
			return $_date_converted;
		}
		return '';
	}
	/**
	 * - Trả về Byte của Image được upload.
	 *
	 * @author Daitk
	 * @return Array byte
	 */
	public function getImage() {
		$logo = (isset ( $_FILES ['image'] ['tmp_name'] ) && $_FILES ['image'] ['tmp_name'] != "") ? $_FILES ['image'] ['tmp_name'] : "";
		$imgData = "";
		try {
			if ($logo != "")
				$imgData = file_get_contents ( $logo );
		} catch ( Exception $e ) {
			echo "<script type=\"text/javascript\">
				alert('Exception: Upload image!');
				</script>";
		}
		return $imgData;
	}
	// END Daitk
	
	public static function strimTitle($title='', $number=15) {
	
		return implode(' ',array_slice(explode(' ', strip_tags($title)), 0, $number));
	}
	
	public static function create_slug($string) {
		$coDau=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ"
				,"ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ","ì","í","ị","ỉ","ĩ",
				"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
				,"ờ","ớ","ợ","ở","ỡ",
				"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
				"ỳ","ý","ỵ","ỷ","ỹ",
				"đ",
				"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
				,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
				"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
				"Ì","Í","Ị","Ỉ","Ĩ",
				"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
				,"Ờ","Ớ","Ợ","Ở","Ỡ",
				"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
				"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
				"Đ","ê","ù","à", '"', "'", ",", "/", ".");
		$khongDau=array("a","a","a","a","a","a","a","a","a","a","a"
				,"a","a","a","a","a","a",
				"e","e","e","e","e","e","e","e","e","e","e",
				"i","i","i","i","i",
				"o","o","o","o","o","o","o","o","o","o","o","o"
				,"o","o","o","o","o",
				"u","u","u","u","u","u","u","u","u","u","u",
				"y","y","y","y","y",
				"d",
				"A","A","A","A","A","A","A","A","A","A","A","A"
				,"A","A","A","A","A",
				"E","E","E","E","E","E","E","E","E","E","E",
				"I","I","I","I","I",
				"O","O","O","O","O","O","O","O","O","O","O","O"
				,"O","O","O","O","O",
				"U","U","U","U","U","U","U","U","U","U","U",
				"Y","Y","Y","Y","Y",
				"D","e","u","a", '', "", "", "", "");
		$string = strtolower(str_replace($coDau,$khongDau,$string));
		return str_replace(' ', '-', $string);
	}
	
}