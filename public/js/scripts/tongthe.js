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
function innitkhambenh()
{
	
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
	
	$('#NhansuId').combogrid({
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
	$("input[name='mode']").change(function() {
		var mode = $(this).val();
		$('#NhansuId').combogrid({
			mode : mode
		});
	});
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
		} ] ],
	});
	$("input[name='mode']").change(function() {
		var mode = $(this).val();
		$('#NhankhauId').combogrid({
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
			{field:'Tendangthuoc',title:'Thông tin dạng thuốc',width:145}
		]]
	});

	reset_format_date('#Ngaylapphieu');
	reset_format_date('#Ngaysinh');
	$('#combogrid-nhankhau-toolbar').load(
	'../danso/nhankhau/combogridtoolbar #tbl-cbg-toolbar');
}
$(function() {
	innitkhambenh();
	$('#dg_khamthai').edatagrid({
		url : ''
	});
	$('#fm-khambenh').form({
		onLoadSuccess: function(data){
			Sophieukcb = data.Sophieukcb;
			//alert(Sophieukcb);
			reload_sub_dg();
		}
	});
	
	/*$('#NhankhauCv').combogrid({
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
	
	$('#PhieukhambenhId').combogrid({
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
			});
	$('#fm-hokhau').load('../danso/hokhau/formhokhau #etb',
			function(responseText, textStatus, XMLHttpRequest) {
				if (textStatus == "success")
					cbg_define_hokhau();
			});
			*/
	$('#BenhdichId').combogrid({
		panelWidth : 550,
		panelHeight : 320,
		pagination : true,
		nowrap : true,
		width : 153,
		fitColumns : false,
		border : false,
		fit : true,
		editable : false,
		rownumbers : true,
		idField : 'Id',
		textField : 'Tenbenhdich',
		mode : 'remote',
		toolbar : ('#combogrid-toolbar-benhdich'),
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
	//define_nhankhau();
	reset_format_date('#sNLap');
	reset_format_date('#Ngaycap');
	reset_format_date('#Ngayvaodang');
	reset_format_date('#NGayvaodoan');
	reset_format_date('#Ngaydieutri');
	reset_format_date('#Ngaykinhcuoi');
	reset_format_date('#Ngaykinhcuoipt');
	reset_format_date('#Ngaysinh');
	reset_format_date('#NgaysinhNS');
	reset_format_date('#NgaysinhNK');
	reset_format_date('#Ngaytainan');
	reset_format_date('#Ngaykinhcuoikt');
	reset_format_date('#Ngaykhoiphat');
	//reset_format_date('#Giatritu');
	//reset_format_date('#Giatriden');
	//define_donthuoc();
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
	
	$('#PhuongphapdieutriId').combobox('reload', 'phuongphapdieutri/combo');
	reset_format_date('#Ngaylapphieu');
	reset_format_date('#Ngaysinh');
	$('#div_fm_khambenh').append($('#fm-khambenh'));
	$('#DiadiemId').combobox('reload','Diadiem/combo');
	$('#LoaihinhkhamId').combobox('reload','Loaihinhkham/combo');
	$('#DiadiemIdss').combobox('reload','diadiem/combo');
	$('#HinhthucsinhsanId').combobox('reload','hinhthucsinhsan/combo');
	$('#TaibiensinhsanId').combobox('reload','taibiensinhsan/combo');
	$('#DiadiemIdpt').combobox('reload','Diadiem/combo');
	$('#DiadiemIdkh').combobox('reload','Diadiem/combo');
	$('#DiadiemtainanId').combobox('reload','Diadiemtainan/combo');
	$('#NguyennhantainanId').combobox('reload','Nguyennhantainan/combo');
	$('#XulytainanId').combobox('reload','Xulytainan/combo');	
	$('#PhuongphapdieutriId').combobox('reload', 'phuongphapdieutri/combo');
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
		$('#dg-khambenh').datagrid('options').url = 'tongthe/sear/Maphieu/'
				+ Maphieu + '/Ngaylap/' + Ngaylap + '/Nguoikham/' + Nguoikham
				+ '/Nguoibenh/' + Nguoibenh + '/Benhdich/' + Benhdich
				+ '/sgioitinh/' + sgioitinh + '/sThonto/' + sThonto;
	} else {
		$('#dg-khambenh').datagrid('options').url = 'tongthe/json';
	}
	$('#dg-khambenh').datagrid('reload');
}

function add_khambenh() {
    $('#dg_khamthai').datagrid('loadData', {"total":0,"rows":[]});
	define_khambenh();
	$('#dlg-khambenh').dialog('open')
			.dialog('setTitle', 'Thêm phiếu khám bệnh');
	option = 'add';
	$('#fm-khambenh').form('clear');
	//$('#fm-khambenh').form('load','tongthe/generaform');
	 var d = new Date();
	 var n = 'KB'+ d.getTime().toString(); 
	$('#Sophieukcb').val(n);		
	$('#detail-etbs').tabs('select', 0);
	$('#detail-etbs').tabs('disableTab', 1);
	$('#detail-etbs').tabs('disableTab', 2);
	$('#detail-etbs').tabs('disableTab', 3);
	$('#detail-etbs').tabs('disableTab', 4);
	$('#detail-etbs').tabs('disableTab', 5);
	$('#detail-etbs').tabs('disableTab', 6);
	$('#detail-etbs').tabs('disableTab', 7);
	$('#detail-etbs').tabs('disableTab', 8);
	$('#detail-etbs').tabs('disableTab', 9);
	document.getElementById("label-sbh").style.display="none";
	document.getElementById("input-sbh").style.display="none";
	//dieutriNoitru('null');
	url = 'tongthe/add';
}
function initsobaohiembyedit(NhankhauId,Doituong,Sobaohiem)
{
	if(Doituong==1)
		{
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
				editable : true,
				rownumbers:true, 
				idField:'Sobaohiem',
				textField:'Sobaohiem',
				mode:'remote',
				url:'../danso/dienbienbaohiemnhankhau/combogrid/nhankhauId/' + NhankhauId,
				columns:[[
					{field:'Id',title:'Id',hidden:true},
					{field:'Sobaohiem',title:'Số bảo hiểm',width:145},
					{field:'Tungay',title:'Từ ngày',width:100},
					{field:'Denngay',title:'Đến ngày',width:100}
				]]
			});
			document.getElementById("label-sbh").style.display="inline";
			document.getElementById("input-sbh").style.display="inline";
			$('#Sobaohiem').combogrid('setValue',Sobaohiem);
		}else
		{
			document.getElementById("label-sbh").style.display="none";
			document.getElementById("input-sbh").style.display="none";
			$('#Sobaohiem').combogrid({
				required:false
			});
		}
}

