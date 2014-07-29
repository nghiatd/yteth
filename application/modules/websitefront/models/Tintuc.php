<?php
/*
 * Created By Daitk 1, Zend_Db
 */
class Websitefront_Model_Tintuc {
	protected static $db;
	public static $TrangThai = array (
			'0' => 'Không cho phép',
			'1' => 'Cho phép' 
	);
	public function __construct() {
		self::$db = Zend_Registry::get ( "db" );
	}
	
	/*
	 * Use Zend_Db_Table
	 */
	public static function getIdNameObj($truonghocid, $namhocid) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$query = self::$db->query ( "SELECT Id, Tendoituong FROM tbldoituongsudung WHERE 
				TruonghocId = $truonghocid AND NamhocId = $namhocid" );
		$result = array ();
		$result = $query->fetchAll ();
		return $result;
	}
	
	/*
	 * Use Zend_Db
	 */
	public static function getFirstNews($DanhMucId = 0) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$query = self::$db->query ( "SELECT Id, TieuDe, Alias , MoTa, HinhAnh FROM tbl_tintuc WHERE
				DanhMucId= $DanhMucId AND TrangTHai = 1 LIMIT 1" );
		
		$result = $query->fetch ();
		return $result;
	}
	public static function getImage($Id = 0) {
		return '/public/uploads/news/' . $Id . '/thumb.jpg';
	}
	public static function getDefaultImage($small = false) {
		if ($small)
			return '/public/websiteyte/img/trash/6.png';
		else
			return '/public/websiteyte/img/trash/24.png';
	}
	public static function checkImage1($image = '') {
		if (@getimagesize ( $image ))
			return true;
		else
			return false;
	}
	public static function checkImage($Id = 0) {
		$validator = new Zend_Validate_File_Exists ();
		$validator->addDirectory ( "public/uploads/news/$Id" );
		if ($validator->isValid ( 'thumb.jpg' )) {
			return true;
		} else {
			return false;
		}
	}
	public static function getTintucByLoai($Loai = 0, $thongtincoquanid = 0) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$query = self::$db->query ( "SELECT Id, TieuDe, Alias , DanhMucId, (select Alias from tbl_danhmuc where Id=DanhMucId) as Cate FROM tbl_tintuc WHERE
				TrangThai = 1 AND Loai = '$Loai' AND ThongtincoquanId = $thongtincoquanid" );
		$result = array ();
		$result = $query->fetchAll ();
		return $result;
	}
	public static function getTinMoi($thongtincoquanid = 0) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$query = self::$db->query ( "SELECT t.Id as Id, t.TieuDe as TieuDe, t.Alias as Alias, t.HinhAnh as HinhAnh, t.TrangThai as TrangThai , t.MoTa as MoTa ,(select Alias from tbl_danhmuc where Id=DanhMucId) as Cate  , d.TrangThai FROM tbl_tintuc as t LEFT JOIN tbl_danhmuc as d ON t.DanhMucId = d.Id WHERE
				t.TrangThai = 1 AND t.TinMoi=1 AND t.ThongtincoquanId = $thongtincoquanid AND d.TrangThai=1 ");
		$result = array ();
		$result = $query->fetchAll ();
		return $result;
	}
	/*
	public static function getTinMoi($thongtincoquanid = 0) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
	
		$query = self::$db->query ( "SELECT Id, TieuDe, Alias, HinhAnh, MoTa ,(select Alias from tbl_danhmuc where Id=DanhMucId) as Cate FROM tbl_tintuc WHERE
				TrangThai = 1 AND TinMoi=1 AND ThongtincoquanId = $thongtincoquanid" );
		$result = array ();
		$result = $query->fetchAll ();
		return $result;
	}
	*/
	public static function getTinTheoDanhMuc($DanhMuc = 0, $limit = 0, $thongtincoquanid = 0) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		$query = self::$db->query ( "SELECT Id, TieuDe, Alias, HinhAnh, NgayTao, MoTa FROM tbl_tintuc WHERE
				TrangThai = 1 AND DanhMucId=$DanhMuc AND ThongtincoquanId = $thongtincoquanid  ORDER BY Id DESC LIMIT $limit" );
		$result = array ();
		$result = $query->fetchAll ();
		return $result;
	}
	public static function getTinLienQuan($DanhMuc = 0, $TinLienQuan = array(), $limit = 0, $thongtincoquanid = 0) {
		$TinLienQuan = implode ( ', ', array_filter ( $TinLienQuan ) );
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$query = self::$db->query ( "SELECT Id, TieuDe, Alias, HinhAnh, NgayTao, MoTa FROM tbl_tintuc WHERE
				TrangThai = 1 AND DanhMucId=$DanhMuc AND ThongtincoquanId = $thongtincoquanid AND Id NOT IN ($TinLienQuan) ORDER BY Id DESC LIMIT $limit" );
		
		$result = array ();
		$result = $query->fetchAll ();
		return $result;
	}
	public static function getFetObj($sort, $order, $offset, $rows, $thongtincoquanid) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$result = array ();
		$query = self::$db->query ( "SELECT COUNT(*) AS Total FROM tbl_tintuc WHERE ThongtincoquanId = $thongtincoquanid" );
		$row = $query->fetchAll ();
		$query = self::$db->query ( "SELECT Id, TieuDe, MoTa, ChiTiet, NgayTao, Loai, DanhMucId, TrangThai
				 FROM tbl_tintuc WHERE ThongtincoquanId = $thongtincoquanid ORDER BY $sort $order LIMIT $offset, $rows" );
		$result ["total"] = $row [0] ['Total'];
		$result ['rows'] = $query->fetchAll ();
		return $result;
	}
	public static function getFetObjByDate($sort, $order, $thongtincoquanid, $date) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$result = array ();
		$query = self::$db->query ( "SELECT Id, Manhanvien, Hoten, (SELECT Chamcong FROM tbltrucca WHERE NhanvienId = tblnhanvien.Id AND Chamcong = 1 AND Ngaythang = '$date') AS ck, 
				(SELECT Lydo FROM tbltrucca WHERE NhanvienId = tblnhanvien.Id AND Chamcong = 1 AND Ngaythang = '$date') AS Lydo FROM tblnhanvien WHERE ThongtincoquanId = $thongtincoquanid 
				AND (Ngayketthuc IS NULL OR Ngayketthuc = '0000-00-00' OR Ngayketthuc > '$date') ORDER BY $sort $order" );
		$result = $query->fetchAll ();
		return $result;
	}
	public static function getObjCombogrid($sort, $order, $offset, $rows, $thongtincoquanid) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$result = array ();
		$query = self::$db->query ( "SELECT COUNT(*) AS Total FROM tblnhanvien WHERE ThongtincoquanId = $thongtincoquanid" );
		$row = $query->fetchAll ();
		$query = self::$db->query ( "SELECT Id, Manhanvien, Hoten, (DATE_FORMAT(Ngaysinh,'%d/%m/%Y')) AS Ngaysinh, Gioitinh, (SELECT Tendantoc FROM tbldm_dantoc WHERE Id = DantocId) AS Dantoc, Mangach, Noiohiennay,
				(SELECT Tenchucvu FROM tbldm_chucvu WHERE Id = ChucvuId) AS Chucvu, Sohieu, IF((Ngayketthuc IS NULL OR Ngayketthuc = '0000-00-00'), '', (DATE_FORMAT(Ngayketthuc,'%d/%m/%Y'))) AS Tinhtrang, CMND,
				(SELECT SosoBHXH FROM tblbaohiem WHERE tblbaohiem.NhanvienId = tblnhanvien.Id AND tblbaohiem.Thongtincoquanid = tblnhanvien.ThongtincoquanId AND BHXH = 1
				ORDER BY Id DESC LIMIT 0, 1) AS SosoBHXH, PhongbanId, (SELECT Tenphongban FROM tbldm_phongban WHERE Id = PhongbanId) AS Tenphongban
				 FROM tblnhanvien WHERE ThongtincoquanId = $thongtincoquanid ORDER BY $sort $order LIMIT $offset, $rows" );
		$result ["total"] = $row [0] ['Total'];
		$result ['rows'] = $query->fetchAll ();
		return $result;
	}
	public static function getObjById($id) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$query = self::$db->query ( "SELECT Id, Manhanvien, Mangach, Sohieu, Hoten, Hinhanh, Tenkhac, (DATE_FORMAT(Ngaysinh,'%d/%m/%Y')) AS Ngaysinh, IF(Gioitinh = 'Nam', 'on', '') AS Gioitinh, Noisinh, CMND, IF(Ngaycap = '0000-00-00', '', (DATE_FORMAT(Ngaycap,'%d/%m/%Y'))) AS Ngaycap, Noicap, QuoctichId, Thuongtru, 
					Noiohiennay, DantocId, TongiaoId, Email, IF(Ngayve = '0000-00-00', '',(DATE_FORMAT(Ngayve,'%d/%m/%Y'))) AS Ngayve, IF(Ngayhopdong = '0000-00-00', '', (DATE_FORMAT(Ngayhopdong,'%d/%m/%Y'))) AS Ngayhopdong, ChucvuId, IF(ChucvukiemnghiemId = 0, '', ChucvukiemnghiemId) AS ChucvukiemnghiemId, IF(ChucdanhId = 0, '', ChucdanhId) AS ChucdanhId, 
					IF(Ngaythangcongnhan = '0000-00-00', '', (DATE_FORMAT(Ngaythangcongnhan,'%d/%m/%Y'))) AS Ngaythangcongnhan, Tinhtranghonnhan, Tpxuatthan, IF(UutienId = 0, '', UutienId) AS UutienId, Quequan, Sotaikhoan, Nganhangmo, IF(Ngaytuyendung = '0000-00-00', '', (DATE_FORMAT(Ngaytuyendung,'%d/%m/%Y'))) AS Ngaytuyendung, Coquantuyendung, 
					IF(PhongbanId = 0, '', PhongbanId) AS PhongbanId, Hinhthuc, IF(Ngaybonhiemvaonganh = '0000-00-00', '', (DATE_FORMAT(Ngaybonhiemvaonganh,'%d/%m/%Y'))) AS Ngaybonhiemvaonganh, IF(LoaicanboId = 0, '', LoaicanboId) AS LoaicanboId, IF(TrinhdoId = 0, '', TrinhdoId) AS TrinhdoId, (SELECT Tentrinhdohocvan FROM tbldm_trinhdohocvan WHERE Id = TrinhdoId) AS Trinhdo, 
					IF(Namtotnghiep = 0, '', Namtotnghiep) AS Namtotnghiep,IF(ChuyennganhId = 0, '', ChuyennganhId) AS ChuyennganhId, Dienthoai, TrinhdovanhoaId, TrinhdongoainguId,
					(SELECT Tentrinhdovanhoa FROM tbldm_trinhdovanhoa WHERE Id = TrinhdovanhoaId) AS Trinhdovanhoa,
					(SELECT Tentrinhdongoaingu FROM tbldm_trinhdongoaingu WHERE Id = TrinhdongoainguId) AS Trinhdongoaingu, Diaban, Dangnhanluc
					FROM tblnhanvien WHERE Id = $id" );
		$result = array ();
		$result = $query->fetchAll ();
		return $result;
	}
	public static function addObj($data) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$id = self::$db->insert ( 'tbl_tintuc', $data );
		return $id;
	}
	
	
	
