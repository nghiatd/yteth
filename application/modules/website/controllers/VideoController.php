<?php
/**
 * Create By Daitk
 */
//include ("library/PHPExcel/PHPEXCHelper.php");
///**
// * PHPExcel
// */
//include APPLICATION_PATH . '//modules/default/controllers/HelpFuncExportExcel.php';
//require_once 'library/PHPExcel/PHPExcel.php';
include_once APPLICATION_PATH . '//modules/default/controllers/PublicdetailController.php';
/**
 * PHPExcel_IOFactory
 */
//require_once 'library/PHPExcel/PHPExcel/IOFactory.php';
class Website_VideoController extends PublicdetailController {
	private $_ThongtincoquanId;
	private $_MHistory;
	public function init() {
//		$this->initValue ();
//		$this->_ThongtincoquanId = $this->TblThongtincoquanbyId [0] ['Id'];
//
//		$this->_MHistory = new Model_History ();
        $this->_ThongtincoquanId = 6;
	}
	public function indexAction() {

	}
	public function jsonAction() {
		$this->_helper->layout ()->disableLayout ();
		$page = isset ( $_POST ['page'] ) ? intval ( $_POST ['page'] ) : 1;
		$rows = isset ( $_POST ['rows'] ) ? intval ( $_POST ['rows'] ) : 10;
		$sort = isset ( $_POST ['sort'] ) ? strval ( $_POST ['sort'] ) : 'Id';
		$order = isset ( $_POST ['order'] ) ? strval ( $_POST ['order'] ) : 'desc';
		$offset = ($page - 1) * $rows;

		$jsonObj = json_encode ( Website_Model_Video::getFetObj ( $sort, $order, $offset, $rows, $this->_ThongtincoquanId ) );
		return $this->view->jsonObj = $jsonObj;
	}


	public function setValue() {
		$data = array ();
		$data ['TieuDe'] = $_REQUEST ['TieuDe'];
		$data ['ThongtincoquanId'] = $this->_ThongtincoquanId;
		$trangThai = isset ( $_REQUEST ['TrangThai'] ) ? $_REQUEST ['TrangThai'] : '0';
		$data ['TrangThai'] = $trangThai;
		return $data;
	}
	private function getImages($imgDir = '', $File = null) {

		if (! is_dir ( $imgDir )) {
			mkdir ( $imgDir, 0777 );
		}
		$image = new Zend_Form_Element_File ( 'Video' );
		$image->setDestination ( $imgDir );
		$image->addValidator ( 'Extension', false, 'mp4, avi, swf' );
		$image->addFilter ( 'rename', $File );
		$image->receive ();
	}