function edit_khambenh() {
	try {
		var row = $('#dg-khambenh').datagrid('getSelected');//getData,getRows
    	if (row) {
			define_khambenh();
			$('#fm-khambenh').form('clear');
			$('#dlg-khambenh').dialog('open').dialog('setTitle',
					'Sửa phiếu khám bệnh');
			$('#fm-khambenh').form('load', 'tongthe/getobjbyid/Sophieukcb/' + row.Sophieukcb);
			//$('#fm-khambenh').form('load', row);
			if(row.Sobaohiem!='')
			{	initsobaohiembyedit(row.NhankhauId,1,row.Sobaohiem);				
			}	
			if(row.Sotret == 1){
				$('#detail-etbs').tabs('enableTab', 1);
				document.getElementById("sotret").checked = true;
			}else{
				$('#detail-etbs').tabs('disableTab', 1);
				document.getElementById("sotret").checked = false;
			}
			if(row.Hiv == 1){
				$('#detail-etbs').tabs('enableTab', 2);
				document.getElementById("hiv").checked = true;
				//alert(row.Hienmac);
			}else{
				$('#detail-etbs').tabs('disableTab', 2);
				document.getElementById("hiv").checked = false;
			}
			if(row.Tamthan == 1){
				$('#detail-etbs').tabs('enableTab', 3);
				document.getElementById("tamthan").checked = true;
			}else{
				$('#detail-etbs').tabs('disableTab', 3);
				document.getElementById("tamthan").checked = false;
			}
			if(row.Sinhsan == 1){
				$('#detail-etbs').tabs('enableTab', 4);
				document.getElementById("sinhsan").checked = true;
			}else{
				$('#detail-etbs').tabs('disableTab', 4);
				document.getElementById("sinhsan").checked = false;
			}
			if(row.Phathai == 1){
				$('#detail-etbs').tabs('enableTab', 5);
				document.getElementById("phathai").checked = true;
			}else{
				$('#detail-etbs').tabs('disableTab', 5);
				document.getElementById("phathai").checked = false;
			}
			if(row.Khhgd == 1){
				$('#detail-etbs').tabs('enableTab', 6);
				document.getElementById("khhgd").checked = true;
			}else{
				$('#detail-etbs').tabs('disableTab', 6);
				document.getElementById("khhgd").checked = false;
			}
			if(row.Thuongtich == 1){
				$('#detail-etbs').tabs('enableTab', 7);
				document.getElementById("thuongtich").checked = true;
			}else{
				$('#detail-etbs').tabs('disableTab', 7);
				document.getElementById("thuongtich").checked = false;
			}
			if(row.Khamthai == 1){
				$('#detail-etbs').tabs('enableTab', 8);
				document.getElementById("khamthai").checked = true;
			}else{
				$('#detail-etbs').tabs('disableTab', 8);
				document.getElementById("khamthai").checked = false;
			}
			if(row.Chantaymieng == 1){
				$('#detail-etbs').tabs('enableTab', 9);
				document.getElementById("ctm").checked = true;
			}else{
				$('#detail-etbs').tabs('disableTab', 9);
				document.getElementById("ctm").checked = false;
			}
			
			$('#DangthuocId').combogrid('setText',row.Tendangthuoc);
			$('#BenhdichId').combogrid('setText',row.Benhdich);
			
			if(row.Gioitinh == 'Nam'){
				document.getElementById("phathai").disabled = true;
				document.getElementById("sinhsan").disabled = true;
				document.getElementById("khamthai").disabled = true;
			}else{
				document.getElementById("phathai").disabled = false;
				document.getElementById("sinhsan").disabled = false;
				document.getElementById("khamthai").disabled = false;
			}
			
			$('#Cannang').numberbox('setValue', row.Cannang);
			//dieutriNoitru(row.Phuongphapdieutri);
			
			$('#detail-etbs').tabs('select', 0);
			url = 'tongthe/update/id/' + row.Id+			
			'/Idsr/' + row.Idsr+			
			'/Idhiv/' + row.Idhiv+			
			'/Idtt/' + row.Idtt+
			'/Idss/' + row.Idss+
			'/Idpt/' + row.Idpt+
			'/Idkhhgd/'+row.Idkhhgd+
			'/Idtntt/'+row.Idtntt+
			'/Idkt/'+row.Idkt+
			'/Idctm/'+row.Idctm +
			'/Sophieukcbold/'+row.Khambenh_Sophieukcb;
		} else {
			show_messager('Không có bản ghi nào được chọn!');
		}
	} catch (e) {
		alert(e);
	}
}

