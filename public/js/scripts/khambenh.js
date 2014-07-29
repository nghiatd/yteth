/**
 * *********************** BEGIN Script of kham benh
 * ********************************
 */
var url;
var urlkt;
var option;
var mahodan;
var Sophieukcb = 0;

var kb_val;
var kb_id;
var kb_doituong;
var kb_phuongphapdieutri;

$(function() {
	/*$('#dg-khambenh').edatagrid({
		url : 'khambenh/json',
		border : false,
		fit : true,
		singleSelect : true,
		fitColumns : false,
		selectOnCheck : false,
		checkOnSelect : false,
		toolbar : "#toolbar-khambenh",
		pagination : true,
		idField : 'id',
		rownumbers : true,
		nowrap : true
		columns:[[
		          {field:'ck',checkbox:true},
		          {field:'Sophieukcb',title:'Mã Số Phiếu',width:80,sortable:true},
		          {field:'Ngaylapphieu',title:'Ngày Lập',width:75,sortable:true,align:'center'},
		          {field:'Hoten',title:'Người Bệnh',width:120,sortable:true},
		          {field:'Gioitinh',title:'Giới Tính',width:70,sortable:true},
		          {field:'Chutrinhdieutri',title:'Chu trình',width:100,sortable:true,formatter:formatTrangthai},
		          {field:'Benhdich',title:'Bệnh Dịch',width:110,sortable:true},
		          {field:'Nguoikham',title:'Người Khám',width:150,sortable:true},
		          {field:'Tenthonto',title:'Thôn tổ',width:110,sortable:true},
		          {field:'Khambenh_Sophieukcb',title:'Xem',width:50,sortable:true,formatter:formatXem,align:'center'},
		          {field:'Id',hidden:true},
		          {field:'NhankhauId',hidden:true},
		          {field:'NhansuId',hidden:true},
		          {field:'Sotret',hidden:true},
		          {field:'Hiv',hidden:true},
		          {field:'Tamthan',hidden:true},
		          {field:'Phathai',hidden:true},
		          {field:'Sinhsan',hidden:true},
		          {field:'Khhgd',hidden:true},
		          {field:'Thuongtich',hidden:true},
		          {field:'Khamthai',hidden:true},
		          {field:'Chantaymieng',hidden:true},
		          {field:'Doituong',hidden:true},
		          {field:'Sobaohiem',hidden:true}
		]]
	});*/
	$('#fm-khambenh').form({
		onLoadSuccess: function(data){
			Sophieukcb = data.Sophieukcb;
			//alert(Sophieukcb);
			//reload_sub_dg();
		}
	});
	
	$('#NhankhauCv').combogrid({
		panelWidth : 650,
		panelHeight : 320,
		pagination : true,
		nowrap : true,
		fitColumns : false,
		border : false,
		fit : true,
		editable : false,
		idField : 'Id',
		textField : 'Hoten',
		mode : 'remote',
		url : '/../danso/nhankhau/combogrid1',
		columns : [ [ {
			field : 'Id',
			title : 'Id',
			hidden : true
		}, {
			field : 'Mahodan',
			title : 'Mã Hộ Dân',
			width : 100
		}, {
			field : 'Hoten',
			title : 'Họ và Tên',
			width : 145
		}, {
			field : 'Ngaysinh',
			title : 'Ngày sinh',
			width : 140
		}, {
			field : 'Gioitinh',
			title : 'Giới tính',
			width : 140
		}, {
			field : 'Diachi',
			title : 'Địa chỉ',
			width : 140
		}, {
			field : 'Thonto',
			title : 'Thôn tổ',
			width : 140
		} ] ]
	});
	$("input[name='mode']").change(function() {
		var mode = $(this).val();
		$('#NhankhauCv').combogrid({
			mode : mode
		});
	});
	
	$('#DantocId').combogrid({
		panelWidth : 320,
		panelHeight : 300,
		pagination : true,
		nowrap : true,
		rownumbers : true,
		fitColumns : false,
		border : false,
		fit : true,
		required : true,
		idField : 'Id',
		textField : 'Tendantoc',
		width : 152,
		mode : 'remote',
		url : '../danso/dantoc/combo',
		editable : false,
		toolbar : ('#combogrid-dantoc-toolbar'),
		columns : [ [ {
			field : 'Id',
			title : 'Id',
			hidden : true
		}, {
			field : 'Tendantoc',
			title : 'Tên dân tộc',
			width : 145
		} ] ]
		});
	
	$('#TrinhdohocvanId').combogrid({
        panelWidth: 500,  
		panelHeight:320,
		pagination:true,
		nowrap:true,
		fitColumns:false,
		border:false,
		fit:true,
		editable : false,
		rownumbers:true,
		idField:'Id',
		textField:'Tentrinhdohocvan',
		mode:'remote',
		url: '../default/trinhdohocvan/combo',
		toolbar:('#combogrid-trinhdo-toolbar'),
		columns:[[
			{field:'Id',title:'Id',hidden:true},
			{field:'Tentrinhdohocvan',title:'Tên trình độc học vấn',width:268}
		]]
	});
	
	$('#Nhansu').combogrid({
		panelWidth : 550,
		panelHeight : 320,
		pagination : true,
		nowrap : true,
		fitColumns : false,
		border : false,
		fit : true,
		editable : false,
		idField : 'Id',
		pageSize : 30,
		textField : 'Hoten',
		mode : 'remote',
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
			width : 80
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
		$('#Nhansu').combogrid({
			mode : mode
		});
	});
	
	// phadh combogrid benh dich
	$('#BenhdichId').combogrid({
		panelWidth : 550,
		panelHeight : 320,
		pagination : true,
		nowrap : true,
		fitColumns : false,
		border : false,
		fit : true,
		editable : false,
		rownumbers : true,
		idField : 'Id',
		textField : 'Tenbenhdich',
		mode : 'remote',
		toolbar : ('#combogrid-toolbar-khambenh'),
		url : 'benhdich/combo',
		columns : [ [ {
			field : 'Id',
			title : 'Id',
			hidden : true
		}, {
			field : 'ICD10',
			title : 'Mã ICD-10',
			width : 80
		}, {
			field : 'Tenbenhdich',
			title : 'Tên bệnh dịch',
			width : 200
		}, {
			field : 'Tentienganh',
			title : 'Tên tiếng anh',
			width : 200
		} ] ]
	});
	$("input[name='mode']").change(function() {
		var mode = $(this).val();
		$('#BenhdichId').combogrid({
			mode : mode
		});
	});
	$('#NhankhauTv').combogrid({
		panelWidth : 650,
		panelHeight : 320,
		pagination : true,
		nowrap : true,
		fitColumns : false,
		border : false,
		fit : true,
		editable : false,
		idField : 'Id',
		textField : 'Hoten',
		mode : 'remote',
		url : '../danso/nhankhau/combogrid1',
		columns : [ [ {
			field : 'Id',
			title : 'Id',
			hidden : true
		}, {
			field : 'Mahodan',
			title : 'Mã Hộ Dân',
			width : 100
		}, {
			field : 'Hoten',
			title : 'Họ và Tên',
			width : 145
		}, {
			field : 'Ngaysinh',
			title : 'Ngày sinh',
			width : 140
		}, {
			field : 'Gioitinh',
			title : 'Giới tính',
			width : 140
		}, {
			field : 'Diachi',
			title : 'Địa chỉ',
			width : 140
		}, {
			field : 'Thonto',
			title : 'Thôn tổ',
			width : 140
		} ] ]
	});
	$("input[name='mode']").change(function() {
		var mode = $(this).val();
		$('#NhankhauTv').combogrid({
			mode : mode
		});
	});
	$('#combogrid-nhankhau-toolbar').load(
			'../danso/nhankhau/combogridtoolbar #tbl-cbg-toolbar');
	/*$('#fm-nhankhau').load('nhankhau/formnhankhau #tblFromNhankhau',
			function(responseText, textStatus, XMLHttpRequest) {
				if (textStatus == "success")
					define_nhankhau();
			});*/
	$('#fm-hokhau').load('../danso/hokhau/formhokhau #etb',
			function(responseText, textStatus, XMLHttpRequest) {
				if (textStatus == "success")
					cbg_define_hokhau();
			});
	define_nhankhau();
	reset_format_date('#sNLap');
	reset_format_date('#Giatritu');
	reset_format_date('#Giatriden');
	reset_format_date('#Ngaycap');
	reset_format_date('#Ngayvaodang');
	reset_format_date('#NGayvaodoan');
	reset_format_date('#Ngaykinhcuoi');
	reset_format_date('#Ngaysinh');
	reset_format_date('#NgaysinhNS');
	reset_format_date('#NgaysinhNK');
	reset_format_date('#Ngaytainan');
	define_donthuoc();
});

