/**
 * *********************** BEGIN Script of kham benh
 * ********************************
 */
var url;
var option;
var mahodan;
var id;
var lastIndex;
$(function() {
	$('#dg-khambenh').edatagrid({
		url : 'capphatthuoc/json'
	});
	define_donthuoc();
	reset_format_date('#Ngaycap');
	reset_format_date('#Ngayvaodang');
	reset_format_date('#NGayvaodoan');
});

function formatChutrinhdieutri(val, row) {
	if (val = 0)
		return 'Kết thúc';
	else if (val = 1)
		return 'Đang điều trị';
	else
		return 'Chuyển viện';
}

/**
 * *********************** END Script of kham benh
 * ********************************
 */
/**
 * ********************** BEGIN Script of don thuoc
 * *******************************
 */
var temp = false;
function define_donthuoc() {
	$('#dg-tvtduocchon').edatagrid({
		url : '',
		onClickRow : function(rowIndex) {
			if (lastIndex != rowIndex) {
				try {
					$('#dg-tvtduocchon').datagrid('endEdit', lastIndex);
				} catch (e) {
				}
				$('#dg-tvtduocchon').datagrid('beginEdit', rowIndex);
				setEditing(rowIndex);
			}
			lastIndex = rowIndex;
		}
	});

	$('#dg-thuoc')
	.datagrid(
			{
				url : '../thuocvattu/Nhapxuat/searthuocvattubynamesetidandname/Luachon/0/sTendoituong//sTungay//sDenngay/',
				onDblClickRow : function(rowIndex, rowData) {
					var rows_thuocdc = $('#dg-tvtduocchon').datagrid(
							'getRows');
					if (rows_thuocdc.length > 0) {
						for (row_thuocdc in rows_thuocdc) {
							var Id_thuocdc = rows_thuocdc[row_thuocdc].cId;
							var Hansudung_thuocdc = rows_thuocdc[row_thuocdc].cHansudung;

							if (rowData.Id == Id_thuocdc &&  rowData.Hansudung == Hansudung_thuocdc) {
								show_messager('Bản ghi đã chọn, hãy chọn bản ghi khác!');
								return;
							}

						}
					}
					$('#dg-tvtduocchon').datagrid('insertRow', {
						index : 0,
						row : {
							cTenthuoc : rowData.Tenthuocvattu,
							cTendonvitinh : rowData.Tendonvitinh,
							cHansudung : rowData.Hansudung,
							cMucluutruId: rowData.MucluutruId,
							cDongia : rowData.Dongia,
							cSoluongcon: rowData.Soluong,
							cId : rowData.Id,
							cLoaithuocId : rowData.LoaithuocId,
							cNgaynhapxuat : rowData.Ngaynhapxuat

						}
					});
				}
			});
	$('#Nguoinhapxuat').combogrid({
		panelWidth : 470,
		panelHeight : 320,
		pagination : true,
		nowrap : true,
		fitColumns : false,
		border : false,
		fit : true,
		idField : 'Hoten',
		textField : 'Hoten',
		mode : 'remote',
		pageSize : 30,
		rownumbers : true,
		url : '../nhansu/nhanvien/combogrid',
		columns : [ [ {
			field : 'Id',
			title : 'Id',
			hidden : true
		}, {
			field : 'Hoten',
			title : 'Họ và Tên',
			width : 145
		}, {
			field : 'Ngaysinh',
			title : 'Ngày sinh',
			width : 80,
			hidden : true
		}, {
			field : 'Diachi',
			title : 'Địa chỉ',
			width : 165,
			hidden : true
		}, {
			field : 'Tenphongban',
			title : 'Bộ phận',
			width : 150
		}, {
			field : 'Tinhtrang',
			title : 'Tình trạng',
			width : 120,
			formatter : formattrangthai_nv
		} ] ]
	});
	$("input[name='mode']").change(function() {
		var mode = $(this).val();
		$('#NhansuId').combogrid({
			mode : mode
		});
	});
	reset_format_date('#Ngaysinh');
	reset_format_date('#Ngaynhapxuat');
}
function formattrangthai_nv(val, row) {
	if (val == '')
		return '<label style="color:blue">Đang hoạt động</lable>';
	else
		return '<label style="color:red">Ngừng hoạt động</lable>';
}
function setEditing(rowIndex) {
	var editors = $('#dg-tvtduocchon').datagrid('getEditors', rowIndex);
	var soluongEditor = editors[0];
	var dongiaEditor = editors[1];
	var tongdongiaEditor = editors[2];
	soluongEditor.target.bind('change', function() {
		calculate();
	});
	dongiaEditor.target.bind('change', function() {
		calculate();
	});
	/*
	 * dongiaEditor.target.keyup(function() { nr = this.value; var regex = /,/g;
	 * nr = nr.replace(regex, ''); nr += ''; var x = nr.split('.'); var p1 =
	 * x[0]; var p2 = x.length > 1 ? '.' + x[1] : ''; regex = /(\d+)(\d{3})/;
	 * while (regex.test(p1)) { p1 = p1.replace(regex, '$1' + ',' + '$2'); }
	 * this.value = p1 + p2; });
	 */
	tongdongiaEditor.target.attr('readonly', true);
	function calculate() {
		var soluong = soluongEditor.target.val();
		var dongia = dongiaEditor.target.val();
		var tong = 0;
		dongia = dongia.replace(/,/g, '');
		dongia = parseInt(dongia);
		soluong = parseInt(soluong);
		tong = soluong * dongia;
		$(tongdongiaEditor.target).numberbox('setValue', tong);
	}
}
function add_donthuoc(_id, _nhansuid, _tennhansu,_sophieukham) {
	lastIndex = -1;
	id = _id;
	$('#dlg-donthuoc').dialog('open').dialog('setTitle',
			'Thêm đơn thuốc cho phiếu khám');
	$('#fm-donthuoc').form('clear');
	$('#dg-tvtduocchon').datagrid('loadData', {
		total : 0,
		rows : []
	});
	$('#dg-thuoc').datagrid('reload');
	$('#fm-donthuoc').form('load', {
		SophieukcbĐT : _id
	});
	$('#Nguoinhapxuat').combogrid('setValue', _tennhansu);
	$('#Maphieunhap').val(_sophieukham);	
	$('#Nguoinhapxuat').combogrid('setText', _tennhansu);
	url = 'Capphatthuoc/adddonthuoc';
}