function del_khambenh() {
	var rows = $('#dg-khambenh').datagrid('getChecked');
	numberrow = rows.length;
	if (numberrow > 0) {
		$.messager.confirm('Thông báo', 'Bạn có chắc chắn muốn xóa '
				+ numberrow + ' phần tử?', function(r) {
			if (r) {
				$.post('tongthe/del', {
					items : rows
				}, function(result) {
					if (result.success) {
						$('#dg-khambenh').datagrid('reload');
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
	$('#dg_khamthai').datagrid('acceptChanges');
	var items = $('#dg_khamthai').datagrid('getRows');
	document.getElementById('kt').value = JSON.stringify(items);
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
				//$('#NhankhauId').combogrid('grid').datagrid('reload');
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
				editable : true,
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
				]],
				onSelect:function(index,row){
			     	document.getElementById('Giatritu').value = row.Tungay;
			     	document.getElementById('Giatriden').value=row.Denngay;					
			    }
			});
			$('#Sobaohiem').combogrid('setText','');
			$('#Sobaohiem').combogrid('setValue','');
			document.getElementById('Giatritu').value = '';
	     	document.getElementById('Giatriden').value='';		
		}else{
			document.getElementById("Mabenhnhan").value = '';
		$('#Mabenhnhan').focus();
		}
	if(obj.Gioitinh == 'Nam'){
		document.getElementById("phathai").checked = false;
		document.getElementById("sinhsan").checked = false;
		document.getElementById("khamthai").checked = false;
		document.getElementById("phathai").disabled = true;
		document.getElementById("sinhsan").disabled = true;
		document.getElementById("khamthai").disabled = true;
		$('#detail-etbs').tabs('disableTab', 'Sinh sản');
		$('#detail-etbs').tabs('disableTab', 'Phá thai');
		$('#detail-etbs').tabs('disableTab', 'Khám thai');
		$('#detail-etbs').tabs('select', 0);
	}else{
		document.getElementById("phathai").disabled = false;
		document.getElementById("sinhsan").disabled = false;
		document.getElementById("khamthai").disabled = false;
	}
	return idnk = obj.Id;
}
function setMabenhnhanbyIdNhankhau(value) {
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
				editable : true,
				rownumbers:true, 
				idField:'Sobaohiem',
				textField:'Sobaohiem',
				mode:'remote',
				url:'../danso/dienbienbaohiemnhankhau/combogrid/nhankhauId/' + value,
				columns:[[
					{field:'Id',title:'Id',hidden:true},
					{field:'Sobaohiem',title:'Số bảo hiểm',width:145},
					{field:'Tungay',title:'Từ ngày',width:100},
					{field:'Denngay',title:'Đến ngày',width:100}
				]],
				onSelect:function(index,row){
			     	document.getElementById('Giatritu').value = row.Tungay;
			     	document.getElementById('Giatriden').value=row.Denngay;					
			    }
			});
			$('#Sobaohiem').combogrid('setText','');
			$('#Sobaohiem').combogrid('setValue','');
			document.getElementById('Giatritu').value = '';
	     	document.getElementById('Giatriden').value='';	
	return idnk = value;
}
function setSobaohiem(_value) {
	value = _value;
	if(value == 1){
		//$('#Sobaohiem').combogrid('setValue','');
		document.getElementById("label-sbh").style.display="inline";
		document.getElementById("input-sbh").style.display="inline";
		$('#Sobaohiem').combogrid({
			required:true
		});
		$('#Sobaohiem').combogrid('setText',null);
		$('#Sobaohiem').combogrid('setValue',null);
	}else{
		document.getElementById("label-sbh").style.display="none";
		document.getElementById("input-sbh").style.display="none";
		document.getElementById('Giatritu').value = '';
     	document.getElementById('Giatriden').value='';	
		$('#Sobaohiem').combogrid({
			required:false
		});
	}
}
function nguyennhanThaisan(str) {
	if ((new RegExp('thai')).test(str) || (new RegExp('sản')).test(str)
			|| (new RegExp('đẻ')).test(str)
			|| (new RegExp('tử cung')).test(str)
			|| (new RegExp('Băng huyết')).test(str)
			|| (new RegExp('Uốn ván')).test(str)
			|| (new RegExp('Sản')).test(str)) {
		document.getElementById("lable-thaisan").style.visibility = "visible";
		document.getElementById("input-thaisan").style.visibility = "visible";
	} else {
		document.getElementById("lable-thaisan").style.visibility = "hidden";
		document.getElementById("input-thaisan").style.visibility = "hidden";
	}
}
function add_gkt() {
	nguyennhanThaisan('');
	$('#dlg_gkt').dialog('open').dialog('setTitle', 'Thêm giấy khai tử');
	$('#fm_gkt').form('clear');
}
function save_gkt() {
	$('#fm_gkt').form('submit', {
		url : 'Giaykhaitu/add',
		onSubmit : function() {
			return $(this).form('validate');
		},
		success : function(result) {
			var result = eval('(' + result + ')');
			if (result.success) {
				$('#dlg_gkt').dialog('close');
				$('#NhankhauId').combogrid('grid').datagrid('reload');
				show_messager('Cập nhật dữ liệu thành công!');
			} else {
				show_messager('Cập nhật dữ liệu không thành công!');
			}
		}
	});
}
function setChutrinh(_value) {
	var value = _value;
	if (value == 2) {
		add_cv();
	}
	if (value == 3) {
		add_gkt();
	}
}