    protected function getFileName($file = null){
        $FileName = explode('.', $file);
        return PublicdetailController::create_slug($FileName[0]).'.'.$FileName[1];
    }
	public function addAction() {
		$this->_helper->layout ()->disableLayout ();
        $this->_helper->viewRenderer->setNoRender(true);
		$jsonObj = array ();
		$data = $this->setValue ();

        if($_FILES['Video']['name'])
            $data ['Video'] = $this->getFileName($_FILES['Video']['name']);
        else
            $data ['Video'] = '';
        if($data['Video'] != ''){
            $dup = Website_Model_Video::dupliObj(0, $data['Video'], $data ['ThongtincoquanId']);
            if($dup > 0){
                $jsonObj ["msg"] = 'Video đã tồn tại!';
                $jsonObj ["success"] = false;
                echo json_encode($jsonObj);
                return;
            }
        }

		if (!($data['TieuDe'])) {
			$jsonObj ["msg"] = 'Bạn chưa chọn tiêu đề!';
			$jsonObj ["success"] = false;
		} else {
			Website_Model_Video::addObj ( $data );

			if ($_FILES ['Video'] ['name']) {
				$imgDir = APPLICATION_PATH . "/../public/uploads/videos/" . Website_Model_Video::getLastInsertId () . "/";
				$this->getImages ( $imgDir , $data ['Video']);
			}
			
			$jsonObj ["msg"] = 'Cập nhật dữ liệu thành công!';
			$jsonObj ["success"] = true;
		}
		
		echo json_encode ( $jsonObj );
	}
	public function updateAction() {
		$this->_helper->layout ()->disableLayout ();
		$id = $this->_getParam ( 'Id' );
		$data = $this->setValue ();
        if($_FILES['Video']['name'])
            $data ['Video'] = $this->getFileName($_FILES['Video']['name']);
        else
            $data ['Video'] = $this->getRequest()->getParam('Video');
        if($data['Video'] != ''){
            $dup = Website_Model_Video::dupliObj($id, $data['Video'], $data ['ThongtincoquanId']);
            if($dup > 0){
                $jsonObj ["msg"] = 'Video đã tồn tại!';
                $jsonObj ["success"] = false;
                echo json_encode($jsonObj);
                return;
            }
        }

        if (!($data['TieuDe'])) {
            $jsonObj ["msg"] = 'Bạn chưa chọn tiêu đề!';
            $jsonObj ["success"] = false;
        } else {
            print_r($data);die;
            Website_Model_Video::updateObj ( $id, $data );

            if ($_FILES ['Video'] ['name']) {
                $imgDir = APPLICATION_PATH . "/../public/uploads/videos/" . $id . "/";
                $this->getImages ( $imgDir , $data ['Video']);
            }

            $jsonObj ["msg"] = 'Cập nhật dữ liệu thành công!';
            $jsonObj ["success"] = true;
        }

        echo json_encode ( $jsonObj );
	}
	public function delAction() {
		$this->_helper->layout ()->disableLayout ();
		$items = $this->_getParam ( 'items' );
		
		if (count ( $items )) {
			foreach ( $items as $value ) {
				if (isset ( $value ['Id'] ) && $value ['Id'] > 0)
					Website_Model_Lienket::delObj ( $value ['Id'] );
			}
			$jsonObj ["msg"] = 'Cập nhật dữ liệu  thành công!';
			$jsonObj ["success"] = true;
		} else {
			$jsonObj ["msg"] = 'Cập nhật dữ liệu không thành công!';
			$jsonObj ["success"] = false;
		}
		return $this->view->jsonObj = json_encode ( $jsonObj );
	}
	public function changetrangthaiAction() {
		$this->_helper->layout ()->disableLayout ();
		$data = array ();
		$id = $_REQUEST ['NhanvienId'];
		$data ['Ngayketthuc'] = isset ( $_REQUEST ['Ngayketthuc'] ) ? $this->convertDate ( $_REQUEST ['Ngayketthuc'] ) : '';
		Nhansu_Model_Nhanvien::updateObj ( $id, $data );
		$jsonObj ["msg"] = 'Cập nhật dữ liệu thành công!';
		$jsonObj ["success"] = true;
		return $this->view->jsonObj = json_encode ( $jsonObj );
	}
	public function combogridAction() {
		$this->_helper->layout ()->disableLayout ();
		$page = isset ( $_POST ['page'] ) ? intval ( $_POST ['page'] ) : 1;
		$rows = isset ( $_POST ['rows'] ) ? intval ( $_POST ['rows'] ) : 10;
		$sort = isset ( $_POST ['sort'] ) ? strval ( $_POST ['sort'] ) : 'Id';
		$order = isset ( $_POST ['order'] ) ? strval ( $_POST ['order'] ) : 'desc';
		$offset = ($page - 1) * $rows;
		$jsonObj = json_encode ( Nhansu_Model_Nhanvien::getObjCombogrid ( $sort, $order, $offset, $rows, $this->_ThongtincoquanId ) );
		return $this->view->jsonObj = $jsonObj;
	}
	public function combogridtoolbarAction() {
	}
	public function searAction() {
		$this->_helper->layout ()->disableLayout ();
		$page = isset ( $_POST ['page'] ) ? intval ( $_POST ['page'] ) : 1;
		$rows = isset ( $_POST ['rows'] ) ? intval ( $_POST ['rows'] ) : 10;
		$sort = isset ( $_POST ['sort'] ) ? strval ( $_POST ['sort'] ) : 'Id';
		$order = isset ( $_POST ['order'] ) ? strval ( $_POST ['order'] ) : 'desc';
		$offset = ($page - 1) * $rows;
		$hoten = $this->_getParam ( 'sHoten' );
		$chucvu = $this->_getParam ( 'sChucvu' );
		$gioitinh = $this->_getParam ( 'sGioitinh' );
		$manv = $this->_getParam ( 'sManv' );
		$ngaysinh = $this->_getParam ( 'sNgaysinh' );
		$dienthoai = $this->_getParam ( 'sDienthoai' );
		if ($ngaysinh != '') {
			$ngaysinh = $this->convertDateSearch ( $ngaysinh );
		}
		$jsonObj = json_encode ( Nhansu_Model_Nhanvien::searObj ( $hoten, $chucvu, $gioitinh, $manv, $ngaysinh, $dienthoai, $this->_ThongtincoquanId, $sort, $order, $offset, $rows ) );
		return $this->view->jsonObj = $jsonObj;
	}
	public function searcombogridAction() {
		$this->_helper->layout ()->disableLayout ();
		$page = isset ( $_POST ['page'] ) ? intval ( $_POST ['page'] ) : 1;
		$rows = isset ( $_POST ['rows'] ) ? intval ( $_POST ['rows'] ) : 10;
		$sort = isset ( $_POST ['sort'] ) ? strval ( $_POST ['sort'] ) : 'Id';
		$order = isset ( $_POST ['order'] ) ? strval ( $_POST ['order'] ) : 'desc';
		$offset = ($page - 1) * $rows;
		$hoten = $this->_getParam ( 'sHoten' );
		$chucvu = $this->_getParam ( 'sChucvu' );
		$gioitinh = $this->_getParam ( 'sGioitinh' );
		$manv = $this->_getParam ( 'sManv' );
		$ngaysinh = $this->_getParam ( 'sNgaysinh' );
		$noio = $this->_getParam ( 'sNoio' );
		$dantoc = $this->_getParam ( 'sDantoc' );
		if ($ngaysinh != '') {
			$ngaysinh = $this->convertDateSearch ( $ngaysinh );
		}
		$jsonObj = json_encode ( Nhansu_Model_Nhanvien::searObjCombogrid ( $hoten, $chucvu, $gioitinh, $manv, $ngaysinh, $noio, $dantoc, $this->_ThongtincoquanId, $sort, $order, $offset, $rows ) );
		return $this->view->jsonObj = $jsonObj;
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
	
	/**
	 * Phadh
	 * hien thi chi tiet nhan vien
	 */
	public function detailAction() {
		$this->_helper->layout ()->disableLayout ();
		$manhanvien = $this->_getParam ( 'Manhanvien' );
		$jsonObj = array ();
		$jsonObj = Nhansu_Model_Nhanvien::getInfobyId ( $manhanvien );
		return $this->view->jsonObj = $jsonObj;
	}
	
	/**
	 * Phadh
	 * in danh sach nhan vien
	 */
	public function danhsachnhanvienAction() {
		$this->_helper->layout ()->disableLayout ();
		// dieu kien tim kiem
		$hoten = $this->_getParam ( 'sHoten' );
		$chucvu = $this->_getParam ( 'sChucvu' );
		$gioitinh = $this->_getParam ( 'sGioitinh' );
		$manv = $this->_getParam ( 'sManv' );
		$ngaysinh = $this->_getParam ( 'sNgaysinh' );
		$dienthoai = $this->_getParam ( 'sDienthoai' );
		if ($ngaysinh != '') {
			$ngaysinh = $this->convertDateSearch ( $ngaysinh );
		}
		// ///////////////////
		$helpExport = new HelpFuncExportExcel ();
		$objReader = PHPExcel_IOFactory::createReader ( "Excel5" );
		$colIndex = '';
		$rowIndex = 0;
		$objPHPExcel = new PHPExcel ();
		$sheet = $objPHPExcel->getActiveSheet ();
		/*
		 * Bắt đầu set các giá trị, căn chỉnh style Bắt đầu set các giá trị
		 * tĩnh.
		 */
		$sheet->setCellValue ( 'A1', mb_strtoupper ( $this->TblThongtincoquanbyId [0] ['Tencoquan'], 'UTF-8' ) );
		$sheet->mergeCellsByColumnAndRow ( 0, 1, 3, 1 );
		$helpExport->setStyle_12_TNR_N_L ( $sheet, 'A1', 'A1' );
		
		$sheet->setCellValue ( 'A3', 'DANH SÁCH NHÂN VIÊN' );
		$sheet->mergeCellsByColumnAndRow ( 0, 3, 8, 3 );
		$helpExport->setStyle_14_TNR_B_C ( $sheet, 'A3', 'A3' );
		/**
		 * ******
		 */
		
		$rowStart = 5;
		$colStart = 'A';
		$rowIndex = $rowStart;
		$colIndex = $colStart;
		$sheet = $objPHPExcel->getActiveSheet ();
		$sheet->getColumnDimension ( 'A' )->setWidth ( 5 );
		$sheet->getColumnDimension ( 'B' )->setWidth ( 16.86 );
		$sheet->getColumnDimension ( 'C' )->setWidth ( 28.57 );
		$sheet->getColumnDimension ( 'D' )->setWidth ( 10 );
		$sheet->getColumnDimension ( 'E' )->setWidth ( 10 );
		$sheet->getColumnDimension ( 'F' )->setWidth ( 15 );
		$sheet->getColumnDimension ( 'G' )->setWidth ( 15 );
		$sheet->getColumnDimension ( 'H' )->setWidth ( 15 );
		$sheet->getColumnDimension ( 'I' )->setWidth ( 15 );
		$sheet->getRowDimension ( '1' )->setRowHeight ( 21 );
		$sheet->getRowDimension ( '3' )->setRowHeight ( 25.5 );
		
		// set tieu de cho tung cot//
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'STT', $colIndex );
		$sheet->mergeCellsByColumnAndRow ( 0, $rowIndex, 0, ($rowIndex + 1) );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Mã nhân viên', $colIndex );
		$sheet->mergeCellsByColumnAndRow ( 1, $rowIndex, 1, ($rowIndex + 1) );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Họ tên', $colIndex );
		$sheet->mergeCellsByColumnAndRow ( 2, $rowIndex, 2, ($rowIndex + 1) );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Tuổi', 'E' );
		$sheet->mergeCellsByColumnAndRow ( 3, $rowIndex, 4, $rowIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Ngày sinh', $colIndex );
		$sheet->mergeCellsByColumnAndRow ( 5, $rowIndex, 5, ($rowIndex + 1) );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Chức vụ', $colIndex );
		$sheet->mergeCellsByColumnAndRow ( 6, $rowIndex, 6, ($rowIndex + 1) );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Điện thoại', $colIndex );
		$sheet->mergeCellsByColumnAndRow ( 7, $rowIndex, 7, ($rowIndex + 1) );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Tình trạng', $colIndex );
		$sheet->mergeCellsByColumnAndRow ( 8, $rowIndex, 8, ($rowIndex + 1) );
		$helpExport->setStyle_11_TNR_B_C ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
		
		$sheet->setCellValue ( 'D6', 'Nam' );
		$sheet->setCellValue ( 'E6', 'Nữ' );
		$helpExport->setStyle_11_TNR_B_C ( $sheet, 'D6', 'E6' );
		// ////////////////////////
		
		// /set so thu tu cho tung cot//
		$rowIndex += 2;
		$colIndex = $colStart;
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '1', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '2', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '3', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '4', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '5', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '6', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '7', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '8', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '9', $colIndex );
		$helpExport->setStyle_10_TNR_I_C ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
		// //////////////////////////////////
		
		// lay du lieu////////////////
		$jsonObj = Nhansu_Model_Nhanvien::getDSnhanvien ( $hoten, $chucvu, $gioitinh, $manv, $ngaysinh, $dienthoai, $this->TblThongtincoquanbyId [0] ['Id'] );
		if (count ( $jsonObj ) > 0) {
			$stt = 0;
			foreach ( $jsonObj as $row ) {
				$rowIndex += 1;
				$stt ++;
				$colIndex = $colStart;
				$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $stt, $colIndex );
				$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row ['Manhanvien'], $colIndex );
				$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row ['Hoten'], $colIndex );
				$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row ['Tuoinam'], $colIndex );
				$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row ['Tuoinu'], $colIndex );
				$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row ['Ngaysinh'], $colIndex );
				$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row ['Chucvu'], $colIndex );
				$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row ['Dienthoai'], $colIndex );
				$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row ['Tinhtrang'], $colIndex );
				$helpExport->setStyle_11_TNR_N_L ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
				$helpExport->setStyle_Align_Center ( $sheet, 'A' . $rowIndex, 'A' . $rowIndex );
				$helpExport->setStyle_Align_Center ( $sheet, 'D' . $rowIndex, 'E' . $rowIndex );
				$helpExport->setStyle_Align_Right ( $sheet, 'F' . $rowIndex, 'F' . $rowIndex );
				$helpExport->setStyle_Align_Right ( $sheet, 'H' . $rowIndex, 'H' . $rowIndex );
			}
		}
		// //////////////////////////
		
		// set border cho danh sach//
		$sheet->getStyle ( 'A' . $rowStart . ':' . 'I' . $rowIndex )->getBorders ()->getOutline ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
		$sheet->getStyle ( 'A' . $rowStart . ':' . 'I' . $rowIndex )->getBorders ()->getInside ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
		// //////////////////////////
		
		// set tong so nhan vien///
		$rowIndex += 2;
		$sheet->setCellValue ( 'H' . $rowIndex, 'Tổng số nhân viên: ' . count ( $jsonObj ) );
		$helpExport->setStyle_12_TNR_B_L ( $sheet, 'H' . ($rowIndex - 1), 'H' . $rowIndex );
		$sheet->mergeCellsByColumnAndRow ( 7, $rowIndex, 8, $rowIndex );
		// //////////////////////////
		
		// //set dinh dang giay a4 cho ban in ra////////////
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setOrientation ( PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE );
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setPaperSize ( PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4 );
		$pageMargin = $sheet->getPageMargins ();
		$pageMargin->setTop ( .5 );
		$pageMargin->setLeft ( .7 );
		$pageMargin->setRight ( .7 );
		// //////////////////////////////////////////////////
		header ( 'Content-Type: application/vnd.ms-excel' );
		header ( 'Content-Disposition: attachment;filename="Danh_sach_nhan_vien_' . $this->TblThongtincoquanbyId [0] ['Tencoquan'] . '(' . date ( "d/m/Y" ) . ').xls"' );
		header ( 'Cache-Control: max-age=0' );
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel5' );
		$objWriter->save ( 'php://output' );
	}
	
	/**
	 * Phadh
	 * In Ho so nhan vien
	 */
	public function hosoAction() {
		$this->_helper->layout ()->disableLayout ();
		$helpExport = new HelpFuncExportExcel ();
		$id = $this->_getParam ( 'id' );
		$objReader = PHPExcel_IOFactory::createReader ( "Excel5" );
		$objPHPExcel = new PHPExcel ();
		$jsonObj = null;
		$colIndex = '0';
		$rowIndex = '';
		if (isset ( $id ) && $id != '') {
			$jsonObj = Nhansu_Model_Nhanvien::getInfoHoso ( $id, $this->_ThongtincoquanId, $this->TblThongtincoquanbyId [0] ['Namhoatdong'] );
			$quanhecon = Nhansu_Model_Nhanvien::getQuanheHoso ( $id, $this->_ThongtincoquanId, $this->TblThongtincoquanbyId [0] ['Namhoatdong'] );
			$quanheanhem = Nhansu_Model_Nhanvien::getQuanheAnhEm ( $id, $this->_ThongtincoquanId, $this->TblThongtincoquanbyId [0] ['Namhoatdong'] );
			$congtac = Nhansu_Model_Nhanvien::getquatrinhcongtac ( $id, $this->_ThongtincoquanId );
			$objPHPExcel = $objReader->load ( "public/media/Mau_bao_cao/QLNS_HOSONV.xls" );
			$sheet = $objPHPExcel->getActiveSheet ();
			if ($jsonObj [0] ['Hinhanh'] != null) {
				$data = 'data:image/jpeg;base64,' . base64_encode ( $jsonObj [0] ['Hinhanh'] );
				list ( $type, $data ) = explode ( ';', $data );
				list ( , $data ) = explode ( ',', $data );
				$data = base64_decode ( $data );
				file_put_contents ( 'public/media/anh/image.png', $data );
			}
			foreach ( $jsonObj as $row ) {
				if ($row ['Hinhanh']) {
					$objDrawing = new PHPExcel_Worksheet_Drawing ();
					$objDrawing->setName ( 'PHPExcel logo' );
					$objDrawing->setDescription ( 'PHPExcel logo' );
					$objDrawing->setPath ( 'public/media/anh/image.png' ); // filesystem
					                                                    // reference for the
					                                                    // image file
					$objDrawing->setWidthAndHeight ( 115, 350 ); // sets the image
					                                          // height to 36px (overriding the
					                                          // actual image height);
					$objDrawing->setCoordinates ( 'B4' ); // pins the top-left corner of
					                                   // the image to cell D24
					                                   // $objDrawing->setOffsetX(10);
					                                   // // pins the top left corner of the
					                                   // image at an offset of 10 points
					                                   // horizontally to the right of the
					                                   // top-left corner of the cell
					$objDrawing->setWorksheet ( $objPHPExcel->getActiveSheet () );
				}
				$sheet->setCellValue ( "C" . "13", $row ['Hoten'] );
				$sheet->setCellValue ( "I" . "13", $row ['Gioitinh'] );
				$sheet->setCellValue ( "C" . "14", $row ['Ngaysinh'] );
				$sheet->setCellValue ( "F" . "14", $row ['Thangsinh'] );
				$sheet->setCellValue ( "H" . "14", $row ['Namsinh'] );
				$sheet->setCellValue ( "A" . "16", $row ['Thuongtru'] );
				$sheet->setCellValue ( "E" . "18", $row ['CMND'] );
				$sheet->setCellValue ( "I" . "18", $row ['Noicap'] );
				$sheet->setCellValue ( "B" . "19", $row ['Ngaycap'] );
				$sheet->setCellValue ( "D" . "19", $row ['Thangcap'] );
				$sheet->setCellValue ( "F" . "19", $row ['Namcap'] );
				$sheet->setCellValue ( "I" . "20", $row ['Dienthoai'] );
				$sheet->setCellValue ( "A" . "23", $row ['Hoten'] . '-' . $row ['Noiohiennay'] );
				$sheet->setCellValue ( "C" . "43", $row ['Hoten'] );
				$sheet->setCellValue ( "I" . "43", $row ['Tenkhac'] );
				$sheet->setCellValue ( "C" . "44", $row ['Tenkhac'] );
				$sheet->setCellValue ( "C" . "45", $row ['Ngaysinh'] );
				$sheet->setCellValue ( "E" . "45", $row ['Thangsinh'] );
				$sheet->setCellValue ( "G" . "45", $row ['Namsinh'] );
				$sheet->setCellValue ( "I" . "45", $row ['Noisinh'] );
				$sheet->setCellValue ( "A" . "47", $row ['Quequan'] );
				$sheet->setCellValue ( "A" . "49", $row ['Thuongtru'] );
				$sheet->setCellValue ( "C" . "50", $row ['Tendantoc'] );
				$sheet->setCellValue ( "I" . "50", $row ['Tongiao'] );
				$sheet->setCellValue ( "A" . "52", $row ['Tpxuatthan'] );
				$sheet->setCellValue ( "F" . "57", $row ['Ngayvaodang'] );
				$sheet->setCellValue ( "H" . "57", $row ['Thangvaodang'] );
				$sheet->setCellValue ( "J" . "57", $row ['Namvaodang'] );
				$sheet->setCellValue ( "E" . "59", $row ['Ngayvaodoan'] );
				$sheet->setCellValue ( "G" . "59", $row ['Thangvaodoan'] );
				$sheet->setCellValue ( "I" . "59", $row ['Namvaodoan'] );
				$sheet->setCellValue ( "C" . "68", $row ['Hotenbo'] );
				$sheet->setCellValue ( "G" . "68", $row ['Tuoibo'] );
				$sheet->setCellValue ( "C" . "58", $row ['Noiketnapdang'] );
				$sheet->setCellValue ( "C" . "60", $row ['Noiketnapdoan'] );
				$sheet->setCellValue ( "C" . "54", $row ['Trinhdovanhoa'] );
				$sheet->setCellValue ( "J" . "54", $row ['Trinhdongoaingu'] );
				$sheet->setCellValue ( "J" . "68", $row ['Nghenghiepbo'] );
				$sheet->setCellValue ( "J" . "79", $row ['Nghenghiepme'] );
				$sheet->setCellValue ( "C" . "101", $row ['Nghenghiepvo'] );
				if ($row ['Namsinhcuabo'] < 1945 && $row ['Namsinhcuabo'] != '') {
					$sheet->setCellValue ( "A" . "70", 'Sinh năm : ' . $row ['Namsinhcuabo'] . ' - ' . $row ['Quequanbo'] );
				} else {
					$sheet->setCellValue ( "A" . "70", 'Chưa sinh' );
				}
				if ($row ['Namsinhcuabo'] > 1945 && $row ['Namsinhcuabo'] < 1955) {
					$sheet->setCellValue ( "A" . "73", 'Sinh năm : ' . $row ['Namsinhcuabo'] . ' - ' . $row ['Quequanbo'] );
				} else {
					$sheet->setCellValue ( "A" . "73", 'Chưa sinh' );
				}
				if ($row ['Namsinhcuabo'] > 1955) {
					$sheet->setCellValue ( "A" . "77", 'Sinh năm : ' . $row ['Namsinhcuabo'] . ' - ' . $row ['Quequanbo'] );
				} else {
					$sheet->setCellValue ( "A" . "77", 'Chưa sinh' );
				}
				$sheet->setCellValue ( "C" . "79", $row ['Hotenme'] );
				$sheet->setCellValue ( "G" . "79", $row ['Tuoime'] );
				if ($row ['Namsinhcuame'] < 1945 && $row ['Namsinhcuame'] != '') {
					$sheet->setCellValue ( "A" . "81", 'Sinh năm : ' . $row ['Namsinhcuame'] . ' - ' . $row ['Quequanme'] );
				} else {
					$sheet->setCellValue ( "A" . "81", 'Chưa sinh' );
				}
				if ($row ['Namsinhcuame'] > 1945 && $row ['Namsinhcuame'] < 1955) {
					$sheet->setCellValue ( "A" . "84", 'Sinh năm : ' . $row ['Namsinhcuame'] . ' - ' . $row ['Quequanme'] );
				} else {
					$sheet->setCellValue ( "A" . "84", 'Chưa sinh' );
				}
				if ($row ['Namsinhcuame'] > 1955) {
					$sheet->setCellValue ( "A" . "88", 'Sinh năm : ' . $row ['Namsinhcuame'] . ' - ' . $row ['Quequanme'] );
				} else {
					$sheet->setCellValue ( "A" . "88", 'Chưa sinh' );
				}
				if ($row ['Hotenvo'] != null) {
					$sheet->setCellValue ( "D" . "100", $row ['Hotenvo'] );
					$sheet->setCellValue ( "I" . "100", $row ['Tuoivo'] );
					$sheet->setCellValue ( "C" . "103", $row ['Quequanvo'] );
				} else {
					$sheet->setCellValue ( "D" . "100", '' );
					$sheet->setCellValue ( "I" . "100", '' );
					$sheet->setCellValue ( "C" . "103", '' );
				}
				if (count ( $quanheanhem ) > 0) {
					$row = 94;
					$col = 0;
					foreach ( $quanheanhem as $value ) {
						$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $col, $row, $value ['Hoten'] . ' - Tuổi: ' . $value ['Tuoi'] . ' - Quê quán:' . $value ['Quequan'] . ' - Nghề nghiệp: ' . $value ['Nghenghiep'] );
						$row ++;
					}
				}
				if (count ( $quanhecon ) > 0) {
					$row = 105;
					$col = 1;
					foreach ( $quanhecon as $rows ) {
						$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $col, $row, $rows ['Hoten'] );
						$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $col + 4, $row, $rows ['Tuoicon'] );
						$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $col + 7, $row, $rows ['Nghenghiep'] );
						$row ++;
					}
				}
				if (count ( $congtac ) > 0) {
					$row = 112;
					$col = 0;
					foreach ( $congtac as $value ) {
						$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $col, $row, $value ['Tungay'] . ' - ' . $value ['Denngay'] );
						$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $col + 4, $row, $value ['Congviec'] );
						$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $col + 10, $row, $value ['Chucvu'] );
						$row ++;
					}
				}
			}
		}
		header ( 'Content-Type: application/vnd.ms-excel' );
		header ( 'Content-Disposition: attachment;filename="Hosonhanvien(' . date ( "d/m/Y" ) . ').xls"' );
		header ( 'Cache-Control: max-age=0' );
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel5' );
		$objWriter->save ( 'php://output' );
	}
	
	/**
	 * Phadh
	 * Tao fiel mau xem truoc danh sach nhan vien
	 */
	public function printviewdsAction() {
		$this->_helper->layout ()->disableLayout ();
		// dieu kien tim kiem
		$hoten = $this->_getParam ( 'sHoten' );
		$chucvu = $this->_getParam ( 'sChucvu' );
		$gioitinh = $this->_getParam ( 'sGioitinh' );
		$manv = $this->_getParam ( 'sManv' );
		$ngaysinh = $this->_getParam ( 'sNgaysinh' );
		$dienthoai = $this->_getParam ( 'sDienthoai' );
		if ($ngaysinh != '') {
			$ngaysinh = $this->convertDateSearch ( $ngaysinh );
		}
		// ///////////////////
		$helpExport = new HelpFuncExportExcel ();
		$objReader = PHPExcel_IOFactory::createReader ( "Excel5" );
		$colIndex = '';
		$rowIndex = 0;
		$objPHPExcel = new PHPExcel ();
		$sheet = $objPHPExcel->getActiveSheet ();
		/*
		 * Bắt đầu set các giá trị, căn chỉnh style Bắt đầu set các giá trị
		 * tĩnh.
		 */
		$sheet->setCellValue ( 'A1', mb_strtoupper ( $this->TblThongtincoquanbyId [0] ['Tencoquan'], 'UTF-8' ) );
		$sheet->mergeCellsByColumnAndRow ( 0, 1, 3, 1 );
		$helpExport->setStyle_12_TNR_N_L ( $sheet, 'A1', 'A1' );
		
		$sheet->setCellValue ( 'A3', 'DANH SÁCH NHÂN VIÊN' );
		$sheet->mergeCellsByColumnAndRow ( 0, 3, 8, 3 );
		$helpExport->setStyle_14_TNR_B_C ( $sheet, 'A3', 'A3' );
		/**
		 * ******
		 */
		
		$rowStart = 5;
		$colStart = 'A';
		$rowIndex = $rowStart;
		$colIndex = $colStart;
		$sheet = $objPHPExcel->getActiveSheet ();
		$sheet->getColumnDimension ( 'A' )->setWidth ( 5 );
		$sheet->getColumnDimension ( 'B' )->setWidth ( 16.86 );
		$sheet->getColumnDimension ( 'C' )->setWidth ( 28.57 );
		$sheet->getColumnDimension ( 'D' )->setWidth ( 10 );
		$sheet->getColumnDimension ( 'E' )->setWidth ( 10 );
		$sheet->getColumnDimension ( 'F' )->setWidth ( 15 );
		$sheet->getColumnDimension ( 'G' )->setWidth ( 15 );
		$sheet->getColumnDimension ( 'H' )->setWidth ( 15 );
		$sheet->getColumnDimension ( 'I' )->setWidth ( 15 );
		$sheet->getRowDimension ( '1' )->setRowHeight ( 21 );
		$sheet->getRowDimension ( '3' )->setRowHeight ( 25.5 );
		
		// set tieu de cho tung cot//
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'STT', $colIndex );
		$sheet->mergeCellsByColumnAndRow ( 0, $rowIndex, 0, ($rowIndex + 1) );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Mã nhân viên', $colIndex );
		$sheet->mergeCellsByColumnAndRow ( 1, $rowIndex, 1, ($rowIndex + 1) );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Họ tên', $colIndex );
		$sheet->mergeCellsByColumnAndRow ( 2, $rowIndex, 2, ($rowIndex + 1) );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Tuổi', 'E' );
		$sheet->mergeCellsByColumnAndRow ( 3, $rowIndex, 4, $rowIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Ngày sinh', $colIndex );
		$sheet->mergeCellsByColumnAndRow ( 5, $rowIndex, 5, ($rowIndex + 1) );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Chức vụ', $colIndex );
		$sheet->mergeCellsByColumnAndRow ( 6, $rowIndex, 6, ($rowIndex + 1) );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Điện thoại', $colIndex );
		$sheet->mergeCellsByColumnAndRow ( 7, $rowIndex, 7, ($rowIndex + 1) );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, 'Tình trạng', $colIndex );
		$sheet->mergeCellsByColumnAndRow ( 8, $rowIndex, 8, ($rowIndex + 1) );
		$helpExport->setStyle_11_TNR_B_C ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
		
		$sheet->setCellValue ( 'D6', 'Nam' );
		$sheet->setCellValue ( 'E6', 'Nữ' );
		$helpExport->setStyle_11_TNR_B_C ( $sheet, 'D6', 'E6' );
		// ////////////////////////
		
		// /set so thu tu cho tung cot//
		$rowIndex += 2;
		$colIndex = $colStart;
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '1', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '2', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '3', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '4', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '5', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '6', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '7', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '8', $colIndex );
		$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, '9', $colIndex );
		$helpExport->setStyle_10_TNR_I_C ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
		// //////////////////////////////////
		
		// lay du lieu////////////////
		$jsonObj = Nhansu_Model_Nhanvien::getDSnhanvien ( $hoten, $chucvu, $gioitinh, $manv, $ngaysinh, $dienthoai, $this->TblThongtincoquanbyId [0] ['Id'] );
		if (count ( $jsonObj ) > 0) {
			$stt = 0;
			foreach ( $jsonObj as $row ) {
				$rowIndex += 1;
				$stt ++;
				$colIndex = $colStart;
				$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $stt, $colIndex );
				$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row ['Manhanvien'], $colIndex );
				$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row ['Hoten'], $colIndex );
				$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row ['Tuoinam'], $colIndex );
				$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row ['Tuoinu'], $colIndex );
				$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row ['Ngaysinh'], $colIndex );
				$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row ['Chucvu'], $colIndex );
				$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row ['Dienthoai'], $colIndex );
				$colIndex = $helpExport->setValueForSheet ( $sheet, $colIndex . $rowIndex, $row ['Tinhtrang'], $colIndex );
				$helpExport->setStyle_11_TNR_N_L ( $sheet, $colStart . $rowIndex, $colIndex . $rowIndex );
				$helpExport->setStyle_Align_Center ( $sheet, 'A' . $rowIndex, 'A' . $rowIndex );
				$helpExport->setStyle_Align_Center ( $sheet, 'D' . $rowIndex, 'E' . $rowIndex );
				$helpExport->setStyle_Align_Right ( $sheet, 'F' . $rowIndex, 'F' . $rowIndex );
				$helpExport->setStyle_Align_Right ( $sheet, 'H' . $rowIndex, 'H' . $rowIndex );
			}
		}
		// //////////////////////////
		
		// set border cho danh sach//
		$sheet->getStyle ( 'A' . $rowStart . ':' . 'I' . $rowIndex )->getBorders ()->getOutline ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
		$sheet->getStyle ( 'A' . $rowStart . ':' . 'I' . $rowIndex )->getBorders ()->getInside ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
		// //////////////////////////
		
		// set tong so nhan vien///
		$rowIndex += 2;
		$sheet->setCellValue ( 'H' . $rowIndex, 'Tổng số nhân viên: ' . count ( $jsonObj ) );
		$helpExport->setStyle_12_TNR_B_L ( $sheet, 'H' . ($rowIndex - 1), 'H' . $rowIndex );
		$sheet->mergeCellsByColumnAndRow ( 7, $rowIndex, 8, $rowIndex );
		// //////////////////////////
		
		// //set dinh dang giay a4 cho ban in ra////////////
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setOrientation ( PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE );
		$objPHPExcel->getActiveSheet ()->getPageSetup ()->setPaperSize ( PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4 );
		$pageMargin = $sheet->getPageMargins ();
		$pageMargin->setTop ( .5 );
		$pageMargin->setLeft ( .7 );
		$pageMargin->setRight ( .7 );
		// //////////////////////////////////////////////////
		$f = 'example.html';
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'HTML' );
		$objWriter->save ( 'public/media/temp/' . $f );
		echo file_get_contents ( 'public/media/temp/' . $f );
	}
	
	/**
	 * Phadh
	 * Tao file view Ho so nhan vien
	 */
	public function printviewhsAction() {
		$this->_helper->layout ()->disableLayout ();
		$helpExport = new HelpFuncExportExcel ();
		$id = $this->_getParam ( 'id' );
		$objReader = PHPExcel_IOFactory::createReader ( "Excel5" );
		$objPHPExcel = new PHPExcel ();
		$jsonObj = null;
		$colIndex = '0';
		$rowIndex = '';
		if (isset ( $id ) && $id != '') {
			$jsonObj = Nhansu_Model_Nhanvien::getInfoHoso ( $id, $this->_ThongtincoquanId, $this->TblThongtincoquanbyId [0] ['Namhoatdong'] );
			$quanhecon = Nhansu_Model_Nhanvien::getQuanheHoso ( $id, $this->_ThongtincoquanId, $this->TblThongtincoquanbyId [0] ['Namhoatdong'] );
			$quanheanhem = Nhansu_Model_Nhanvien::getQuanheAnhEm ( $id, $this->_ThongtincoquanId, $this->TblThongtincoquanbyId [0] ['Namhoatdong'] );
			$congtac = Nhansu_Model_Nhanvien::getquatrinhcongtac ( $id, $this->_ThongtincoquanId );
			$objPHPExcel = $objReader->load ( "public/media/Mau_bao_cao/QLNS_HOSONV.xls" );
			$sheet = $objPHPExcel->getActiveSheet ();
			if ($jsonObj [0] ['Hinhanh'] != null) {
				$data = 'data:image/jpeg;base64,' . base64_encode ( $jsonObj [0] ['Hinhanh'] );
				list ( $type, $data ) = explode ( ';', $data );
				list ( , $data ) = explode ( ',', $data );
				$data = base64_decode ( $data );
				file_put_contents ( 'public/media/anh/image.png', $data );
			}
			foreach ( $jsonObj as $row ) {
				if ($row ['Hinhanh']) {
					$objDrawing = new PHPExcel_Worksheet_Drawing ();
					$objDrawing->setName ( 'PHPExcel logo' );
					$objDrawing->setDescription ( 'PHPExcel logo' );
					$objDrawing->setPath ( 'public/media/anh/image.png' ); // filesystem
					                                                    // reference for the
					                                                    // image file
					$objDrawing->setWidthAndHeight ( 115, 350 ); // sets the image
					                                          // height to 36px (overriding the
					                                          // actual image height);
					$objDrawing->setCoordinates ( 'B4' ); // pins the top-left corner of
					                                   // the image to cell D24
					                                   // $objDrawing->setOffsetX(10);
					                                   // // pins the top left corner of the
					                                   // image at an offset of 10 points
					                                   // horizontally to the right of the
					                                   // top-left corner of the cell
					$objDrawing->setWorksheet ( $objPHPExcel->getActiveSheet () );
				}
				$sheet->setCellValue ( "C" . "13", $row ['Hoten'] );
				$sheet->setCellValue ( "I" . "13", $row ['Gioitinh'] );
				$sheet->setCellValue ( "C" . "14", $row ['Ngaysinh'] );
				$sheet->setCellValue ( "F" . "14", $row ['Thangsinh'] );
				$sheet->setCellValue ( "H" . "14", $row ['Namsinh'] );
				$sheet->setCellValue ( "A" . "16", $row ['Thuongtru'] );
				$sheet->setCellValue ( "E" . "18", $row ['CMND'] );
				$sheet->setCellValue ( "I" . "18", $row ['Noicap'] );
				$sheet->setCellValue ( "B" . "19", $row ['Ngaycap'] );
				$sheet->setCellValue ( "D" . "19", $row ['Thangcap'] );
				$sheet->setCellValue ( "F" . "19", $row ['Namcap'] );
				$sheet->setCellValue ( "I" . "20", $row ['Dienthoai'] );
				$sheet->setCellValue ( "A" . "23", $row ['Hoten'] . '-' . $row ['Noiohiennay'] );
				$sheet->setCellValue ( "C" . "43", $row ['Hoten'] );
				$sheet->setCellValue ( "I" . "43", $row ['Tenkhac'] );
				$sheet->setCellValue ( "C" . "44", $row ['Tenkhac'] );
				$sheet->setCellValue ( "C" . "45", $row ['Ngaysinh'] );
				$sheet->setCellValue ( "E" . "45", $row ['Thangsinh'] );
				$sheet->setCellValue ( "G" . "45", $row ['Namsinh'] );
				$sheet->setCellValue ( "I" . "45", $row ['Noisinh'] );
				$sheet->setCellValue ( "A" . "47", $row ['Quequan'] );
				$sheet->setCellValue ( "A" . "49", $row ['Thuongtru'] );
				$sheet->setCellValue ( "C" . "50", $row ['Tendantoc'] );
				$sheet->setCellValue ( "I" . "50", $row ['Tongiao'] );
				$sheet->setCellValue ( "A" . "52", $row ['Tpxuatthan'] );
				$sheet->setCellValue ( "F" . "57", $row ['Ngayvaodang'] );
				$sheet->setCellValue ( "H" . "57", $row ['Thangvaodang'] );
				$sheet->setCellValue ( "J" . "57", $row ['Namvaodang'] );
				$sheet->setCellValue ( "E" . "59", $row ['Ngayvaodoan'] );
				$sheet->setCellValue ( "G" . "59", $row ['Thangvaodoan'] );
				$sheet->setCellValue ( "I" . "59", $row ['Namvaodoan'] );
				$sheet->setCellValue ( "C" . "68", $row ['Hotenbo'] );
				$sheet->setCellValue ( "G" . "68", $row ['Tuoibo'] );
				$sheet->setCellValue ( "C" . "54", $row ['Trinhdovanhoa'] );
				$sheet->setCellValue ( "J" . "54", $row ['Trinhdongoaingu'] );
				$sheet->setCellValue ( "J" . "68", $row ['Nghenghiepbo'] );
				$sheet->setCellValue ( "J" . "79", $row ['Nghenghiepme'] );
				$sheet->setCellValue ( "C" . "101", $row ['Nghenghiepvo'] );
				$sheet->setCellValue ( "C" . "58", $row ['Noiketnapdang'] );
				$sheet->setCellValue ( "C" . "60", $row ['Noiketnapdoan'] );
				if ($row ['Namsinhcuabo'] < 1945 && $row ['Namsinhcuabo'] != '') {
					$sheet->setCellValue ( "A" . "70", 'Sinh năm : ' . $row ['Namsinhcuabo'] . ' - ' . $row ['Quequanbo'] );
				} else {
					$sheet->setCellValue ( "A" . "70", 'Chưa sinh' );
				}
				if ($row ['Namsinhcuabo'] > 1945 && $row ['Namsinhcuabo'] < 1955) {
					$sheet->setCellValue ( "A" . "73", 'Sinh năm : ' . $row ['Namsinhcuabo'] . ' - ' . $row ['Quequanbo'] );
				} else {
					$sheet->setCellValue ( "A" . "73", 'Chưa sinh' );
				}
				if ($row ['Namsinhcuabo'] > 1955) {
					$sheet->setCellValue ( "A" . "77", 'Sinh năm : ' . $row ['Namsinhcuabo'] . ' - ' . $row ['Quequanbo'] );
				} else {
					$sheet->setCellValue ( "A" . "77", 'Chưa sinh' );
				}
				$sheet->setCellValue ( "C" . "79", $row ['Hotenme'] );
				$sheet->setCellValue ( "G" . "79", $row ['Tuoime'] );
				if ($row ['Namsinhcuame'] < 1945 && $row ['Namsinhcuame'] != '') {
					$sheet->setCellValue ( "A" . "81", 'Sinh năm : ' . $row ['Namsinhcuame'] . ' - ' . $row ['Quequanme'] );
				} else {
					$sheet->setCellValue ( "A" . "81", 'Chưa sinh' );
				}
				if ($row ['Namsinhcuame'] > 1945 && $row ['Namsinhcuame'] < 1955) {
					$sheet->setCellValue ( "A" . "84", 'Sinh năm : ' . $row ['Namsinhcuame'] . ' - ' . $row ['Quequanme'] );
				} else {
					$sheet->setCellValue ( "A" . "84", 'Chưa sinh' );
				}
				if ($row ['Namsinhcuame'] > 1955) {
					$sheet->setCellValue ( "A" . "88", 'Sinh năm : ' . $row ['Namsinhcuame'] . ' - ' . $row ['Quequanme'] );
				} else {
					$sheet->setCellValue ( "A" . "88", 'Chưa sinh' );
				}
				if ($row ['Hotenvo'] != null) {
					$sheet->setCellValue ( "D" . "100", $row ['Hotenvo'] );
					$sheet->setCellValue ( "I" . "100", $row ['Tuoivo'] );
					$sheet->setCellValue ( "C" . "103", $row ['Quequanvo'] );
				} else {
					$sheet->setCellValue ( "D" . "100", '' );
					$sheet->setCellValue ( "I" . "100", '' );
					$sheet->setCellValue ( "C" . "103", '' );
				}
				if (count ( $quanheanhem ) > 0) {
					$row = 94;
					$col = 0;
					foreach ( $quanheanhem as $value ) {
						$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $col, $row, $value ['Hoten'] . ' - Tuổi: ' . $value ['Tuoi'] . ' - Quê quán:' . $value ['Quequan'] . ' - Nghề nghiệp: ' . $value ['Nghenghiep'] );
						$row ++;
					}
				}
				if (count ( $quanhecon ) > 0) {
					$row = 105;
					$col = 1;
					foreach ( $quanhecon as $rows ) {
						$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $col, $row, $rows ['Hoten'] );
						$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $col + 4, $row, $rows ['Tuoicon'] );
						$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $col + 7, $row, $rows ['Nghenghiep'] );
						$row ++;
					}
				}
				if (count ( $congtac ) > 0) {
					$row = 112;
					$col = 0;
					foreach ( $congtac as $value ) {
						$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $col, $row, $value ['Tungay'] . ' - ' . $value ['Denngay'] );
						$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $col + 4, $row, $value ['Congviec'] );
						$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $col + 10, $row, $value ['Chucvu'] );
						$row ++;
					}
				}
			}
		}
		$f = 'example.html';
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'HTML' );
		$objWriter->writeAllSheets ();
		$objWriter->save ( 'public/media/temp/' . $f );
		echo file_get_contents ( 'public/media/temp/' . $f );
	}
	public function combogridbybophanAction() {
		$page = isset ( $_POST ['page'] ) ? intval ( $_POST ['page'] ) : 1;
		$rows = isset ( $_POST ['rows'] ) ? intval ( $_POST ['rows'] ) : 20;
		$sort = isset ( $_POST ['sort'] ) ? strval ( $_POST ['sort'] ) : 'Hoten';
		$order = isset ( $_POST ['order'] ) ? strval ( $_POST ['order'] ) : 'desc';
		$offset = ($page - 1) * $rows;
		
		$BophanId = $this->_getParam ( 'BophanId' );
		$this->_helper->layout ()->disableLayout ();
		$mnhansu = new Model_Nhansu ();
		$jsonObj = json_encode ( Nhansu_Model_Nhanvien::getcombonhansubybophanObj ( $BophanId, $this->_ThongtincoquanId, $sort, $order, $offset, $rows ) );
		return $this->view->jsonObj = $jsonObj;
	}
	public function generaformAction() {
		$this->_helper->layout ()->disableLayout ();
		$objData = array ();
		$id = 1;
		$objData = Nhansu_Model_Nhanvien::getIdObj ( $this->_ThongtincoquanId );
		$extension = end ( explode ( "-", $objData [0] ['Id'] ) );
		$id += ( int ) $extension;
		$form = array (
				'Manhanvien' => 'NV' . $this->TblThongtincoquanbyId [0] ['Matram'] . '-' . $id 
		);
		$jsonObj = json_encode ( $form );
		return $this->view->jsonObj = $jsonObj;
	}
	public function getloaiAction() {
		$this->_helper->layout->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( TRUE );
		echo json_encode ( Website_Model_Lienket::$Loai );
	}
}