function del_donthuoc(_id) {
	var row = $('#dg-detail-' + _id).datagrid('getSelected');
	// alert(_id);
	if (row) {
		$.messager.confirm('Thông báo', 'Bạn có chắc chắn muốn xóa?', function(
				r) {
			if (r) {
				$.post('capphatthuoc/delthuoc', {
					Madonthuoc : row.Mahoadon
				}, function(result) {
					if (result.success) {
						show_messager('Xóa dữ liệu thành công!');
					} else {
						show_messager('Xóa dữ liệu không thành công!');
					}
				}, 'json');
				$('#dg-detail-' + _id).datagrid('reload');
			}
		});
	} else {
		show_messager('Không có bản ghi nào được chọn!');
	}
}

function save_donthuoc() {
	try {
		var row = $('#dg-thuoc').datagrid('getSelected');
		$('#dg-tvtduocchon').datagrid('acceptChanges');
		var items = $('#dg-tvtduocchon').datagrid('getRows');
		if ($('#fm-donthuoc').form('validate')) {
			if (!isDate($('#Ngaynhapxuat').datebox('getValue'))) {
				show_messager('Định dạng Ngày cấp thuốc nhập vào không đúng!');
				return false;
			}
			if (items.length) {
				for (item in items) {
					if (row) {
						if (items[item].cSoluong == null
								|| items[item].cDongia == null
								|| items[item].cSoluong <= 0
								|| items[item].cDongia <= 0 ) {
							show_messager('Số lượng và đơn giá không được nhỏ hơn hoặc bằng 0');
							return;
						}

						if (parseInt(items[item].cSoluong) > parseInt(items[item].cSoluongcon)) {
							show_messager('Số lượng thuốc phải nhỏ hơn số lượng thuốc có trong kho');
							return;
						}
					}
				}
				document.getElementById('thuocdc').value = JSON
						.stringify(items);
				if (temp) {
					$.messager
							.confirm(
									'Thông báo',
									'Mã hóa đơn sẽ không thể sửa được, bạn chắc chắn thêm phiếu?',
									function(r) {
										if (r) {
											exec_donthuoc();
										}
									});
				} else
					exec_donthuoc();
			} else {
				show_messager('Không có bản ghi nào được lựa chọn!');
				return;
			}
		}
	} catch (e) {
		alert(e);
	}
}

function exec_donthuoc() {
	$('#fm-donthuoc').form('submit', {
		url : url,
		success : function(result) {
			var result = eval('(' + result + ')');
			if (result.success) {
				$('#dlg-donthuoc').dialog('close');
				$('#dg-detail-' + id).datagrid('reload');
				show_messager('Cập nhật dữ liệu thành công!');
			} else {
				show_messager('Cập nhật dữ liệu không thành công!');
			}
		}
	});
}
function sear_thuoc() {
	var sTenthuoc = $('#sTenthuoc').val();

	$('#dg-thuoc').datagrid('options').url = '../thuocvattu/Nhapxuat/searthuocvattubynamesetidandname/Luachon/0/sTendoituong/'+sTenthuoc+'/sTungay//sDenngay/'
			;

	$('#dg-thuoc').datagrid('reload');
}
/**
 * ********************** BEGIN Script of don thuoc
 * *******************************
 */