/*
 * function formatChutrinhdieutri(val, row) { if (val = 0) return 'Kết thúc';
 * else if (val = 1) return 'Đang điều trị'; else return 'Chuyển viện'; }
 */
function formatXem(val, row) {
	return '<a href="#" class="easyui-linkbutton l-btn l-btn-plain" iconcls="icon-sum" plain="true" onclick="formview_details(\''
	+val
	+'\',\''
	+row.Id
	+'\',\''
	+row.Sotret
	+'\',\''
	+row.Hiv
	+'\',\''
	+row.Tamthan
	+'\',\''
	+row.Sinhsan
	+'\',\''
	+row.Phathai
	+'\',\''
	+row.Khhgd
	+'\',\''
	+row.Thuongtich
	+'\',\''
	+row.Khamthai
	+'\',\''
	+row.Khamthai
	+'\',\''
	+row.Chantaymieng
	+'\',\''
	+row.Doituong
	+'\',\''
	+row.Phuongphapdieutri
	+'\',\''
	+row.Sobaohiem
	+'\',\''
	+row.DiadiemId
	+'\')" style="font-weight:bold;">Xem</a>';
}
function formview_details(val, id, sotret, hiv, tamthan, sinhsan, phathai, khhgd, thuongtich, khamthai, chantaymieng, doituong, phuongphapdieutri, diadiem, sobaohiem) {
	define_khambenh();
	var kb_sr = sotret; var kb_hiv = hiv; var kb_tamthan = tamthan; var kb_ss = sinhsan; var kb_phathai = phathai; var kb_khhgd = khhgd;
	var kb_tt = thuongtich; var kb_khamthai = khamthai; var kb_chantaymieng = chantaymieng;var kb_doituong = doituong; var kb_pp = phuongphapdieutri;
	var kb_id = id; var kb_baohiem = sobaohiem; var kb_diadiem = diadiem;
	$('#noidung_phieukhambenh').append($('#fm-khambenh'));
	$('#dlg-khambenh-chitiet').dialog('open').dialog('setTitle', 'Thông tin phiếu khám bệnh {' + val + '}');
	$('#fm-khambenh').form('clear');
	$('#fm-khambenh').form('load', 'tongthe/getobjbyid/Sophieukcb/' + val);
	/*$('#BenhdichId').combogrid('setText', benhdich);
	$('#NhankhauId').combogrid('setText', hoten);
	$('#NhansuId').combogrid('setText', nguoikham);*/
	if(kb_sr == 1){
		$('#detail-etbs').tabs('enableTab', 1);
		document.getElementById("sotret").checked = true;
	}else{
		$('#detail-etbs').tabs('disableTab', 1);
		document.getElementById("sotret").checked = false;
	}
	if(kb_hiv == 1){
		$('#detail-etbs').tabs('enableTab', 2);
		document.getElementById("hiv").checked = true;
	}else{
		$('#detail-etbs').tabs('disableTab', 2);
		document.getElementById("hiv").checked = false;
	}
	if(kb_tamthan == 1){
		$('#detail-etbs').tabs('enableTab', 3);
		document.getElementById("tamthan").checked = true;
	}else{
		$('#detail-etbs').tabs('disableTab', 3);
		document.getElementById("tamthan").checked = false;
	}
	if(kb_ss == 1){
		$('#detail-etbs').tabs('enableTab', 4);
		document.getElementById("sinhsan").checked = true;
	}else{
		$('#detail-etbs').tabs('disableTab', 4);
		document.getElementById("sinhsan").checked = false;
	}
	if(kb_phathai == 1){
		$('#detail-etbs').tabs('enableTab', 5);
		document.getElementById("phathai").checked = true;
	}else{
		$('#detail-etbs').tabs('disableTab', 5);
		document.getElementById("phathai").checked = false;
	}
	if(kb_khhgd == 1){
		$('#detail-etbs').tabs('enableTab', 6);
		document.getElementById("khhgd").checked = true;
	}else{
		$('#detail-etbs').tabs('disableTab', 6);
		document.getElementById("khhgd").checked = false;
	}
	if(kb_tt == 1){
		$('#detail-etbs').tabs('enableTab', 7);
		document.getElementById("thuongtich").checked = true;
	}else{
		$('#detail-etbs').tabs('disableTab', 7);
		document.getElementById("thuongtich").checked = false;
	}
	if(kb_khamthai == 1){
		$('#detail-etbs').tabs('enableTab', 8);
		document.getElementById("khamthai").checked = true;
	}else{
		$('#detail-etbs').tabs('disableTab', 8);
		document.getElementById("khamthai").checked = false;
	}
	if(kb_chantaymieng == 1){
		$('#detail-etbs').tabs('enableTab', 9);
		document.getElementById("ctm").checked = true;
	}else{
		$('#detail-etbs').tabs('disableTab', 9);
		document.getElementById("ctm").checked = false;
	}
	setSobaohiem(kb_pp);
	$('#Sobaohiem').combogrid('setValue', kb_baohiem);
	//dieutriNoitru(phuongphapdieutri);
	$('#dg-xetnghiem').edatagrid({
		url : 'xetnghiem/getobjbyphieukhamid/phieukhamid/' + val
	});
	$('#dg-xetnghiem').edatagrid('reload');
	$('#dg-sieuam').edatagrid({
		url : 'sieuam/getobjbyphieukhamid/phieukhamid/' + val
	});
	$('#dg-donthuoc').edatagrid({
		url : 'capphatthuoc/getallthuocbyphieukhambenh/PhieukhamId/' + kb_id
	});
	$('#detail-etb').tabs('select', 'Phiếu khám bệnh');
	$('#detail-etbs').tabs('select', 0);
	/* 
	$("#detail-etb").on("click", function() {		 
		var tab = $('#detail-etb').tabs('getSelected');
		tab.panel('refresh');
		});*/
	
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
		url : 'tongthe/adddonthuoc',
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

	if (Maphieu.length > 0 || Ngaylap.length > 0 || Nguoikham.length > 0
			|| Nguoibenh.length > 0 || Benhdich.length > 0
			|| (sgioitinh.length > 0 && sgioitinh != 'Tatca')
			|| sThonto.length > 0) {
		if (Ngaylap.length > 0)
			Ngaylap = Ngaylap.replace("/", "$", 'g');
		window.open('tongthe/expxlsnstyt/NoWhere/0/Maphieu/' + Maphieu
				+ '/Ngaylap/' + Ngaylap + '/Nguoikham/' + Nguoikham
				+ '/Nguoibenh/' + Nguoibenh + '/Benhdich/' + Benhdich
				+ '/sgioitinh/' + sgioitinh + '/sThonto/' + sThonto);
	} else {
		window.open('tongthe/expxlsnstyt/NoWhere/1');
	}
}