function formattrangthai(val, row) {
	if (val == 0)
		return '<label style="color:red">Đã chết</lable>';
	else if (val == 1)
		return '<label style="color:green">Còn sống</lable>';
	else if (val == 2)
		return '<label style="color:blue">Rời khỏi địa bàn</label>';
}

function define_khambenh() {
	$('#NhankhauId').combogrid({
		panelWidth : 800,
		panelHeight : 420,
		pagination : true,
		width : 152,
		nowrap : true,
		fitColumns : false,
		border : false,
		fit : true,
		idField : 'Id',
		textField : 'Hoten',
		editable : false,
		required : true,
		mode : 'remote',
		url : '../danso/nhankhau/combogrid1',
		toolbar : ('#combogrid-nhankhau-toolbar'),
		columns : [ [ {
			field : 'Id',
			title : 'Id',
			hidden : true
		}, {
			field : 'Tinhtrang',
			title : 'Tình trạng',
			width : 100,
			sortable : true,
			formatter : formattrangthai
		}, {
			field : 'Manhankhau',
			title : 'Mã nhân khẩu',
			width : 90,
			sortable : true
		}, {
			field : 'Hoten',
			title : 'Họ và Tên',
			width : 150,
			sortable : true
		}, {
			field : 'Mabenhnhan',
			title : 'Mã bệnh nhân',
			width : 90,
			sortable : true
		}, {
			field : 'Mahodan',
			title : 'Mã Hộ Dân',
			width : 90,
			sortable : true
		}, {
			field : 'Ngaysinh',
			title : 'Ngày sinh',
			width : 70,
			align : 'center',
			sortable : true
		}, {
			field : 'Gioitinh',
			title : 'Giới tính',
			width : 70,
			sortable : true
		}, {
			field : 'Cmnd',
			title : 'Số CMND',
			width : 70,
			sortable : true
		}, {
			field : 'Sobaohiem',
			title : 'Số bảo hiểm',
			width : 100,
			sortable : true
		}, {
			field : 'Dantoc',
			title : 'Dân tộc',
			width : 70,
			sortable : true
		}, {
			field : 'Diachi',
			title : 'Địa chỉ',
			width : 100,
			sortable : true
		}, {
			field : 'Thonto',
			title : 'Thôn tổ',
			width : 100,
			sortable : true,
		} ] ]
	});
	$("input[name='mode']").change(function() {
		var mode = $(this).val();
		$('#NhankhauId').combogrid({
			mode : mode
		});
	});
	// Genera combogrid nhansu
	define_cbgNhansu('NhansuId');
	
	$("input[name='mode']").change(function() {
		var mode = $(this).val();
		$('#NhansuId').combogrid({
			mode : mode
		});
	});
	$('#DangthuocId').combogrid({
		panelWidth:350,
		panelHeight:320,
		pagination:true,
		nowrap:true,
		width: 153,
		fitColumns:false,
		border:false,
		fit:true,
		editable : false,
		rownumbers:true, 
		idField:'Id',
		textField:'Tendangthuoc',
		mode:'remote',
		toolbar:('#combogrid-dangthuoc-toolbar'),
		url:'../thuocvattu/dangthuoc/combo',
		columns:[[
			{field:'Id',title:'Id',hidden:true},
			{field:'Tendangthuoc',title:'Tên dạng thuốc',width:145}
		]]
	});
	$('#PhuongphapdieutriId').combobox('reload', 'phuongphapdieutri/combo');
	reset_format_date('#Ngaylapphieu');
	reset_format_date('#Ngaysinh');
	$('#div_fm_khambenh').append($('#fm-khambenh'));
}
// Khoi tao control la combogrid cho phieu kham benh.
function define_cbgPhieukhambenh(id) {
	$('#'+id).combogrid({
		panelWidth:550,
		panelHeight:300,
		rownumbers:true,
		fitColumns:true,
		fit:true,
		toolbar:true,
		pagination:true,
		editable : false,
		mode:'remote',
		idField:'Id',
		toolbar:('#combogrid-toolbar-masophieu'),
		textField:'Sophieukcb',
		url:'../khambenh/khambenh/combogrid',
		columns:[[
			{field:'Id',title:'Id',hidden:true},
			{field:'Sophieukcb',title:'Mã Số Phiếu',width:90},
			{field:'Ngaylapphieu',title:'Ngày Lập Phiếu',width:95},
			{field:'Hoten',title:'Người Bệnh',width:140},
			{field:'Tinhtrang',title:'Tình trạng', width:100, formatter: formattrangthai}
		]]
	});
}

