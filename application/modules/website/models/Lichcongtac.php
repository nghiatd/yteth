<?php
/*
 * Created By Daitk 1, Zend_Db
 */
class Website_Model_Lichcongtac {
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
	
	// Lay Id va Ten
	public static function getIdName() {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		$query = self::$db->query ( 'SELECT Id, TieuDe FROM tbl_danhmuc' );
		$result = array ();
		$result = $query->fetchAll ();
		return $result;
	}
	public static function getIdNameById($_id) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		$query = self::$db->query ( 'SELECT Id, TieuDe FROM tbl_danhmuc WHERE Id = ' . $_id );
		$result = array ();
		$result = $query->fetchAll ();
		return $result;
	}
	
	/*
	 * Use Zend_Db
	 */
	public static function getFetObj($sort, $order, $offset, $rows, $thongtincoquanid) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$result = array ();
		$query = self::$db->query ( "SELECT COUNT(*) AS Total FROM tbl_lichcongtac WHERE ThongtincoquanId = $thongtincoquanid" );
		$row = $query->fetchAll ();
		$query = self::$db->query ( "SELECT Id, TieuDe, TrangThai, File as F, NgayTao,
				
				if(TrangThai=1, 'Cho Phép', 'Không cho phép') as T
				
				 FROM tbl_lichcongtac WHERE ThongtincoquanId = $thongtincoquanid ORDER BY $sort $order LIMIT $offset, $rows" );
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
		
		$id = self::$db->insert ( 'tbl_lichcongtac', $data );
		return $id;
	}
	public static function updateObj($id, $data) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$id = self::$db->update ( 'tbl_lichcongtac', $data, 'Id = ' . $id );
		return $id;
	}
	public static function delObj($id) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$id = self::$db->delete ( 'tbl_lichcongtac', 'Id = ' . $id );
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
	public static function dupliObj($id, $File, $thongtincoquanid) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$query = self::$db->query ( "SELECT COUNT( * ) AS Total FROM tbl_lichcongtac
				WHERE File='$File' AND ThongtincoquanId = $thongtincoquanid " );
		if ($id != 0) {
			$query = self::$db->query ( "SELECT COUNT( * ) AS Total FROM tbl_lichcongtac 
				WHERE ThongtincoquanId = $thongtincoquanid AND Id != $id AND TieuDe='$File'" );
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
	public static function getLienKet($thongtincoquanId) {
		if (self::$db == null) {
			self::$db = Zend_Registry::get ( "db" );
		}
		
		$result = array ();
		$query = self::$db->query ( "SELECT HinhAnh, Link , Id FROM tbl_lienket WHERE ThongtincoquanId = $thongtincoquanId AND TrangThai='Cho Phép' ORDER BY SapXep, Id" );
		$result = $query->fetchAll ();
		return $result;
	}
	public static function getLink($Id = 0) {
		return 'public/uploads/' . $Id . '/thumb.jpg';
	}
	public static function getLastInsertId() {
		return Zend_Registry::get ( "db" )->lastInsertId ();
	}
}