// BEGIN Subform ADD
// ------------------------------------------------------------------

function add_benhdich() {
	$('#dlg_benhdich').dialog('open').dialog('setTitle', 'Thêm bệnh dịch');
	$('#fm_benhdich').form('clear');
}

function save_benhdich() {
	$('#fm_benhdich').form('submit', {
		url : 'benhdich/add',
		onSubmit : function() {
			return $(this).form('validate');
		},
		success : function(result) {
			var result = eval('(' + result + ')');
			if (result.success) {
				$('#dlg_benhdich').dialog('close');
				$('#BenhdichId').combobox('reload');
				$('#fm_benhdich').form('close');
				show_messager('Cập nhật dữ liệu thành công!');
			} else {
				show_messager('Cập nhật dữ liệu không thành công!');
			}
		}
	});
}

function add_phuongphapdieutri() {
	$('#dlg_ppdt').dialog('open').dialog('setTitle', 'Thêm phương pháp');
	$('#fm_ppdt').form('clear');
}

function save_phuongphapdieutri() {
	$('#fm_ppdt').form('submit', {
		url : 'phuongphapdieutri/add',
		onSubmit : function() {
			return $(this).form('validate');
		},
		success : function(result) {
			var result = eval('(' + result + ')');
			if (result.success) {
				$('#dlg_ppdt').dialog('close');
				$('#PhuongphapdieutriId').combobox('reload');
				$('#fm_ppdt').form('close');
				show_messager('Cập nhật dữ liệu thành công!');
			} else {
				show_messager('Cập nhật dữ liệu không thành công!');
			}
		}
	});
}