	public static function updateObj($id, $data) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$id = self::$db->update ( 'tbl_tintuc', $data, 'Id = ' . $id );
		return $id;
	}
	public static function delObj($id) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$id = self::$db->delete ( 'tbl_tintuc', 'Id = ' . $id );
		return $id;
	}
	public static function searObj($hoten, $chucvu, $gioitinh, $manv, $ngaysinh, $dienthoai, $thongtincoquanid, $sort, $order, $offset, $rows) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$result = array ();
		$where = " Hoten LIKE '%$hoten%' ";
		if ($chucvu != '')
			$where = $where . "AND ChucvuId = $chucvu ";
		if ($gioitinh != '' && $gioitinh != 'Tất cả')
			$where = $where . "AND Gioitinh = '$gioitinh' ";
		if ($manv != '')
			$where = $where . "AND Manhanvien LIKE '%$manv%' ";
		if ($ngaysinh != '')
			$where = $where . "AND Ngaysinh = '$ngaysinh' ";
		if ($dienthoai != '')
			$where = $where . "AND Dienthoai LIKE '%$dienthoai%' ";
			// Thuc hien cau lenh truy xuat du lieu
			// Lay tong so ban ghi
		$query = self::$db->query ( "SELECT COUNT(Id) AS Total FROM tblnhanvien WHERE 
				ThongtincoquanId = $thongtincoquanid AND $where" );
		$row = $query->fetchAll ();
		$result ["total"] = $row [0] ['Total'];
		$query = self::$db->query ( "SELECT Id, Manhanvien, Hoten, (DATE_FORMAT(Ngaysinh,'%d/%m/%Y')) AS Ngaysinh, Gioitinh, (SELECT Tendantoc FROM tbldm_dantoc WHERE Id = DantocId) AS Dantoc, 
				(SELECT Tenchucvu FROM tbldm_chucvu WHERE Id = ChucvuId) AS Chucvu, Dienthoai, IF((Ngayketthuc IS NULL OR Ngayketthuc = '0000-00-00'), '', (DATE_FORMAT(Ngayketthuc,'%d/%m/%Y'))) AS Tinhtrang  
				 FROM tblnhanvien WHERE ThongtincoquanId = $thongtincoquanid AND $where 
				ORDER BY $sort $order LIMIT $offset, $rows" );
		
		$result ['rows'] = $query->fetchAll ();
		return $result;
	}
	public static function searObjCombogrid($hoten, $chucvu, $gioitinh, $manv, $ngaysinh, $noio, $dantoc, $thongtincoquanid, $sort, $order, $offset, $rows) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$result = array ();
		$where = " Hoten LIKE '%$hoten%' ";
		if ($chucvu != '')
			$where = $where . "AND ChucvuId IN (SELECT Id FROM tbldm_chucvu WHERE Tenchucvu LIKE '%$chucvu%') ";
		if ($gioitinh != '' && $gioitinh != 'Tất cả')
			$where = $where . "AND Gioitinh LIKE '%$gioitinh%' ";
		if ($manv != '')
			$where = $where . "AND Manhanvien LIKE '%$manv%' ";
		if ($ngaysinh != '')
			$where = $where . "AND Ngaysinh = '$ngaysinh' ";
		if ($noio != '')
			$where = $where . "AND Noiohiennay LIKE '%$noio%' ";
		if ($dantoc != '')
			$where = $where . "AND DantocId IN (SELECT Id FROM tbldm_dantoc WHERE Tendantoc LIKE '%$dantoc%') ";
			// Thuc hien cau lenh truy xuat du lieu
			// Lay tong so ban ghi
		$query = self::$db->query ( "SELECT COUNT(Id) AS Total FROM tblnhanvien WHERE 
				ThongtincoquanId = $thongtincoquanid AND $where" );
		$row = $query->fetchAll ();
		$result ["total"] = $row [0] ['Total'];
		$query = self::$db->query ( "SELECT Id, Manhanvien, Hoten, (DATE_FORMAT(Ngaysinh,'%d/%m/%Y')) AS Ngaysinh, Gioitinh, (SELECT Tendantoc FROM tbldm_dantoc WHERE Id = DantocId) AS Dantoc, Mangach, Noiohiennay,
				(SELECT Tenchucvu FROM tbldm_chucvu WHERE Id = ChucvuId) AS Chucvu, Sohieu, IF((Ngayketthuc IS NULL OR Ngayketthuc = '0000-00-00'), '', (DATE_FORMAT(Ngayketthuc,'%d/%m/%Y'))) AS Tinhtrang  
				 FROM tblnhanvien WHERE ThongtincoquanId = $thongtincoquanid AND $where 
				ORDER BY $sort $order LIMIT $offset, $rows" );
		
		$result ['rows'] = $query->fetchAll ();
		return $result;
	}
	public static function getLastInsertId() {
		return Zend_Registry::get ( "db" )->lastInsertId ();
	}
	public static function dupliObj($id, $TieuDe, $thongtincoquanid) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$query = self::$db->query ( "SELECT COUNT( * ) AS Total FROM tbl_tintuc WHERE TieuDe='$TieuDe' AND ThongtincoquanId = $thongtincoquanid " );
		if ($id != 0) {
			$query = self::$db->query ( "SELECT COUNT( * ) AS Total FROM tbl_tintuc 
				WHERE ThongtincoquanId = $thongtincoquanid AND Id != $id AND TieuDe='$TieuDe'" );
		}
		$row = $query->fetchAll ();
		$total = $row [0] ['Total'];
		return $total;
	}
	
	// hien thi chi tiet cua nhan vien
	public static function getInfobyId($manhanvien) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$result = array ();
		$query = self::$db->query ( "SELECT Id, CMND, DATE_FORMAT(Ngaycap, '%d/%m/%Y') AS Ngaycap, Noicap, Manhanvien,
				Tenkhac, Dienthoai, Email, TrinhdoId, ChuyennganhId, Tinhtranghonnhan, TrinhdovanhoaId,
				Noisinh, Quequan, Thuongtru, Noiohiennay, Tpxuatthan, Hinhanh, TrinhdongoainguId,
				(SELECT Tentrinhdohocvan FROM tbldm_trinhdohocvan WHERE Id = TrinhdoId) AS Tentrinhdo,
				(SELECT Tenchuyennganh FROM tbldm_chuyennganh WHERE Id = ChuyennganhId) AS Tenchuyennganh,
				IF (Namtotnghiep = 0, '', Namtotnghiep) AS Namtotnghiep,
				DATE_FORMAT(Ngayhopdong, '%d/%m/%Y') AS Ngayhopdong, ChucdanhId, ChucvukiemnghiemId, 
				DATE_FORMAT(Ngaytuyendung, '%d/%m/%Y') AS Ngaytuyendung, Coquantuyendung, 
				DATE_FORMAT(Ngayve, '%d/%m/%Y') AS Ngayve, DATE_FORMAT(Ngaythangcongnhan, '%d/%m/%Y') AS Ngaythangcongnhan, 
				PhongbanId, Hinhthuc, DATE_FORMAT(Ngaybonhiemvaonganh, '%d/%m/%Y') AS Ngaybonhiemvaonganh, 
				LoaicanboId, UutienId, Sotaikhoan, Nganhangmo,
				(SELECT Tenchucdanh FROM tbldm_chucdanh WHERE Id = ChucdanhId) AS Tenchucdanh,
				(SELECT Tenchucvu FROM tbldm_chucvu WHERE Id = ChucvukiemnghiemId) AS Tenchucvukiemnghiem,
				(SELECT Tenbophan FROM tbldm_bophan WHERE Id = PhongbanId) AS Tenphongban,
				(SELECT Tenloaicanbo FROM tbldm_loaicanbo WHERE Id = LoaicanboId) AS Tenloaicanbo,
				(SELECT Tenuutien FROM tbldm_uutien WHERE Id = UutienId) AS Tenuutien,
				(SELECT Tentrinhdovanhoa FROM tbldm_trinhdovanhoa WHERE Id = TrinhdovanhoaId) AS Trinhdovanhoa,
				(SELECT Tentrinhdongoaingu FROM tbldm_trinhdongoaingu WHERE Id = TrinhdongoainguId) AS Trinhdongoaingu,
				Diaban, Dangnhanluc
				
				FROM tblnhanvien WHERE Manhanvien = '$manhanvien'" );
		$result = $query->fetchAll ();
		return $result;
	}
	
	// get du lieu in danh sach
	public static function getDSnhanvien($hoten, $chucvu, $gioitinh, $manv, $ngaysinh, $dienthoai, $thongtincoquanid) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$result = array ();
		$where = " Hoten LIKE '%$hoten%' ";
		if ($chucvu != '')
			$where = $where . "AND ChucvuId = $chucvu ";
		if ($gioitinh != '' && $gioitinh != 'Tất cả')
			$where = $where . "AND Gioitinh = '$gioitinh' ";
		if ($manv != '')
			$where = $where . "AND Manhanvien LIKE '%$manv%' ";
		if ($ngaysinh != '')
			$where = $where . "AND Ngaysinh = '$ngaysinh' ";
		if ($dienthoai != '')
			$where = $where . "AND Dienthoai LIKE '%$dienthoai%' ";
			// Thuc hien cau lenh truy xuat du lieu
		$query = self::$db->query ( "SELECT Id, Manhanvien, Hoten, (DATE_FORMAT(Ngaysinh,'%d/%m/%Y')) AS Ngaysinh, Gioitinh, (SELECT Tendantoc FROM tbldm_dantoc WHERE Id = DantocId) AS Dantoc, 
				(SELECT Tenchucvu FROM tbldm_chucvu WHERE Id = ChucvuId) AS Chucvu, Dienthoai,  IF((Ngayketthuc IS NULL OR Ngayketthuc = '0000-00-00'), 'Đang hoạt động', 'Ngừng hoạt động') AS Tinhtrang,
				IF(Gioitinh = 'Nam', YEAR(NOW()) - YEAR(Ngaysinh), '') AS Tuoinam,
				IF(Gioitinh = 'Nu', YEAR(NOW()) - YEAR(Ngaysinh), '') AS Tuoinu   
				 FROM tblnhanvien WHERE ThongtincoquanId = $thongtincoquanid AND $where" );
		$result = $query->fetchAll ();
		return $result;
	}
	
	// get thong tin chi tiet cua nhan vien
	public static function getInfoHoso($id, $thongtincoquanId, $namhoatdong) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$result = array ();
		$query = self::$db->query ( "SELECT Id, Manhanvien, Hoten, Tenkhac, DAY(Ngaysinh) AS Ngaysinh, Hinhanh,
				MONTH(Ngaysinh) AS Thangsinh, YEAR(Ngaysinh) AS Namsinh, Gioitinh, Thuongtru, CMND, 
				Noicap, DAY(Ngaycap) AS Ngaycap, MONTH(Ngaycap) AS Thangcap, YEAR(Ngaycap) AS Namcap, 
				Dienthoai, Noiohiennay, Noisinh, Quequan, DantocId, TongiaoId, Tpxuatthan, TrinhdovanhoaId, TrinhdongoainguId,
				(SELECT Tentrinhdovanhoa FROM tbldm_trinhdovanhoa WHERE Id = TrinhdovanhoaId) AS Trinhdovanhoa,
				(SELECT Tentrinhdongoaingu FROM tbldm_trinhdongoaingu WHERE Id = TrinhdongoainguId) AS Trinhdongoaingu,
				(SELECT Noiketnapdang FROM tbldoandang WHERE NhanvienId = Id) AS Noiketnapdang,
				(SELECT Noiketnapdoan FROM tbldoandang WHERE NhanvienId = Id) AS Noiketnapdoan, 
				(SELECT Tendantoc FROM tbldm_dantoc WHERE Id = DantocId) AS Tendantoc,
				(SELECT Tentongiao FROM tbldm_tongiao WHERE Id = TongiaoId) AS Tongiao,
				(SELECT Tentongiao FROM tbldm_tongiao WHERE Id = TongiaoId) AS Tongiao,
				(SELECT DAY(Ngaychinhthuc) FROM tbldoandang WHERE NhanvienId = Id) AS Ngayvaodang,
				(SELECT MONTH(Ngaychinhthuc) FROM tbldoandang WHERE NhanvienId = Id) AS Thangvaodang,
				(SELECT YEAR(Ngaychinhthuc) FROM tbldoandang WHERE NhanvienId = Id) AS Namvaodang,
				(SELECT DAY(Ngayvaodoan) FROM tbldoandang WHERE NhanvienId = Id) AS Ngayvaodoan,
				(SELECT MONTH(Ngayvaodoan) FROM tbldoandang WHERE NhanvienId = Id) AS Thangvaodoan,
				(SELECT YEAR(Ngayvaodoan) FROM tbldoandang WHERE NhanvienId = Id) AS Namvaodoan,
				(SELECT Hoten FROM tblquanhe WHERE NhanvienId = tblnhanvien.Id AND QuanheId IN (SELECT Id FROM tbldm_quanhe WHERE Tenquanhe LIKE '%Bố%')) AS Hotenbo,
				(SELECT $namhoatdong - Namsinh FROM tblquanhe WHERE NhanvienId = tblnhanvien.Id AND QuanheId IN (SELECT Id FROM tbldm_quanhe WHERE Tenquanhe LIKE '%Bố%')) AS Tuoibo,
				(SELECT Namsinh FROM tblquanhe WHERE NhanvienId = tblnhanvien.Id AND Quanheid IN (SELECT Id FROM tbldm_quanhe WHERE Tenquanhe LIKE '%Bố%')) AS Namsinhcuabo,
				(SELECT Namsinh FROM tblquanhe WHERE NhanvienId = tblnhanvien.Id AND QuanheId IN (SELECT Id FROM tbldm_quanhe WHERE Tenquanhe LIKE '%Bố%')) AS Namsinhbo,
				(SELECT Quequan FROM tblquanhe WHERE NhanvienId = tblnhanvien.Id AND QuanheId IN (SELECT Id FROM tbldm_quanhe WHERE Tenquanhe LIKE '%Bố%')) AS Quequanbo,
				(SELECT Nghenghiep FROM tblquanhe WHERE NhanvienId = tblnhanvien.Id AND QuanheId IN (SELECT Id FROM tbldm_quanhe WHERE Tenquanhe LIKE '%Bố%')) AS Nghenghiepbo,
				(SELECT Hoten FROM tblquanhe WHERE NhanvienId = tblnhanvien.Id AND QuanheId IN (SELECT Id FROM tbldm_quanhe WHERE Tenquanhe LIKE '%Mẹ%')) AS Hotenme,
                (SELECT $namhoatdong - Namsinh FROM tblquanhe WHERE NhanvienId = tblnhanvien.Id AND QuanheId IN (SELECT Id FROM tbldm_quanhe WHERE Tenquanhe LIKE '%Mẹ%')) AS Tuoime,
                (SELECT Namsinh FROM tblquanhe WHERE NhanvienId = tblnhanvien.Id AND QuanheId IN (SELECT Id FROM tbldm_quanhe WHERE Tenquanhe LIKE '%Mẹ%')) AS Namsinhcuame,
               	(SELECT Quequan FROM tblquanhe WHERE NhanvienId = tblnhanvien.Id AND QuanheId IN (SELECT Id FROM tbldm_quanhe WHERE Tenquanhe LIKE '%Mẹ%')) AS Quequanme,
				(SELECT Nghenghiep FROM tblquanhe WHERE NhanvienId = tblnhanvien.Id AND QuanheId IN (SELECT Id FROM tbldm_quanhe WHERE Tenquanhe LIKE '%Mẹ%')) AS Nghenghiepme,
				(SELECT Hoten FROM tblquanhe WHERE NhanvienId = tblnhanvien.Id AND QuanheId IN (SELECT Id FROM tbldm_quanhe WHERE Tenquanhe LIKE '%Vợ%')) AS Hotenvo,
				(SELECT $namhoatdong - Namsinh FROM tblquanhe WHERE NhanvienId = tblnhanvien.Id AND QuanheId IN (SELECT Id FROM tbldm_quanhe WHERE Tenquanhe LIKE '%Vợ%')) AS Tuoivo,
				(SELECT Quequan FROM tblquanhe WHERE NhanvienId = tblnhanvien.Id AND QuanheId IN (SELECT Id FROM tbldm_quanhe WHERE Tenquanhe LIKE '%Vợ%')) AS Quequanvo,
				(SELECT Nghenghiep FROM tblquanhe WHERE NhanvienId = tblnhanvien.Id AND QuanheId IN (SELECT Id FROM tbldm_quanhe WHERE Tenquanhe LIKE '%Vợ%')) AS Nghenghiepvo
				FROM tblnhanvien WHERE Id = $id AND ThongtincoquanId = $thongtincoquanId" );
		$result = $query->fetchAll ();
		return $result;
	}
	
	// get thong tin chi tiet quan he con cua nhan vien
	public static function getQuanheHoso($id, $thongtincoquanId, $namhoatdong) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$result = array ();
		$query = self::$db->query ( "SELECT Hoten, $namhoatdong-Namsinh AS Tuoicon, Nghenghiep FROM tblquanhe
				WHERE NhanvienId = $id AND ThongtincoquanId = $thongtincoquanId AND 
				QuanheId IN (SELECT Id FROM tbldm_quanhe WHERE Tenquanhe LIKE '%Con%')" );
		$result = $query->fetchAll ();
		return $result;
	}
	
	// get thong tin chi tiet quan he anh em cua nhan vien
	public static function getQuanheAnhEm($id, $thongtincoquanId, $namhoatdong) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$result = array ();
		$query = self::$db->query ( "SELECT Hoten, $namhoatdong-Namsinh AS Tuoi, Quequan, Nghenghiep FROM tblquanhe
				WHERE NhanvienId = $id AND ThongtincoquanId = $thongtincoquanId AND
				QuanheId IN (SELECT Id FROM tbldm_quanhe WHERE Tenquanhe LIKE '%Anh%' OR Tenquanhe LIKE '%Em%')" );
		$result = $query->fetchAll ();
		return $result;
	}
	
	// get thong tin chi tiet qua trinh cong tac cua nhan vien
	public static function getquatrinhcongtac($id, $thongtincoquanId) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$result = array ();
		$query = self::$db->query ( "SELECT Id, NhanvienId, DATE_FORMAT(Tungay, '%d/%m/%Y') AS Tungay, 
				DATE_FORMAT(Denngay, '%d/%m/%Y') AS Denngay, Congviec, Chucvu
				FROM tblquatrinhcongtac WHERE NhanvienId = $id AND ThongtincoquanId = $thongtincoquanId" );
		$result = $query->fetchAll ();
		return $result;
	}
	// danh sach thong tin tang giam muc bao hiem y te cua nhan vien
	public static function danhsachdieuchinhbh($thongtincoquanid) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$result = array ();
		$query = self::$db->query ( "SELECT tblnhanvien.Hoten, DATE_FORMAT(tblnhanvien.Ngaysinh,'%d/%m/%Y') AS Ngaysinh, tblnhanvien.Gioitinh,
				 DATE_FORMAT(tblbaohiem.Tungay,'%m') AS Tungay, DATE_FORMAT(tblbaohiem.Denngay,'%m') AS Denngay
				 FROM tblnhanvien INNER JOIN tblbaohiem ON tblnhanvien.Id= tblbaohiem.NhanvienId 
				WHERE tblnhanvien.ThongtincoquanId='$thongtincoquanid'" );
		$result = $query->fetchAll ();
		return $result;
	}
	public static function denghithaydoibh($thongtincoquanid) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$result = array ();
		$query = self::$db->query ( "
				SELECT tblnhanvien.Hoten, DATE_FORMAT( tblnhanvien.Ngaysinh, '%d/%m/%Y' ) AS Ngaysinh, 
					tblnhanvien.Gioitinh, DATE_FORMAT( tblbaohiem.Tungay, '%d/%m/%Y' ) AS Tungay, 
					DATE_FORMAT( tblbaohiem.Denngay, '%d/%m/%Y' ) AS Denngay, tblbaohiem.SotheBHYT, 
					tblbaohiem.Ghichu, tblbaohiem.NoidangkyKCB
				FROM tblnhanvien
					INNER JOIN tblbaohiem ON tblnhanvien.Id = tblbaohiem.NhanvienId
				WHERE tblbaohiem.BHYT =1 AND tblbaohiem.SotheBHYT IS NOT NULL
					AND tblbaohiem.ghichu IS NOT NULL AND tblnhanvien.ThongtincoquanId='$thongtincoquanid'" );
		$result = $query->fetchAll ();
		return $result;
	}
	public static function dsthamgiabhxhtunguyen($thongtincoquanid) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$result = array ();
		$query = self::$db->query ( "SELECT tblnhanvien.Hoten, DATE_FORMAT(tblnhanvien.Ngaysinh,'%d/%m/%Y') AS Ngaysinh, tblnhanvien.Gioitinh,
				DATE_FORMAT(tblbaohiem.Tungay,'%d/%m/%Y') AS Tungay, DATE_FORMAT(tblbaohiem.Denngay,'%d/%m/%Y') AS Denngay
				 FROM tblnhanvien INNER JOIN tblbaohiem ON tblnhanvien.Id= tblbaohiem.NhanvienId
				WHERE tblnhanvien.ThongtincoquanId='$thongtincoquanid'" );
		$result = $query->fetchAll ();
		return $result;
	}
	public static function dschithamgiabhyt($thongtincoquanid) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$result = array ();
		$query = self::$db->query ( "SELECT tblnhanvien.Hoten, DATE_FORMAT(tblnhanvien.Ngaysinh,'%d/%m/%Y') AS Ngaysinh, tblnhanvien.Gioitinh, tblnhanvien.Thuongtru, tblnhanvien.CMND,
				DATE_FORMAT(tblbaohiem.Tungay,'%d/%m/%Y') AS Tungay, DATE_FORMAT(tblbaohiem.Denngay,'%m') AS Denngay,
				tblbaohiem.Sotien, tblbaohiem.NoidangkyKCB FROM tblnhanvien INNER JOIN tblbaohiem ON tblnhanvien.Id= tblbaohiem.NhanvienId
				WHERE tblnhanvien.ThongtincoquanId=$thongtincoquanid" );
		$result = $query->fetchAll ();
		return $result;
	}
	public static function getcombonhansubybophanObj($bophanId, $thongtincoquanId, $sort, $order, $offset, $rows) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$result = array ();
		$query = self::$db->query ( "SELECT COUNT(*) AS Total FROM tblnhanvien WHERE PhongbanId = $bophanId AND PhongbanId<>0 and ThongtincoquanId = $thongtincoquanId" );
		$row = $query->fetchAll ();
		$query = self::$db->query ( "SELECT Id, Hoten, (DATE_FORMAT(Ngaysinh,'%d/%m/%Y')) AS Ngaysinh,
				PhongbanId, (SELECT Tenphongban FROM tbldm_phongban WHERE Id = PhongbanId) AS Tenphongban,
				IF((Ngayketthuc IS NULL OR Ngayketthuc = '0000-00-00'), '', (DATE_FORMAT(Ngayketthuc,'%d/%m/%Y'))) AS Tinhtrang
				FROM tblnhanvien WHERE PhongbanId = $bophanId 
				AND PhongbanId<>0 and  ThongtincoquanId = $thongtincoquanId ORDER BY $sort $order LIMIT $offset, $rows  " );
		$result ["total"] = $row [0] ['Total'];
		$result ["rows"] = $query->fetchAll ();
		return $result;
	}
	public static function getIdObj($thongtincoquanId) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$result = array ();
		$query = self::$db->query ( "SELECT Manhanvien AS Id FROM tblnhanvien WHERE ThongtincoquanId = $thongtincoquanId ORDER BY Id DESC LIMIT 0, 1" );
		$result = $query->fetchAll ();
		return $result;
	}
	public static function getLink($cate = '', $Alias = '') {
		if ($cate != '')
			return 'tintuc/' . $cate . '/' . $Alias . '.html';
		else
			return 'tintuc/' . $Alias . '.html';
	}
	
	
	public static function getByAlias($Alias = '', $thongtincoquanId = 0) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
	
		$result = array ();
		$query = self::$db->query ( "SELECT  t.Id as Id, t.TieuDe as TieuDe, t.ChiTiet as ChiTiet, t.HinhAnh as HinhAnh, t.NgayTao as NgayTao, t.MoTa as MoTa, t.DanhMucId as DanhMucId, d.Id as dId, d.TrangThai as dTrangThai FROM tbl_tintuc AS t LEFT JOIN tbl_danhmuc AS d ON t.DanhMucId=d.Id WHERE  t.ThongtincoquanId = $thongtincoquanId AND d.TrangThai = 1 AND t.Alias = '$Alias' " );
		$result = $query->fetch();
		return $result;
	}
	
	public static function getByCate($cate = '', $thongtincoquanId = 0) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		$result = array ();
		$query = self::$db->query ( "SELECT Id, TieuDe, ChiTiet, HinhAnh, NgayTao, Alias, MoTa FROM tbl_tintuc WHERE ThongtincoquanId = $thongtincoquanId AND TrangThai=1 AND DanhMucId= $cate ORDER BY Id DESC " );
		$result = $query->fetchAll ();
		return $result;
	}
	public static function getByCatePagi($cate = '', $RecordPerPage = 10, $Page = 1, $thongtincoquanId = 0) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		$result = array ();
		// $RecordPerPage = 4;
		$select = self::$db->select ()->from ( 'tbl_tintuc' );
		$select->where ( 'TrangThai=?', 1 );
		$select->where ( 'DanhMucId=?', 18 );
		$adapter = new Zend_Paginator_Adapter_DbSelect ( $select );
		$paginator = new Zend_Paginator ( $adapter );
		$paginator->setItemCountPerPage ( $RecordPerPage );
		$paginator->setCurrentPageNumber ( $Page );
		return $paginator;
	}
	public static function getByCatePagia($cate = 0, $RecordPerPage = 10, $Page = 1, $thongtincoquanId = 0) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		if(!$cate)
			$cate = 0;
		$result = array ();
		
		$query = self::$db->query ( "SELECT Id, TieuDe, ChiTiet, HinhAnh, NgayTao, Alias, MoTa FROM tbl_tintuc WHERE ThongtincoquanId = $thongtincoquanId AND TrangThai=1 AND DanhMucId= $cate ORDER BY Id DESC " );
		$result = $query->fetchAll ();
		/*
		 * $adapter = new Zend_Paginator_Adapter_DbSelect($select); $paginator =
		 * new Zend_Paginator($adapter);
		 * $paginator->setItemCountPerPage($RecordPerPage);
		 * $paginator->setCurrentPageNumber($Page);
		 */
		
		$paginator = Zend_Paginator::factory ( $result );
		$paginator->setCurrentPageNumber ( $Page );
		$paginator->setItemCountPerPage ( $RecordPerPage );
		return $paginator;
	}
	public static function getTinOderBy($cate = '', $orderBy = '', $limit = 10, $thongtincoquanId = 0) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$result = array ();
		if ($cate != '')
			$query = self::$db->query ( "SELECT t.Id as Id, t.TieuDe as TieuDe, t.ChiTiet as ChiTiet, t.HinhAnh as HinhAnh, t.NgayTao as NgayTao, t.Alias as Alias, t.MoTa as MoTa   FROM tbl_tintuc as t LEFT JOIN tbl_danhmuc as d ON t.DanhMucId = d.Id WHERE t.ThongtincoquanId = $thongtincoquanId AND t.TrangThai=1 AND t.DanhMucId= $cate AND d.TrangThai =1  ORDER BY $orderBy LIMIT $limit" );
		else
			$query = self::$db->query ( "SELECT t.Id as Id, t.TieuDe as TieuDe, t.ChiTiet as ChiTiet, t.HinhAnh as HinhAnh, t.DanhMucId as DanhMucId, t.NgayTao as NgayTao, t.Alias as Alias, t.MoTa as MoTa , (Select Alias FROM tbl_danhmuc WHERE Id=DanhMucId) as Cate FROM tbl_tintuc as t LEFT JOIN tbl_danhmuc as d ON t.DanhMucId = d.Id WHERE t.ThongtincoquanId = $thongtincoquanId AND t.TrangThai=1 AND d.TrangThai=1 ORDER BY $orderBy LIMIT $limit" );
		$result = $query->fetchAll ();
		return $result;
	}
}