function define_cbgNhansu(id) {
	$('#'+id).combogrid({
		panelWidth : 550,
		panelHeight : 320,
		width: 152,
		pagination : true,
		nowrap : true,
		fitColumns : false,
		border : false,
		fit : true,
		editable : false,
		idField : 'Id',
		pageSize : 30,
		textField : 'Hoten',
		mode : 'remote',
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
			width : 80
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
}

function formattinhtrang(val, row) {
	if (val == 0)
		return '<label style="color:red">Kết thúc hoạt động</lable>';
	else
		return '<label>Đang hoạt động</lable>';
}
function formattrangthai_nv(val, row) {
	if (val == '')
		return '<label style="color:blue">Đang hoạt động</lable>';
	else
		return '<label style="color:red">Ngừng hoạt động</lable>';
}
function sear() {
	var Maphieu = $('#sSp').val();
	var Ngaylap = $('#sNLap').datebox('getValue');
	var Nguoikham = $('#sNk').val();
	var Nguoibenh = $('#sNb').val();
	var Benhdich = $('#sBd').val();
	var sgioitinh = $('#sGioitinh').combobox('getValue');
	var sThonto = $('#sThonto').combobox('getValue');
	if(Ngaylap.length >0 ){
		Ngaylap = Ngaylap.replace(new RegExp("/","gm"),"$");
	}

	if (Maphieu.length > 0 || Ngaylap.length > 0 || Nguoikham.length > 0
			|| Nguoibenh.length > 0 || Benhdich.length > 0
			|| (sgioitinh.length > 0 && sgioitinh != 'Tatca')
			|| sThonto.length > 0) {
		if (Ngaylap.length > 0)
			Ngaylap = Ngaylap.replace("/", "$", 'g');
		$('#dg-khambenh').datagrid('options').url = 'khambenh/sear/Maphieu/'
				+ Maphieu + '/Ngaylap/' + Ngaylap + '/Nguoikham/' + Nguoikham
				+ '/Nguoibenh/' + Nguoibenh + '/Benhdich/' + Benhdich
				+ '/sgioitinh/' + sgioitinh + '/sThonto/' + sThonto;
	} else {
		$('#dg-khambenh').datagrid('options').url = 'khambenh/json';
	}
	$('#dg-khambenh').datagrid('reload');
}

function add_khambenh() {
	define_khambenh();
	$('#dlg-khambenh').dialog('open').dialog('setTitle', 'Thêm phiếu khám bệnh');
	option = 'add';
	$('#fm-khambenh').form('clear');
	document.getElementById("label-sbh").style.display="none";
	document.getElementById("input-sbh").style.display="none";
	$('#fm-khambenh').form('load','khambenh/generaform');
	url = 'khambenh/add';
}

function edit_khambenh() {
		var row = $('#dg-khambenh').datagrid('getSelected');
		if (row) {
			define_khambenh();
			$('#fm-khambenh').form('clear');
			$('#dlg-khambenh').dialog('open').dialog('setTitle', 'Sửa phiếu khám bệnh');
			$('#fm-khambenh').form('load', 'khambenh/getobjbyid/Sophieukcb/' + row.Sophieukcb);
			$('#BenhdichId').combogrid('setText', row.Benhdich);
			$('#NhankhauId').combogrid('setValue', row.NhankhauId);
			$('#NhansuId').combogrid('setText', row.Nguoikham);
			$('#DiadiemId').combobox('setValue', row.DiadiemId);
			if(row.Doituong == 1){
				document.getElementById("label-sbh").style.display="block";
				document.getElementById("input-sbh").style.display="block";
				$('#Sobaohiem').combogrid({
					panelWidth:400,
					panelHeight:200,
					pagination:true,
					nowrap:true,
					width: 153,
					fitColumns:false,
					border:false,
					fit:true,
					required:true,
					editable : false,
					rownumbers:true, 
					idField:'Sobaohiem',
					textField:'Sobaohiem',
					mode:'remote',
					url:'../danso/dienbienbaohiemnhankhau/combogrid/nhankhauId/'+row.NhankhauId,
					columns:[[
						{field:'Id',title:'Id',hidden:true},
						{field:'Sobaohiem',title:'Số bảo hiểm',width:145},
						{field:'Tungay',title:'Tù ngày',width:100},
						{field:'Denngay',title:'Đến ngày',width:100}
					]]
				});
				$('#Sobaohiem').combogrid('setValue',row.Sobaohiem);
				$('#Sobaohiem').combogrid('setText',row.Sobaohiem);
			}else{
				document.getElementById("label-sbh").style.display="none";
				document.getElementById("input-sbh").style.display="none";
				$('#Sobaohiem').combogrid({
					required:false
				});
			}
			url = 'khambenh/update/id/'+row.Id;
		} else {
			show_messager('Không có bản ghi nào được chọn!');
		}
}

function del_khambenh() {
	var rows = $('#dg-khambenh').datagrid('getChecked');
	numberrow = rows.length;
	if (numberrow > 0) {
		$.messager.confirm('Thông báo', 'Bạn có chắc chắn muốn xóa '
				+ numberrow + ' phần tử?', function(r) {
			if (r) {
				$.post('khambenh/del', {
					items : rows
				}, function(result) {
					if (result.success) {
						$('#dg-khambenh').datagrid('reload');
						$('#dg-khambenh').datagrid('uncheckAll');
						show_messager('Cập nhật dữ liệu thành công!');
					} else {
						show_messager('Cập nhật dữ liệu không thành công!');
					}
				}, 'json');
			}
		});
	} else {
		show_messager('Không có bản ghi nào được chọn!');
	}
}

function save_khambenh() {
	$('#fm-khambenh').form('submit', {
		url : url,
		onSubmit : function() {
			if ($(this).form('validate')) {
				if (!checkValue())
					return false;
				return true;
			} else
				return false;
		},
		success : function(result) {
			//str = JSON.stringify(result); show_messager(str); return;
			var result = eval('(' + result + ')');
			if (result.success) {
				$('#dlg-khambenh').dialog('close');
				$('#dg-khambenh').datagrid('reload');
				show_messager('Cập nhật dữ liệu thành công!');
			} else {
				show_messager('Cập nhật dữ liệu không thành công!');
			}
		}
	});
}

function checkValue() {
	var re = new RegExp(/^\d+$/);
	if (!isDate($('#Ngaylapphieu').datebox('getValue'))) {
		show_messager('Định dạng Ngày lập phiếu nhập vào không đúng!');
		return false;
	}
	return true;
}

function combogridNhankhau() {
	var cb_checked = document.getElementById("Vanglai").checked;
	if (cb_checked) {
		$('#NhankhauId').combogrid('grid').datagrid('options').url = '../danso/nhankhau/combogridvanglai';
	} else {
		$('#NhankhauId').combogrid('grid').datagrid('options').url = '../danso/nhankhau/combogrid1';
	}
	$('#NhankhauId').combogrid('grid').datagrid('reload');
}

function setMabenhnhan() {
	var obj = $('#NhankhauId').combogrid('grid').datagrid('getSelected');
	//reload();
	if (obj.Mabenhnhan != 'null'){
			document.getElementById("Mabenhnhan").value = obj.Mabenhnhan;
			$('#Sobaohiem').combogrid({
				panelWidth:400,
				panelHeight:200,
				pagination:true,
				nowrap:true,
				width: 153,
				fitColumns:false,
				border:false,
				fit:true,
				reload:true,
				editable : false,
				rownumbers:true, 
				idField:'Sobaohiem',
				textField:'Sobaohiem',
				mode:'remote',
				url:'../danso/dienbienbaohiemnhankhau/combogrid/nhankhauId/' + obj.Id,
				columns:[[
					{field:'Id',title:'Id',hidden:true},
					{field:'Sobaohiem',title:'Số bảo hiểm',width:145},
					{field:'Tungay',title:'Từ ngày',width:100},
					{field:'Denngay',title:'Đến ngày',width:100}
				]]
			});
	}else{
		document.getElementById("Mabenhnhan").value = '';
		$('#Mabenhnhan').focus();
	}
	return idnk = obj.Id;
}
function setSobaohiem(_value) {
	value = _value;
	if(value == 1){
		document.getElementById("label-sbh").style.display="inline";
		document.getElementById("input-sbh").style.display="inline";
		$('#Sobaohiem').combogrid({
			required:true
		});
		//var g = $('#NhankhauId').combogrid('grid');	// get datagrid object
		//var r = g.datagrid('getSelected');	// get the selected row
		//alert(r.Id);
	}else{
		document.getElementById("label-sbh").style.display="none";
		document.getElementById("input-sbh").style.display="none";
		$('#Sobaohiem').combogrid({
			required:false
		});
	}
}

function formatXem(val, row) {
	return '<a href="#" class="easyui-linkbutton l-btn l-btn-plain" iconcls="icon-sum" plain="true" onclick="formview_details(\''
	+row.Id
	+'\',\''
	+row.Sophieukcb
	+'\')" id="" style="font-weight:bold;">Xem</a>';
}
function formview_details(id, sophieukcb) {
	$('#dlg-viewkhambenh').dialog('open').dialog('setTitle','Thông tin khám bệnh');
	$('#frmViewPhieu').form('clear');
	$('#frmViewPhieu').form('reset');
	$('#frmViewPhieu').form('load','khambenh/detail/Id/' + id);
}
function formview_details_close() {
	$('#dlg-khambenh-chitiet').dialog('close');
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
var lastIndex;
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
									cSoluongcon : rowData.Soluong,
									cId : rowData.Id

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
			formatter : formattinhtrang
		} ] ]
	});
	reset_format_date('#Ngaynhapxuat');
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
function formattinhtrang(val, row) {
	if (val == 0)
		return '<label style="color:red">Kết thúc hoạt động</lable>';
	else
		return '<label>Đang hoạt động</lable>';
}
function add_donthuoc() {
	var row = $('#dg-khambenh').datagrid('getSelected');
	if (row) {
		if (row.Chutrinhdieutri == 1) {
			temp = true;
			$('#dlg-donthuoc').dialog('open').dialog('setTitle',
					'Thêm đơn thuốc cho phiếu khám {' + row.Sophieukcb + '}');
			$('#fm-donthuoc').form('clear');
			$('#fm-donthuoc').form('load', {
				SophieukcbĐT : row.Id
			});
			$('#dg-tvtduocchon').datagrid('loadData', {
				total : 0,
				rows : []
			});
			$('#dg-thuoc').datagrid('reload');
			$('#Nguoinhapxuat').combogrid('setValue', row.NhansuId);
			$('#Nguoinhapxuat').combogrid('setText', row.Nguoikham);
		} else {
			show_messager('Không được thêm đơn thuốc cho phiếu khám ngừng điều trị!');
		}
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
				return;
			}
			if (items.length) {
				for (item in items) {
					if (row) {
						if (items[item].cSoluong == null
								|| items[item].cDongia == null
								|| items[item].cSoluong <= 0
								|| items[item].cDongia <= 0) {
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
		url : 'khambenh/adddonthuoc',
		success : function(result) {
			var result = eval('(' + result + ')');
			if (result.success) {
				$('#dlg-donthuoc').dialog('close');
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

function printDS() {
	var Maphieu = $('#sSp').val();
	var Ngaylap = $('#sNLap').datebox('getValue');
	var Nguoikham = $('#sNk').val();
	var Nguoibenh = $('#sNb').val();
	var Benhdich = $('#sBd').val();
	var sgioitinh = $('#sGioitinh').combobox('getValue');
	var sThonto = $('#sThonto').combobox('getValue');
	if(Ngaylap.length >0 ){
		Ngaylap = Ngaylap.replace(new RegExp("/","gm"),"$");
	}
	if (Maphieu.length > 0 || Ngaylap.length > 0 || Nguoikham.length > 0
			|| Nguoibenh.length > 0 || Benhdich.length > 0
			|| (sgioitinh.length > 0 && sgioitinh != 'Tatca')
			|| sThonto.length > 0) {
		if (Ngaylap.length > 0)
			Ngaylap = Ngaylap.replace("/", "$", 'g');
		window.open('khambenh/expxlsnstyt/NoWhere/0/Maphieu/' + Maphieu
				+ '/Ngaylap/' + Ngaylap + '/Nguoikham/' + Nguoikham
				+ '/Nguoibenh/' + Nguoibenh + '/Benhdich/' + Benhdich
				+ '/sgioitinh/' + sgioitinh + '/sThonto/' + sThonto);
	} else {
		window.open('khambenh/expxlsnstyt/NoWhere/1');
	}
}

// ---------------------------------------------------------------------
// phadh tim kiem trong combogrid benh dich
function sear_combo_benhdich() {
	var sBd = $('#sbenhdich').val();
	var sICD = $('#sICD').val();
	var sTen = $('#sTen').val();
	if (sBd.length > 0 || sICD.length > 0 || sTen.length > 0) {
		$('#BenhdichId').combogrid('grid').datagrid('options').url = 'benhdich/combo/sBd/'
				+ sBd + '/sICD/' + sICD + '/sTen/' + sTen;
	} else {
		$('#BenhdichId').combogrid('grid').datagrid('options').url = 'benhdich/combo';
	}
	$('#BenhdichId').combogrid("grid").datagrid('reload');
}

// phadh thay doi chu trinh dieu tri
function formatTrangthai(value, row, index) {
	if (value == '1') {
		var f = '<a href="#" onclick="onChangeTrangthai(\''
				+ row.Id
				+ '\', \''
				+ row.Hoten
				+ '\', \''
				+ row.Chutrinhdieutri
				+ '\', 1)" style="text-decoration: underline;">Đang điều trị</a> ';
		return f;
	} else if (value == '2') {
		var t = '<a href="#" onclick="onChangeTrangthai(\''
				+ row.Id
				+ '\', \''
				+ row.Hoten
				+ '\', \''
				+ row.Chutrinhdieutri
				+ '\', 2)" style="text-decoration: underline;">Chuyển viện</a> ';
		return t;
	} else if (value == '0') {
		var x = '<a href="#" onclick="onChangeTrangthai(\'' + row.Id + '\', \''
				+ row.Hoten + '\', \'' + row.Chutrinhdieutri
				+ '\', 3)" style="text-decoration: underline;">Kết thúc</a> ';
		return x;
	} else if (value == '3') {
		var k = '<a href="#" onclick="onChangeTrangthai(\'' + row.Id + '\', \''
				+ row.Hoten + '\', \'' + row.Chutrinhdieutri
				+ '\', 4)" style="text-decoration: underline;">Tử vong</a> ';
		return k;
	}else if (value == '4') {
		var l = '<a href="#" onclick="onChangeTrangthai(\'' + row.Id + '\', \''
			+ row.Hoten + '\', \'' + row.Chutrinhdieutri
			+ '\', 5)" style="text-decoration: underline;">Khỏi</a> ';
		return l;
	}else if (value == '5') {
		var m = '<a href="#" onclick="onChangeTrangthai(\'' + row.Id + '\', \''
			+ row.Hoten + '\', \'' + row.Chutrinhdieutri
			+ '\', 6)" style="text-decoration: underline;">Đỡ, ổn định</a> ';
		return m;
	}else if (value == '6') {
		var n = '<a href="#" onclick="onChangeTrangthai(\'' + row.Id + '\', \''
			+ row.Hoten + '\', \'' + row.Chutrinhdieutri
			+ '\', 7)" style="text-decoration: underline;">Nặng, xin về</a> ';
		return n;
	}else if (value == '7') {
		var o = '<a href="#" onclick="onChangeTrangthai(\'' + row.Id + '\', \''
			+ row.Hoten + '\', \'' + row.Chutrinhdieutri
			+ '\', 8)" style="text-decoration: underline;">Trốn viện/ mất theo dõi</a> ';
		return o;
	}
}
function onChangeTrangthai(vId, name, Chutrinhdieutri) {
	if (vId) {
		$('#fm-chutrinh').form('clear');
		$('#fm-chutrinh').form('load', {
			Id : vId,
			Chutrinh : Chutrinhdieutri
		});
		$('#dlg-chutrinh').dialog('open').dialog('setTitle',
				'Cập nhật chu trình điều trị {' + name + '}');
	} else {
		show_messager('Không thể thay đổi trạng thái ngay bây giờ!');
	}
}

function save_chutrinhdieutri() {
	$('#fm-chutrinh').form('submit', {
		url : 'khambenh/changechutrinh',
		onSubmit : function() {
			return $(this).form('validate');
		},
		success : function(result) {
			var result = eval('(' + result + ')');
			if (result.success) {
				$('#dlg-chutrinh').dialog('close');
				$('#dg-khambenh').datagrid('reload');
				show_messager('Cập nhật dữ liệu thành công!');
			} else {
				show_messager('Cập nhật dữ liệu không thành công!');
			}
		}
	});
}

// /////////////////////////////////////////Phadh View bao cao kham
// benh////////////////////////////////////
function printview() {
	var Maphieu = $('#sSp').val();
	var Ngaylap = $('#sNLap').datebox('getValue');
	var Nguoikham = $('#sNk').val();
	var Nguoibenh = $('#sNb').val();
	var Benhdich = $('#sBd').val();
	var sgioitinh = $('#sGioitinh').combobox('getValue');
	var sThonto = $('#sThonto').combobox('getValue');

	if (Maphieu.length > 0 || Ngaylap.length > 0 || Nguoikham.length > 0
			|| Nguoibenh.length > 0 || Benhdich.length > 0
			|| (sgioitinh.length > 0 && sgioitinh != 'Tatca')
			|| sThonto.length > 0) {
		if (Ngaylap.length > 0)
			Ngaylap = Ngaylap.replace("/", "$", 'g');
		window.open('printview/printviewdskhambenh/NoWhere/0/Maphieu/'
				+ Maphieu + '/Ngaylap/' + Ngaylap + '/Nguoikham/' + Nguoikham
				+ '/Nguoibenh/' + Nguoibenh + '/Benhdich/' + Benhdich
				+ '/sgioitinh/' + sgioitinh + '/sThonto/' + sThonto);
	} else {
		window.open('printview/printviewdskhambenh/NoWhere/1');
	}
}
// /////////////////////////////////////////////////////////////////////////////////////////////////////////
function numberFormat(nr) {
	// remove the existing ,
	var regex = /,/g;
	nr = nr.replace(regex, '');
	// force it to be a string
	nr += '';
	// split it into 2 parts (for numbers with decimals, ex: 125.05125)
	var x = nr.split('.');
	var p1 = x[0];
	var p2 = x.length > 1 ? '.' + x[1] : '';
	// match groups of 3 numbers (0-9) and add , between them
	regex = /(\d+)(\d{3})/;
	while (regex.test(p1)) {
		p1 = p1.replace(regex, '$1' + ',' + '$2');
	}
	// join the 2 parts and return the formatted number
	return p1 + p2;
}
function sear_combo(){
	var sdangthuoc = $('#sdangthuoc').val();
	if (sdangthuoc.length > 0) {
		$('#DangthuocId').combogrid('grid').datagrid('options').url = '../thuocvattu/dangthuoc/combo/sdangthuoc/'+ sdangthuoc ;
	} else {
		$('#DangthuocId').combogrid('grid').datagrid('options').url = '../thuocvattu/dangthuoc/combo';
	}
	$('#DangthuocId').combogrid("grid").datagrid('reload');
}
/***************them mới diễn biến bảo hiểm của nhân khẩu*******************************/
function add_sobaohiem(){
	setMabenhnhan();
	//alert(idnk);
	$('#dlg-sobaohiem').dialog('open').dialog('setTitle','Diễn biến mới bảo hiểm y tế');
	$('#fm-sobaohiem').form('clear');
	$("#fm-sobaohiem input[name='Nhankhauidnk']").val(idnk);
	$('#XaId').combogrid({
		panelWidth : 500,
		panelHeight : 320,
		pagination : true,
		nowrap : true,
		fitColumns : false,
		border : false,
		fit : true,
		required:true,
		idField : 'Id',
		textField : 'Tenxa',
		editable:false,
		mode : 'remote',
		toolbar:('#toolbar-combo-xa'),
		url : '../danso/xa/combogridbycoquanhuyen',
		columns : [ [ {
			field : 'Id',
			title : 'Id',
			hidden : true
		}, {
			field : 'Tenxa',
			title : 'Tên xã',
			width : 100
		}, {
			field : 'Tenhuyen',
			title : 'Tên huyện',
			width : 145
		}, {
			field : 'Tentinh',
			title : 'Tên tỉnh',
			width : 140
		} ] ]
	});
	$("input[name='mode']").change(function() {
		var mode = $(this).val();
		$('#XaId').combogrid({
			mode : mode
		});
	});
	reset_format_date('#Tungay');
	reset_format_date('#Denngay');
}
function checkValue_sbh() {
	if (!isDate($('#Tungay').datebox('getValue'))) {
		show_messager('Định dạng Ngày nhập vào không đúng!');
		return false;
	}
	if (!isDate($('#Denngay').datebox('getValue'))) {
		show_messager('Định dạng Ngày nhập vào không đúng!');
		return false;
	}
	return true;
}
function save_sobaohiem(){
	if(!checkValue_sbh()){
		return;
	}
	$('#fm-sobaohiem').form('submit',{
		url: '../danso/Dienbienbaohiemnhankhau/add',
		onSubmit: function(){
			return $(this).form('validate');
		},
		success: function(result){
			var result = eval('('+result+')');
			if (result.success){
				show_messager('Cập nhật dữ liệu thành công!');
				$('#dlg-sobaohiem').dialog('close');
				$('#Sobaohiem').combogrid('grid').datagrid('reload');
			} else {
				$.messager.show({
					title: 'Error',
					msg: result.msg
				});
			}
		}
	});
}
function sear_combo_xa_sbh() {
	var sXa = $('#sXa').val();
	var sHuyen = $('#sHuyen').val();
	var sTinh = $('#sTinh').val();
	if (sXa.length > 0 || sHuyen.length > 0 || sTinh.length > 0) {
		$('#XaId').combogrid('grid').datagrid('options').url = '../default/xa/combogrid/sXa/' + sXa + '/sHuyen/' + sHuyen + '/sTinh/' + sTinh;
	} else {
		$('#XaId').combogrid('grid').datagrid('options').url = '../default/xa/combogrid';
	}
	$('#XaId').combogrid("grid").datagrid('reload');
}

function del_chitietkhamthai(){
	var row = $('#dg_khamthai').datagrid('getSelected');
	if (row){
		$.messager.confirm('Thông báo','Bạn có chắc chắn muốn xóa?',function(r){
			if (r){
				$.post('ctkhamthai/delete',{id:row.Id},function(result){
					if (result.success){
						$('#dg_khamthai').datagrid('reload');	
						show_messager('Xóa dữ liệu thành công!');	
					} else {
						show_messager('Xóa dữ liệu không thành công!');	
					}
				},'json');
			}
		});
	}else{
		show_messager('Không có bản ghi nào được chọn!');		
	}
}