function add_nhansu() {
	$('#dlg_nhansu').dialog('open').dialog('setTitle', 'Thêm nhân sự');
	$('#fm_nhansu').form('clear');
	document.getElementById("label-dangvien").style.display = "none";
	 document.getElementById("label-doanvien").style.display = "none";
	 document.getElementById("input-dangvien").style.display = "none";
	 document.getElementById("input-doanvien").style.display = "none";
}

function save_nhansu() {
	$('#fm_nhansu').form('submit', {
		url : 'nhansu/add',
		onSubmit : function() {
			return $(this).form('validate');
		},
		success : function(result) {
			var result = eval('(' + result + ')');
			if (result.success) {
				$('#dlg_nhansu').dialog('close');
				$('#NhansuId').combogrid('grid').datagrid('reload');
				$('#fm_nhansu').form('close');
				show_messager('Cập nhật dữ liệu thành công!');
			} else {
				show_messager('Cập nhật dữ liệu không thành công!');
			}
		}
	});
}
// END Subform ADD
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
		reset_format_date("#Ngaychuyenvien");
	} else {
		show_messager('Không thể thay đổi trạng thái ngay bây giờ!');
	}
}

function save_chutrinhdieutri() {
	$('#fm-chutrinh').form('submit', {
		url : 'tongthe/changechutrinh',
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

/**Phadh them giay chuyen vien khi thay doi chu trinh dieu tri**/
function setchuyenvien(_value){
	var value = _value;
	var row = $('#dg-khambenh').datagrid('getSelected');
	//alert(value);
	if(value == 2){
		$('#dlg_cv').dialog('open').dialog('setTitle','Thêm phiếu chuyển viện');
		$('#fm_cv').form('clear');
		$('#PhieukhambenhId').val(row.Sophieukcb);
		$('#Machuyenvien').val(row.Sophieukcb);
		document.getElementById("PhieukhambenhId").readOnly=true;
	}
}

function save_cv(){
	$('#fm_cv').form('submit', {
		url : 'chuyenvien/add',
		onSubmit : function() {
			return $(this).form('validate');
		},
		success : function(result) {
			var result = eval('(' + result + ')');
			if (result.success) {
				$('#dlg_cv').dialog('close');
				$('#dlg-chutrinh').dialog('close')
				//$('#NhankhauId').combogrid('grid').datagrid('reload');
				$('#dg-khambenh').datagrid('reload');
				show_messager('Cập nhật dữ liệu thành công!');
			} else {
				show_messager('Cập nhật dữ liệu không thành công!');
			}
		}
	});
}
/**End**/
/*************check hien thi tab*******************************/
function check1(){
	var value = document.getElementById("sotret").checked;
	if(value == true){
		$('#detail-etbs').tabs('enableTab', 1);
	}else{
		$('#detail-etbs').tabs('disableTab', 1);
		$('#detail-etbs').tabs('select', 0);
	}
}
function check2(){
	var value = document.getElementById("hiv").checked;
	if(value == true){
		$('#detail-etbs').tabs('enableTab', 2);
		$('#Ngaydieutri').datebox({
			required:true
		});
		$('#Hienmac').combobox({
			required:true
		});
	}else{
		$('#detail-etbs').tabs('disableTab', 2);
		$('#detail-etbs').tabs('select', 0);
		$('#Ngaydieutri').datebox({
			required:false
		});
		$('#Hienmac').combobox({
			required:false
		});
	}
}
function check3(){
	var value = document.getElementById("tamthan").checked;
	if(value == true){
		$('#detail-etbs').tabs('enableTab', 3);
		$('#Phuongphapdieutri').validatebox({
			required:true
		});
		$('#Ketquadieutrith').validatebox({
			required:true
		});
	}else{
		$('#detail-etbs').tabs('disableTab', 3);
		$('#detail-etbs').tabs('select', 0);
		$('#Phuongphapdieutri').validatebox({
			required:false
		});
		$('#Ketquadieutrith').validatebox({
			required:false
		});
	}
}
function check4(){
	var value = document.getElementById("sinhsan").checked;
	if(value == true){
		$('#detail-etbs').tabs('enableTab', 4);
		$('#DiadiemIdss').combobox({
			required:true
		});
		$('#Ngaysinh').datebox({
			required:true
		});
		$('#HinhthucsinhsanId').combobox({
			required:true
		});
		$('#Bumetronggiodau').combobox({
			required:true
		});
		$('#Kiemtrabathoiky').combobox({
			required:true
		});
	}else{
		$('#detail-etbs').tabs('disableTab', 4);
		$('#detail-etbs').tabs('select', 0);
		$('#DiadiemIdss').combobox({
			required:false
		});
		$('#Ngaysinh').datebox({
			required:false
		});
		$('#HinhthucsinhsanId').combobox({
			required:false
		});
		$('#Bumetronggiodau').combobox({
			required:false
		});
		$('#Kiemtrabathoiky').combobox({
			required:false
		});
	}
}
function check5(){
	var value = document.getElementById("phathai").checked;
	if(value == true){
		$('#detail-etbs').tabs('enableTab', 5);
		$('#Ngaykinhcuoi').datebox({
			required:true
		});
		$('#Soconhienco1').numberspinner({
			required:true
		});
		$('#Tuanthai').numberspinner({
			required:true
		});
		$('#DiadiemIdpt').combobox({
			required:true
		});
	}else{
		$('#detail-etbs').tabs('disableTab', 5);
		$('#detail-etbs').tabs('select', 0);
		$('#Ngaykinhcuoi').datebox({
			required:false
		});
		$('#Soconhienco1').numberspinner({
			required:false
		});
		$('#Tuanthai').numberspinner({
			required:false
		});
		$('#DiadiemIdpt').combobox({
			required:false
		});
	}
}
function check6(){
	var value = document.getElementById("khhgd").checked;
	if(value == true){
		$('#detail-etbs').tabs('enableTab', 6);
		$('#Soconhiencokh').numberbox({
			required:true
		});
		$('#DiadiemIdkh').combobox({
			required:true
		});
	}else{
		$('#detail-etbs').tabs('disableTab', 6);
		$('#detail-etbs').tabs('select', 0);
		$('#Soconhiencokh').numberbox({
			required:false
		});
		$('#DiadiemIdkh').combobox({
			required:false
		});
	}
}
function check7(){
	var value = document.getElementById("thuongtich").checked;
	if(value == true){
		$('#detail-etbs').tabs('enableTab', 7);
	}else{
		$('#detail-etbs').tabs('disableTab', 7);
		$('#detail-etbs').tabs('select', 0);
	}
}
function check8(){
	var value = document.getElementById("khamthai").checked;
	if(value == true){
		$('#detail-etbs').tabs('enableTab', 8);
		$('#Ngaykinhcuoikt').datebox({
			required:true
		});
		$('#Soconhiencokt').numberbox({
			required:true
		});
		$('#Lancothaithu').numberbox({
			required:true
		});
		$('#TInhtrang').combobox({
			required:true
		});
	}else{
		$('#detail-etbs').tabs('disableTab', 8);
		$('#detail-etbs').tabs('select', 0);
		$('#Ngaykinhcuoikt').datebox({
			required:false
		});
		$('#Soconhiencokt').numberbox({
			required:false
		});
		$('#Lancothaithu').numberbox({
			required:false
		});
		$('#TInhtrang').combobox({
			required:false
		});
	}
}
function check9(){
	var value = document.getElementById("ctm").checked;
	if(value == true){
		$('#detail-etbs').tabs('enableTab', 9);
		$('#Codihoc').combobox({
			required:true
		});
		$('#Ngaykhoiphat').datebox({
			required:true
		});
		$('#Loaicabenh').combobox({
			required:true
		});
		$('#Ketqua').combobox({
			required:true
		});
		$('#Noidieutri').validatebox({
			required:true
		});
		$('#PhandoLS').validatebox({
			required:true
		});
	}else{
		$('#detail-etbs').tabs('disableTab', 9);
		$('#detail-etbs').tabs('select', 0);
		$('#Codihoc').combobox({
			required:false
		});
		$('#Ngaykhoiphat').datebox({
			required:false
		});
		$('#Loaicabenh').combobox({
			required:false
		});
		$('#Ketqua').combobox({
			required:false
		});
		$('#Noidieutri').validatebox({
			required:false
		});
		$('#PhandoLS').validatebox({
			required:false
		});
	}
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
function reload_sub_dg(){
	$('#dg_khamthai').datagrid('options').url = 'khamthai/getinfobyskcb/Sophieukcb/' + Sophieukcb;
	$('#dg_khamthai').datagrid('reload');
}
function checkValue_ctkhamthai() {
	if (!isDate($('#NgaykhamCT').datebox('getValue'))) {
		show_messager('Định dạng Ngày khám nhập vào không đúng!');
		return false;
	}
	if (!isDate($('#Dukienngaysinh').datebox('getValue'))) {
		show_messager('Định dạng Dự kiến ngày sinh nhập vào không đúng!');
		return false;
	}
	return true;
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
function them(count){
	$('#dg_khamthai').datagrid('insertRow', {
		index : count,
		row : {
			Id : 0
		}
	});
}

/***************them mới diễn biến bảo hiểm của nhân khẩu*******************************/
function add_sobaohiem(){
	setMabenhnhan();
	//alert(idnk);
	$('#dlg-sobaohiem').dialog('open').dialog('setTitle','Diễn biến mới bảo hiểm y tế');
	$('#fm-sobaohiem').form('clear');
	$("#fm-sobaohiem input[name='Nhankhauidnk']").val(idnk);
	$('#Xa').combogrid({
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
		toolbar:('#toolbar-combo-xa-bh'),
		url : '../default/xa/combogridbh',
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
		$('#Xa').combogrid({
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
	var sXa = $('#sXa1').val();
	var sHuyen = $('#sHuyen1').val();
	var sTinh = $('#sTinh1').val();
	if (sXa.length > 0 || sHuyen.length > 0 || sTinh.length > 0) {
		$('#Xa').combogrid('grid').datagrid('options').url = '../default/xa/combogridbh/sXa/' + sXa + '/sHuyen/' + sHuyen + '/sTinh/' + sTinh;
	} else {
		$('#Xa').combogrid('grid').datagrid('options').url = '../default/xa/combogridbh';
	}
	$('#Xa').combogrid("grid").datagrid('reload');
}