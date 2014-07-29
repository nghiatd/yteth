/* Cbogrid thom nd  */
// 1 dan toc
function initCbogrid_Dantoc()
{
	$('#DantocId').combogrid({
        panelWidth:500,	        
        editable : false,
        mode : 'remote',	        
        rownumbers : true,
        url: '../default/dantoc/cbogriddantoc/sTendantoc/',
        idField:'Id',
        textField:'Tendantoc',
        fitColumns:true,
        toolbar:('#Cbogrid-Dantoc-toolbar'),
        columns:[[
        {field:'Id',title:'Id',width:60,hidden:true},
        {field:'Tendantoc',title:'Tên dân tộc',align:'left',width:80}        
        ]]
        });
}
function initCbogrid_Mangach()
{
	$('#Mangach').combogrid({
        panelWidth:500,	        
        editable : false,
        mode : 'remote',	        
        rownumbers : true,
        url: '../default/mangach/cbogridmangach/sTenmangach/',
        idField:'Mangach',
        textField:'Tenmangach',
        fitColumns:true,
        toolbar:('#Cbogrid-Mangach-toolbar'),
        columns:[[{field:'Id',title:'Id',hidden:true},
				  {field:'Mangach',title:'Mã ngạch',width:268},
				  {field:'Tenmangach',title:'Tên mã ngạch',width:100}]]});
}

function initCbogrid_Trinhdohocvan()
{
	$('#TrinhdoId').combogrid({
        panelWidth:500,	        
        editable : false,
        mode : 'remote',	        
        rownumbers : true,
        url: '../default/trinhdohocvan/cbogridtrinhdohocvan/sTentrinhdohocvan/',
        idField:'Id',
        textField:'Tentrinhdohocvan',
        fitColumns:true,
        toolbar:('#Cbogrid-Trinhdohocvan-toolbar'),
        columns:[[{field:'Id',title:'Id',hidden:true},				  
				  {field:'Tentrinhdohocvan',title:'Tên trình độ',width:100}]]});
}

//
function initprintview() {	
	var array= window.location.href.split("/");
	var url=array[0]+'//'+array[2]+'/'+array[3] + '/printview/initprintview';
	window.open(url );
}
function show_messager(_text) {
	$.messager.show({
		title : 'Thông báo',
		msg : _text,
		timeout : 5000,
		showType : 'slide'
	});
}
/*
 * reset_format_date(id) Tác Dụng: Cập nhật lại định dạng ngày/tháng/năm
 */
function reset_format_date(id) {
	$(id).datebox(
			{
				formatter : function(date) {
					var y = date.getFullYear();
					var m = date.getMonth() + 1;
					var d = date.getDate();
					return (d < 10 ? '0' + d : d) + '/'
							+ (m < 10 ? '0' + m : m) + '/' + y;
				},
				parser : function(s) {
					if (s) {
						var a = s.split('/');
						var d = new Number(a[0]);
						var m = new Number(a[1]);
						var y = new Number(a[2]);
						var dd = new Date(y, m - 1, d);
						return dd;
					} else {
						return new Date();
					}
				}
			});
}

/*
 * isDate(txtDate) Tác Dụng: Kiểm tra chuỗi có đúng định dạng ngày/tháng/năm.
 */
function isDate(txtDate) {
	var currVal = txtDate;
	if (currVal == '')
		return false;

	// Declare Regex
	var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;
	var dtArray = currVal.match(rxDatePattern); // is format OK?

	if (dtArray == null)
		return false;

	// Checks for dd/mm/yyyy format.
	dtDay = dtArray[1];
	dtMonth = dtArray[3];
	dtYear = dtArray[5];

	if (dtMonth < 1 || dtMonth > 12)
		return false;
	else if (dtDay < 1 || dtDay > 31)
		return false;
	else if ((dtMonth == 4 || dtMonth == 6 || dtMonth == 9 || dtMonth == 11)
			&& dtDay == 31)
		return false;
	else if (dtMonth == 2) {
		var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
		if (dtDay > 29 || (dtDay == 29 && !isleap))
			return false;
	}
	return true;
}
/**
 * - So sánh hai chuỗi Date, trả về True nếu str1 > str2 và False nếu ngược lại. -
 * Hai chuỗi Date có dạng 'dd/mm/yyyy'.
 */
function compareDate(str1, str2) {
	var a = str1.split('/');
	var d = new Number(a[0]);
	var m = new Number(a[1]);
	var y = new Number(a[2]);
	var d1 = new Date(y, m - 1, d);

	a = str2.split('/');
	d = new Number(a[0]);
	m = new Number(a[1]);
	y = new Number(a[2]);
	var d2 = new Date(y, m - 1, d);

	return (d1 > d2);
}
function validText(Text) {
	var reg = new RegExp("^([a-zA-Z0-9\.\-_?@]+)$");
	return (reg.test(Text));
}

function help_func_save(_fm, _url, _dlg, _cbg) {
	$(_fm).form('submit', {
		url : _url,
		success : function(result) {
			var result = eval('(' + result + ')');
			if (result.success) {
				$(_dlg).dialog('close');
				$(_cbg).combogrid('grid').datagrid('reload');
				show_messager('Cập nhật dữ liệu thành công!');
			} else {
				show_messager('Cập nhật dữ liệu không thành công!');
			}
		}
	});
}
// Định dạng cột giới tính
function formatGioitinh(value, row, index) {
	if (value == 'on')
		return 'Nam';
	else
		return 'Nữ';
}
// Tìm kiếm trong combogrid Dân tộc
function sear_combo_dantoc(ctrl_text, form_id) {
	try {
		var sdantoc = $('#' + ctrl_text).val();
		if (sdantoc.length > 0) {
			$('#' + form_id + " input[id='DantocId']").combogrid('grid')
					.datagrid('options').url = 'dantoc/combo' + '/sdantoc/'
					+ sdantoc;
		} else {
			$('#' + form_id + " input[id='DantocId']").combogrid('grid')
					.datagrid('options').url = 'dantoc/combo';
		}
		$('#' + form_id + " input[id='DantocId']").combogrid("grid").datagrid('reload');
	} catch (e) {
		// alert(e);
	}
}

// end
// Tìm kiếm trong combogrid Trình độ văn hóa.
function sear_combo_trinhdovanhoa(ctrl_text, form_id) {
	try {
		var stdvh = $('#' + ctrl_text).val();
		if (stdvh.length > 0) {
			$('#' + form_id + " input[id='TrinhdovanhoaId']").combogrid('grid')
					.datagrid('options').url = 'trinhdovanhoa/combo/strinhdo/'
					+ stdvh;
		} else {
			$('#' + form_id + " input[id='TrinhdovanhoaId']").combogrid('grid')
					.datagrid('options').url = 'trinhdovanhoa/combo';
		}
		$('#' + form_id + " input[id='TrinhdovanhoaId']").combogrid("grid")
				.datagrid('reload');
	} catch (e) {
		// alert(e);
	}
}
// end

function formattrangthai(val, row) {
	if (val == 0)
		return '<label style="color:red">Đã chết</lable>';
	else if (val == 1)
		return '<label style="color:green">Còn sống</lable>';
	else if (val == 2)
		return '<label style="color:blue">Rời khỏi địa bàn</label>';
}

/** * B Nhân khẩu ** */
function define_combogrid_nhankhau(data_url) {
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
		url : data_url,
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
			sortable : true
		} ] ]
	});
	$("input[name='mode']").change(function() {
		var mode = $(this).val();
		$('#NhankhauId').combogrid({
			mode : mode
		});
	});
}

function sear_combogrid_nhankhau(data_url) {
	var sMank = $('#scbMank').val();
	var sSobh = $('#scbSobh').val();
	var sHoten = $('#scbHoten').val();
	var sCMND = $('#scbCMND').val();
	var sThonto = $('#scbThonto').val();
	var sMahd = $('#scbMahd').val();
	
	
	
	var sNgaysinhtu = $('#scbNgaysinhtu').val();
	
	var sNgaysinhden = $('#scbNgaysinhden').val();
	var sDantoc = $('#scbDantoc').val();
	var sMabn = $('#scbMabn').val();
	var sGioitinh = $('#scbGioitinh').val();
	var sDiachi = $('#scbDiachi').val();
	var sVanglai = document.getElementById('scbVanglai').checked;
	
	if(!checksear()){
		return;
	}
	if (sNgaysinhtu.length > 0) {
		if (isDate(sNgaysinhtu))
			sNgaysinhtu = sNgaysinhtu.replace(new RegExp("/", "gm"), "$");
		else
			sNgaysinhtu = '';
	}
	if (sNgaysinhden.length > 0) {
		if (isDate(sNgaysinhden))
			sNgaysinhden = sNgaysinhden.replace(new RegExp("/", "gm"), "$");
		else
			sNgaysinhden = '';
	}
	
	if (sVanglai)
		sVanglai = '1';
	else
		sVanglai = '0';
	if (sMank.length > 0 || sHoten.length > 0 || sCMND.length > 0
			|| sThonto.length > 0 || sMahd.length > 0 || sNgaysinhtu.length > 0 || sNgaysinhden.length > 0 || sSobh.length > 0
			|| sDantoc.length > 0 || sMabn.length > 0 || sGioitinh.length > 0
			|| sDiachi.length > 0 || sVanglai.length > 0) {
		$('#NhankhauId').combogrid('grid').datagrid('options').url = data_url
				+ '/sMank/' + sMank + '/sHoten/' + sHoten + '/sCMND/' + sCMND
				+ '/sThonto/' + sThonto + '/sMahd/' + sMahd + '/sNgaysinhtu/'
				+ sNgaysinhtu + '/sDantoc/' + sDantoc + '/sMabn/' + sMabn
				+ '/sGioitinh/' + sGioitinh + '/sDiachi/' + sDiachi
				+ '/sVanglai/' + sVanglai  + '/sNgaysinhden/' + sNgaysinhden  + '/sSobh/' + sSobh;
	} else {
		$('#NhankhauId').combogrid('grid').datagrid('options').url = data_url;
	}
	$('#NhankhauId').combogrid("grid").datagrid('reload');
}

function define_nhankhau() {
	$("#fm-nhankhau input[name='Hoten']").validatebox({
		required : true
	});
	$("#fm-nhankhau input[name='QuanheId']").combobox({
		url : '../default/quanhe/combo',
		valueField : 'Id',
		textField : 'Tenquanhe',
		required : true,
		editable : false,
		width : 152
	});
	$('#Nghenghiep').combobox('reload','nghenghiep/combointohokhau');
	$("#fm-nhankhau input[name='DangkhuyettatId']").combobox({
		url : '../default/Dangkhuyettat/combo',
		valueField : 'Id',
		textField : 'Tendangkhuyettat',
		editable : false,
		width : 152
	});
	
	$("#fm-nhankhau input[name='MucdokhuyettatId']").combobox({
		url : '../default/Mucdokhuyettat/combo',
		valueField : 'Id',
		textField : 'Tenmucdokhuyettat',
		required : true,
		editable : false,
		width : 152
	});
	
	$("#fm-nhankhau input[name='DantocId']").combogrid(
		{
		panelWidth : 320,
		panelHeight : 300,
		nowrap : true,
		rownumbers : true,
		fitColumns : false,
		fit : true,		
		border : false,
		required : true,
		idField : 'Id',
		textField : 'Tendantoc',
		width : 152,
		mode : 'remote',
		url : '../default/dantoc/cbogriddantoc/sTendantoc/',
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
	}
	
	
	
	);
	
	
	$('#XaId').combogrid({
		panelWidth : 520,
		panelHeight : 350,
		pagination : true,
		nowrap : true,
		rownumbers : true,
		fitColumns : false,
		border : false,
		fit : true,
		idField : 'Id',
		textField : 'Tenxa',
		toolbar:('#toolbar-combo-xa'),
		mode : 'remote',
		url : '../default/xa/combogrid',
		columns : [ [ {
			field : 'Id',
			title : 'Id',
			hidden : true
		}, {
			field : 'Tenxa',
			title : 'Tên xã',
			width : 145
		}, {
			field : 'Tenhuyen',
			title : 'Tên huyện',
			width : 145
		}, {
			field : 'Tentinh',
			title : 'Tên tỉnh',
			width : 145
		} ] ]
	});	
	$("#fm-nhankhau input[name='TrinhdovanhoaId']").combogrid({
		panelWidth : 320,
		panelHeight : 250,
		nowrap : true,
		fitColumns : false,
		border : false,
		fit : true,
		rownumbers : true,
		idField : 'Id',
		editable : false,
		textField : 'Tentrinhdovanhoa',
		width : 152,
		mode : 'remote',
		url : '../default/trinhdovanhoa/combo',
		toolbar : ('#combogrid-trinhdovanhoa-toolbar'),
		columns : [ [ {
			field : 'Id',
			title : 'Id',
			hidden : true
		}, {
			field : 'Tentrinhdovanhoa',
			title : 'Tên trình độ văn hóa',
			width : 150
		} ] ]
	});
	$("#fm-nhankhau input[name='QuoctichId']").combobox({
		url : '../default/quoctich/combo',
		valueField : 'Id',
		textField : 'Tenquoctich',
		required : true,
		editable : false,
		width : 152
	});
	/*
	 * $("#fm-nhankhau input[name='Gioitinh']").combobox({ required : true,
	 * editable : false, panelHeight : 70, data : [ { label : 'Nam', value :
	 * 'Nam' }, { label : 'Nữ', value : 'Nữ' } ], valueField : 'value',
	 * textField : 'label', width : 152 });
	 */
	$('#NgaysinhNK').datebox({
		required : true
	});
	$('#NgaycapNK').datebox({});
	$('#MahodanNK').combogrid({
		panelWidth : 650,
		panelHeight : 420,
		pagination : true,
		width : 150,
		nowrap : true,
		fitColumns : false,
		border : false,
		fit : true,
		idField : 'Mahodan',
		textField : 'Mahodan',
		editable : false,
		mode : 'remote',
		url : '../default/hokhau/combogrid',
		toolbar : ('#combogrid-hokhau-toolbar'),
		columns : [ [ {
			field : 'Id',
			title : 'Id',
			hidden : true
		}, {
			field : 'Mahodan',
			title : 'Mã hộ dân',
			width : 70
		}, {
			field : 'Tenchuho',
			title : 'Chủ hộ',
			width : 140
		}, {
			field : 'Ngaydangkyhokhau',
			title : 'Ngày ĐKHK',
			width : 70
		}, {
			field : 'Kieuhogiadinh',
			title : 'Kiểu hộ gia đình',
			width : 100
		}, {
			field : 'Diachi',
			title : 'Địa chỉ',
			width : 140
		}, {
			field : 'Thonto',
			title : 'Thôn tổ',
			width : 140
		}, {
			field : 'DantocId',
			title : 'DantocId',
			hidden: true
		}, {
			field : 'QuoctichId',
			title : 'QuoctichId',
			hidden: true
		}, {
			field : 'Dantoc',
			title : 'Dantoc',
			hidden: true
		}, {
			field : 'Quoctich',
			title : 'Quoctich',
			hidden: true
		}] ]
	});
	$("input[name='mode']").change(function() {
		var mode = $(this).val();
		$('#MahodanNK').combogrid({
			mode : mode
		});
	});
	$('#Xa_Id').combogrid({
		panelWidth : 520,
		panelHeight : 350,
		pagination : true,
		nowrap : true,
		rownumbers : true,
		fitColumns : false,
		border : false,
		fit : true,
		idField : 'Id',
		textField : 'Tenxa',
		toolbar:('#toolbar-combo-xa'),
		mode : 'remote',
		url : '../default/xa/combogrid',
		columns : [ [ {
			field : 'Id',
			title : 'Id',
			hidden : true
		}, {
			field : 'Tenxa',
			title : 'Tên xã',
			width : 145
		}, {
			field : 'Tenhuyen',
			title : 'Tên huyện',
			width : 145
		}, {
			field : 'Tentinh',
			title : 'Tên tỉnh',
			width : 145
		}, ] ]
	});
	reset_format_date('#NgaysinhNK');
	reset_format_date('#NgaycapNK');
}

function cbg_add_nhankhau() {
	$('#dlg-nhankhau').dialog('open').dialog('setTitle', 'Thêm nhân khẩu');
	$('#fm-nhankhau').form('clear');
	$('#MucdokhuyettatId').combobox({required:false});
	document.getElementById("label-mucdo").style.display = "none";
	document.getElementById("input-mucdo").style.display = "none";
	document.getElementById("label-xa").style.display = "none";
	document.getElementById("input-xa").style.display = "none";
	document.getElementById("input-khuyettat").style.display = "none";
	document.getElementById("Gioitinh").checked = true;
}
function cbg_save_nhankhau() {
	if ($('#fm-nhankhau').form('validate') && checkValue_nhankhau())
		help_func_save('#fm-nhankhau', 'nhankhau/add', '#dlg-nhankhau',
				'#NhankhauId');
}
function checkValue_nhankhau() {
	var re = new RegExp(/^\d+$/);
	if (!isDate($('#NgaysinhNK').datebox('getValue'))) {
		show_messager('Định dạng Ngày sinh nhập vào không đúng!');
		return false;
	}
	if ($('#NgaycapNK').datebox('getValue').length > 0
			&& !isDate($('#NgaycapNK').datebox('getValue'))) {
		show_messager('Định dạng Ngày cấp nhập vào không đúng!');
		return false;
	}
	if ($('#DienthoaiNK').val().length > 0) {
		if (!re.test($('#DienthoaiNK').val())) {
			show_messager('Số điện thoại phải là chữ số có dạng: 11111111111...');
			return false;
		}
	}
	return true;
}
/** * E Nhân khẩu ** */
/** * B Hộ khẩu ** */
function cbg_define_hokhau() {
	$("#fm-hokhau div[id='etb']").tabs({});
	$("#fm-hokhau input[name='Mahodan']").validatebox({
		required : true
	});
	$("#fm-hokhau input[name='Tenchuho']").validatebox({
		required : true
	});
	$("#fm-hokhau input[name='Diachi']").validatebox({
		required : true
	});
	$('#Ngaydangkyhokhau').datebox({
		required : true
	});
	$("#fm-hokhau input[name='ThontoId']")
			.combobox(
					{
						url : '../danso/thonto/combobyxaidnotgetparam',
						valueField : 'Id',
						textField : 'Tenthonto',
						required : true,
						editable : false,
						width : 153,
						onSelect : function(rec) {
							cbg_removeElement();
							if ($('#fm-hokhau').form('validate')) {
								temp = cbg_addElement();
								if (temp) {
									try {
										$('#Hotench').prop('readOnly', true);
										document.getElementById('Hotench').value = document
												.getElementById('Tenchuho').value;

										$(
												"#fm-hokhau input[name='TrinhdovanhoaId']")
												.combogrid(
														{
															panelWidth : 320,
															panelHeight : 250,
															pagination : true,
															nowrap : true,
															fitColumns : false,
															border : false,
															fit : true,
															width : 152,
															rownumbers : true,
															idField : 'Id',
															textField : 'Tentrinhdovanhoa',
															editable : false,
															mode : 'remote',
															url : 'trinhdovanhoa/combo',
															toolbar : ('#combogrid-trinhdovanhoa-toolbar1'),
															columns : [ [
																	{
																		field : 'Id',
																		title : 'Id',
																		hidden : true
																	},
																	{
																		field : 'Tentrinhdovanhoa',
																		title : 'Tên trình độ văn hóa',
																		width : 150
																	} ] ]
														});
										$("#fm-hokhau input[name='DantocId']")
												.combogrid(
														{
															panelWidth : 320,
															panelHeight : 300,
															nowrap : true,
															rownumbers : true,
															fitColumns : false,
															border : false,
															fit : true,
															width : 152,
															required : true,
															idField : 'Id',
															textField : 'Tendantoc',
															editable : false,
															mode : 'remote',
															url : 'dantoc/combo',
															toolbar : ('#combogrid-dantoc-toolbar1'),
															columns : [ [
																	{
																		field : 'Id',
																		title : 'Id',
																		hidden : true
																	},
																	{
																		field : 'Tendantoc',
																		title : 'Tên dân tộc',
																		width : 145
																	} ] ]
														});
										$("#fm-hokhau input[name = 'XaId']").combogrid({
											panelWidth : 520,
											panelHeight : 350,
											pagination : true,
											nowrap : true,
											rownumbers : true,
											fitColumns : false,
											border : false,
											fit : true,
											idField : 'Id',
											textField : 'Tenxa',
											toolbar:('#toolbar-combo-xaid'),
											mode : 'remote',
											url : 'xa/combogrid',
											columns : [ [ {
												field : 'Id',
												title : 'Id',
												hidden : true
											}, {
												field : 'Tenxa',
												title : 'Tên xã',
												width : 145
											}, {
												field : 'Tenhuyen',
												title : 'Tên huyện',
												width : 145
											}, {
												field : 'Tentinh',
												title : 'Tên tỉnh',
												width : 145
											}, ] ]
										});
										reset_format_date('#Ngaysinh');
										reset_format_date('#Ngaycap');
									} catch (e) {
										alert(e);
									}
								}
							} else
								$("#fm-hokhau input[id='ThontoId']").combobox('clear');
						}
					});
	reset_format_date('#Ngaydangkyhokhau');
}

function cbg_add_hokhau() {
	try {
		cbg_removeElement();
		$('#dlg-hokhau').dialog('open').dialog('setTitle', 'Thêm hộ khẩu');
		$('#fm-hokhau').form('clear');
	} catch (e) {
		alert(e);
	}
}

function cbg_save_hokhau() {
	if ($('#fm-hokhau').form('validate') && checkValue_hokhau()) {
		help_func_save('#fm-hokhau', 'hokhau/add', '#dlg-hokhau', '#MahodanNK');
		value = $('#Mahodan').val();
		$('#MahodanNK').combogrid('setValue', value);
		$('#MahodanNK').combogrid('setText', value);
	}
}

function help_sobaohiem() {
		$('#dlg-help-sobaohiem').dialog('open').dialog('setTitle', 'Trợ giúp');
}

function checksear() {
	var re = new RegExp(/^\d+$/);
	if($('#scbNgaysinhtu').val() != ''){
	if (!isDate($('#scbNgaysinhtu').val())) {
		alert('Định dạng Ngày sinh từ nhập vào không đúng!');
		return false;
	}
	}return true;
	if($('#scbNgaysinhden').val() != ''){
		if (!isDate($('#scbNgaysinhden').val())) {
				alert('Định dạng Ngày sinh đến nhập vào không đúng!');
		return false;
		}
	}
	return true;
}

function checkValue_hokhau() {
	var re = new RegExp(/^\d+$/);
	if (!isDate($('#Ngaydangkyhokhau').datebox('getValue'))) {
		show_messager('Định dạng Ngày đăng ký hộ khẩu nhập vào không đúng!');
		return false;
	}
	if (!isDate($('#Ngaysinhch').datebox('getValue'))) {
		show_messager('Định dạng Ngày sinh nhập vào không đúng!');
		return false;
	}
	if ($('#Ngaycapch').datebox('getValue').length > 0
			&& !isDate($('#Ngaycap').datebox('getValue'))) {
		show_messager('Định dạng Ngày cấp nhập vào không đúng!');
		return false;
	}
	if ($('#Dienthoai').val().length > 0) {
		if (!re.test($('#Dienthoai').val())) {
			show_messager('Số điện thoại phải là chữ số có dạng: 11111111111...');
			return false;
		}
	}
	return true;
}

function cbg_addElement() {
	if (!$('#fm-hokhau').form('validate')) {
		$("#fm-hokhau input[name='ThontoId']").combobox('clear');
		return false;
	}
	title = "Thông tin chủ hộ";
	str = "<div id=\"Thongtinnhankhau\" title=\"Thông tin chủ hộ\" style=\"padding: 10px;height:350px;\"><table border=\"0\" width=\"auto\" cellspacing=\"0\" cellpadding=\"4\" class=\"tblForm\">"
			+ "<tr><td width=\"100px;\"><div>Tên chủ hộ:</div></td><td class=\"2Col\"><input id=\"Hotench\" name=\"Hotench\" data-options=\"required:true\" class=\"easyui-validatebox\" style=\"width: 150px\"></td> <td width=\"100px;\"> <div>Giới tính:</div> </td> <td class=\"2Col\"> <input id=\"Gioitinh\" name=\"Gioitinh\" type=\"checkbox\" /> Nam </td> </tr>"
			+ "<tr> <td> <div>Ngày sinh:</div></td> <td class=\"2Col\">	<input id=\"Ngaysinhch\" name=\"Ngaysinh\" class=\"easyui-datebox\" required=\"required\" style=\"width: 152px\" /> </td> <td width=\"100px;\"><div>CMND:</div></td> <td class=\"2Col\"> <input id=\"Cmnd\" name=\"Cmnd\" class=\"easyui-text\" style=\"width: 150px\"> </td> </tr>"
			+ "<tr> <td> <div>Ngày cấp:</div> </td> <td class=\"2Col\">	<input id=\"Ngaycapch\" name=\"Ngaycap\" class=\"easyui-datebox\" style=\"width: 152px\"></input> </td><td><div>Nơi cấp:</div> </td> <td class=\"1Col\" ><input id=\"Noicap\" name=\"Noicap\" class=\"easyui-text\" style=\"width: 150px;\"></td> </tr>"
			+ "<tr> <td> <div>Mã nhân khẩu:</div> </td> <td class=\"2Col\"> <input id=\"Manhankhau\" name=\"Manhankhau\" class=\"easyui-validatebox\" style=\"width: 150px;\"> </td> <td> <div>Số bảo hiểm:</div> </td> <td> <input id=\"Sobaohiem\" name=\"Sobaohiem\" class=\"easyui-validatebox\" style=\"width: 150px\" onkeypress=\"myFunctionid()\"> </td> </tr>"
			+ "<tr> <td class=\"2Col\"></td><td class=\"2Col\"></td><td class=\"2Col\"><div id=\"label-xaid\">Nơi đăng ký BH:</div></td><td class=\"2Cold\"><div id=\"input-xaid\"><input id=\"Xa_Id\" name=\"XaId\" style=\"width:150px;\"></div></td></tr>"
			+ "<tr> <td> <div>Điện thoại:</div> </td><td class=\"2Col\"><input id=\"Dienthoai\" name=\"Dienthoai\" class=\"easyui-validatebox\" maxlength=\"14\" style=\"width: 150px\"> </td><td><div>Email:</div> </td><td class=\"2Col\"><input id=\"Email\" name=\"Email\" class=\"easyui-validatebox\" data-options=\"validType:'email'\" style=\"width: 150px\">	</td> </tr>"
			+ "<tr> <td> <table border =\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr><td><div>Khuyết tật:</div></td><td><input id=\"Khuyettatid\" name=\"Khuyettat\" type=\"checkbox\" onclick=\"setkhuyettatid()\"></td></tr></table></td>"
			+ "<td class=\"2Col\"><div id=\"input-khuyettatid\"><input id=\"DangkhuyettatId\" name=\"DangkhuyettatId\" class=\"easyui-combobox\" url=\"Dangkhuyettat/combo\" valueField=\"Id\" textField=\"Tendangkhuyettat\" data-options=\"editable:false, onSelect:function(rec){setmucdoid(rec.Id);}\" style=\"width:152px;\"></div></td>"
			+ "<td><div id=\"label-mucdoid\">Mức độ:</div></td><td class=\"2Col\"><div id=\"input-mucdoid\"><input id=\"MucdokhuyettatId\" name=\"MucdokhuyettatId\" class=\"easyui-combobox\" url=\"Mucdokhuyettat/combo\" valueField=\"Id\" textField=\"Tenmucdokhuyettat\" style=\"width:152px;\"</div><td></tr>"
			+ "<tr> <td> <div>Trình độ hv:</div> </td><td class=\"2Col\"> <input id=\"TrinhdovanhoaId\" name=\"TrinhdovanhoaId\" style=\"width: 152px\"><!-- <a href=\"#\" class=\"easyui-linkbutton\" onclick=\"add_trinhdovanhoa()\" iconCls=\"icon-add\" plain=\"true\" ></a> --></td><td><div>Dân tộc:</div> </td> <td class=\"2Col\"> <input id=\"DantocId\" name=\"DantocId\" style=\"width: 152px\"></td><td><!-- <a href=\"#\" class=\"easyui-linkbutton\" onclick=\"add_dantoc()\" iconCls=\"icon-add\" plain=\"true\" ></a> --></td></tr>"
			+ "<tr> <td> <div>Nghề nghiệp:</div> </td> <td class=\"2Col\">	<input id=\"Nghenghiep\" name=\"Nghenghiep\" class=\"easyui-validatebox\" style=\"width: 150px\"> </td> <td> <div>Ghi chú:</div> </td> <td class=\"2Col\"> <input id=\"Ghichu\" name=\"Ghichu\" class=\"easyui-text\" style=\"width: 150px\"> </td> </tr>"
			+ "<tr> <td> <div>Quốc tịch:</div> </td> <td class=\"2Col\"> <input id=\"QuoctichId\" name=\"QuoctichId\" class=\"easyui-combobox\" url=\"quoctich/combo\" valueField=\"Id\" textField=\"Tenquoctich\" data-options=\"required:true,editable:false\" style=\"width: 152px\"><!-- <a href=\"#\" class=\"easyui-linkbutton\" onclick=\"add_quoctich()\" iconCls=\"icon-add\" plain=\"true\" ></a> --> </td> <td> <div>Chân dung:</div> </td> <td class=\"2Col\"> <input name=\"MAX_FILE_SIZE\" value=\"102400\" type=\"hidden\"> <input name=\"image\" accept=\"image/jpeg\" type=\"file\" style=\"width: 150px\"></td> </tr>"
			+ "</table> </div>";
	$('#etb').tabs('add', {
		title : title,
		content : str
	});
	reset_format_date('#Ngaysinhch');
	reset_format_date('#Ngaycapch');
	document.getElementById("label-mucdoid").style.display = "none";
	document.getElementById("input-mucdoid").style.display = "none";
	document.getElementById("label-xaid").style.display = "none";
	document.getElementById("input-xaid").style.display = "none";
	document.getElementById("input-khuyettatid").style.display = "none";
	return true;
}

function cbg_removeElement() {
	if ($('#etb').tabs('exists', 'Thông tin chủ hộ'))
		$('#etb').tabs('close', 'Thông tin chủ hộ');
}
/** * E Hộ khẩu ** */
function define_combogrid_nguyennhan() {
	$('#Nguyennhan').combogrid({
		panelWidth : 320,
		panelHeight : 300,
		pagination : true,
		nowrap : true,
		fitColumns : true,
		border : false,
		fit : true,
		rownumbers : true,
		editable : false,
		idField : 'Tennguyennhan',
		textField : 'Tennguyennhan',
		mode : 'remote',
		url : 'nguyennhan/combo',
		toolbar : ('#combogrid-toolbar'),
		columns : [ [ {
			field : 'Id',
			title : 'Id',
			hidden : true
		}, {
			field : 'Tennguyennhan',
			title : 'Tên nguyên nhân',
			width : 155
		} ] ]
	});
}
// phadh tìm kiếm trên combogrid hộ khẩu
function sear_combo_hokhau() {
	var sMhd = $('#sMhd').val();
	var schuho = $('#schuho').val();
	var sKgd = $('#sKgd').val();
	var sdc = $('#sdc').val();
	var sthonto = $('#sthonto').val();
	if (sMhd.length > 0 || schuho.length > 0 || sKgd.length > 0
			|| sdc.length > 0 || sthonto.length > 0) {
		$('#MahodanNK').combogrid('grid').datagrid('options').url = 'hokhau/combogrid/sMhd/'
				+ sMhd
				+ '/schuho/'
				+ schuho
				+ '/sdc/'
				+ sdc
				+ '/sKgd/'
				+ sKgd
				+ '/sthonto/' + sthonto;
	} else {
		$('#MahodanNK').combogrid('grid').datagrid('options').url = 'hokhau/combogrid';
	}
	$('#MahodanNK').combogrid('grid').datagrid('reload');
}

// /////////////////////////////////////////////////////////////////
/**
 * ********************************Phadh kiem tra ky tu nhap
 * vao********************************************************
 */
var mikExp = /[$\\@\\\#%\^\&\*\(\)\[\]\+\_\{\}\`\~\=\|\!\$\:\"\<\>\,\.\?]/;
function dodacheck(val) {
	var strPass = val.value;
	var strLength = strPass.length;
	var lchar = val.value.charAt((strLength) - 1);
	if (lchar.search(mikExp) != -1) {
		var tst = val.value.substring(0, (strLength) - 1);
		val.value = tst;
	}
}
/** ********************************************************************************************************************* */

/** ********************************************************************************************************* */

function alpha(e) {
	var k;
	document.all ? k = e.keyCode : k = e.which;
	return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || (k >= 48 && k <= 57) || k == 45 || k == 46);
}

function number(e) {
	var k;
	document.all ? k = e.keyCode : k = e.which;
	return ((k >= 48 && k <= 57) || k == 8 || k == 45);
}

function numberheso(e) {
	var k;
	document.all ? k = e.keyCode : k = e.which;
	return ((k >= 48 && k <= 57) || k == 8 || k == 45 || k == 46);
}

function cmnd(e) {
	var k;
	document.all ? k = e.keyCode : k = e.which;
	return (k == 8
			|| (k >= 48 && k <= 57) || (k == 45 && k == 95));
}

function ten(e){
	var k;
	document.all ? k = e.keyCode : k = e.which;
	return ((k <= 122 && k >= 97) || (k <=90 && k >= 65 ) || (k <= 57 && k >= 48) || k == 8 || k ==32 || k == 130
			|| (k >= 7840 || k <= 7929));
}
function isNumberKey (evt)
{
   var charCode = (evt.which)? evt.which: event.keyCode;
   if ((charCode > 32 && charCode < 39) || (charCode > 39 && charCode < 65) || (charCode > 90 && charCode < 97))
      return false;

   return true;
}
function beta (evt)
{
   var charCode = (evt.which)? evt.which: event.keyCode;
   if ((charCode > 32 && charCode < 38) || (charCode > 57 && charCode < 65) 
		   || (charCode > 90 && charCode < 97) || (charCode > 39 && charCode < 47))
      return false;

   return true;
}

function cncc(e) {
	var k;
	document.all ? k = e.keyCode : k = e.which;
	return ((k > 47 && k < 58) || k == 46);
}
/******************************************************************************************/

function myFunction(){
	document.getElementById("label-xa").style.display = "block";
	document.getElementById("input-xa").style.display = "block";
	$('#XaId').combogrid({
		required:true
	});
}

function myFunctionid(){
	document.getElementById("label-xaid").style.display = "block";
	document.getElementById("input-xaid").style.display = "block";
	$('#XaId').combogrid({
		required:true
	});
}

function sear_combo_xa() {
	var sXa = $('#sXa').val();
	var sHuyen = $('#sHuyen').val();
	var sTinh = $('#sTinh').val();
	if (sXa.length > 0 || sHuyen.length > 0 || sTinh.length > 0) {
		$('#XaId').combogrid('grid').datagrid('options').url = 'xa/combogrid/sXa/' + sXa + '/sHuyen/' + sHuyen + '/sTinh/' + sTinh;
	} else {
		$('#XaId').combogrid('grid').datagrid('options').url = 'xa/combogrid';
	}
	$('#XaId').combogrid("grid").datagrid('reload');
}
function setdq(){
	var row = $('#MahodanNK').combogrid('grid').datagrid('getSelected');
	//alert(row.Mahodan);
	$('#DantocId').combogrid('setValue', row.DantocId);
	$('#DantocId').combogrid('setText', row.Dantoc);
	$('#QuoctichId').combobox('setValue', row.QuoctichId);
}
function sear_combo_xaid() {
	var sXa = $('#sXa').val();
	var sHuyen = $('#sHuyen').val();
	var sTinh = $('#sTinh').val();
	if (sXa.length > 0 || sHuyen.length > 0 || sTinh.length > 0) {
		$('#Xa_Id').combogrid('grid').datagrid('options').url = 'xa/combogrid/sXa/' + sXa + '/sHuyen/' + sHuyen + '/sTinh/' + sTinh;
	} else {
		$('#Xa_Id').combogrid('grid').datagrid('options').url = 'xa/combogrid';
	}
	$('#Xa_Id').combogrid("grid").datagrid('reload');
}
/************/
/** ************** HELPER ***************** * */
function del_helper(confirm, dg_id) {
	var row = $(dg_id).datagrid('getSelected');
	if (row) {
		$.messager.confirm('Thông báo', confirm, function(r) {
			if (r) {
				$.post(url, {
					id : row.Id
				}, function(result) {
					if (result.success) {
						$(dg_id).datagrid('reload');
					}
					show_messager(result.msg);
				}, 'json');
			}
		});
	} else {
		show_messager('Không có bản ghi nào được chọn!');
	}
}
function save_helper(form_id, confirm, dlg_id, dg_id) {
	if (!$(form_id).form('validate'))
		return;
	$.messager.confirm('Thông báo', confirm, function(r) {
		if (r) {
			$(form_id).form('submit', {
				url : url,
				success : function(result) {
					/*
					 * str = JSON.stringify(result); show_messager(str); return;
					 */
					var result = eval('(' + result + ')');
					if (result.success) {
						$(dlg_id).dialog('close');
						$(dg_id).datagrid('reload');
					}
					show_messager(result.msg);
				}
			});
		}
	});
}
/** ************** END ***************** * */

/** * B Nhân viên ** */
function formattrangthai_nv(val, row) {
	if (val == '')
		return '<label style="color:blue">Đang hoạt động</lable>';
	else
		return '<label style="color:red">Ngừng hoạt động</lable>';
}
function define_combogrid_nhanvien(data_url) {
	$('#NhanvienId').combogrid({
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
		required : true,
		url : data_url,
		toolbar : ('#combogrid-nhanvien-toolbar'),
		columns : [ [ {
			field : 'Id',
			title : 'Id',
			hidden : true
		}, {
			field : 'Tinhtrang',
			title : 'Tình trạng',
			width : 100,
			sortable : true,
			formatter : formattrangthai_nv
		}, {
			field : 'Manhanvien',
			title : 'Mã nhân viên',
			width : 90,
			sortable : true
		}, {
			field : 'Mangach',
			title : 'Mã ngạch',
			width : 90,
			sortable : true
		}, {
			field : 'Hoten',
			title : 'Họ và Tên',
			width : 150,
			sortable : true
		}, {
			field : 'Sohieu',
			title : 'Số hiệu',
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
			field : 'Dantoc',
			title : 'Dân tộc',
			width : 70,
			sortable : true
		}, {
			field : 'Chucvu',
			title : 'Chức vụ',
			width : 100,
			sortable : true
		}, {
			field : 'Noiohiennay',
			title : 'Nơi ở',
			width : 200,
			sortable : true
		}, {
			field : 'CMND',
			title : 'CMND',
			hidden : true
		}, {
			field : 'SosoBHXH',
			title : 'SosoBHXH',
			hidden : true
		} ] ]
	});
}
function define_combogrid_nhanvien_bh(data_url) {
	$('#Nhanvien').combogrid({
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
		required : true,
		url : data_url,
		toolbar : ('#combogrid-nhanvien-toolbar'),
		columns : [ [ {
			field : 'Id',
			title : 'Id',
			hidden : true
		}, {
			field : 'Tinhtrang',
			title : 'Tình trạng',
			width : 100,
			sortable : true,
			formatter : formattrangthai_nv
		}, {
			field : 'Manhanvien',
			title : 'Mã nhân viên',
			width : 90,
			sortable : true
		}, {
			field : 'Mangach',
			title : 'Mã ngạch',
			width : 90,
			sortable : true
		}, {
			field : 'Hoten',
			title : 'Họ và Tên',
			width : 150,
			sortable : true
		}, {
			field : 'Sohieu',
			title : 'Số hiệu',
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
			field : 'Dantoc',
			title : 'Dân tộc',
			width : 70,
			sortable : true
		}, {
			field : 'Chucvu',
			title : 'Chức vụ',
			width : 100,
			sortable : true
		}, {
			field : 'Noiohiennay',
			title : 'Nơi ở',
			width : 200,
			sortable : true
		}, {
			field : 'CMND',
			title : 'CMND',
			hidden : true
		}, {
			field : 'SosoBHXH',
			title : 'SosoBHXH',
			hidden : true
		} ] ]
	});
}
function sear_combogrid_nhanvien(data_url) {
	var sManv = $('#sManv').val();
	var sHoten = $('#sHoten').val();
	var sChucvu = $('#sChucvu').val();
	var sNoio = $('#sNoio').val();
	var sGioitinh = $('#sGioitinh').val();
	var sNgaysinh = $('#sNgaysinh').val();
	var sDantoc = $('#sDantoc').val();

	if (sNgaysinh.length > 0) {
		if (isDate(sNgaysinh))
			sNgaysinh = sNgaysinh.replace(new RegExp("/", "gm"), "$");
		else
			sNgaysinh = '';
	}
	if (sManv.length > 0 || sHoten.length > 0 || sChucvu.length > 0
			|| sNoio.length > 0 || sNgaysinh.length > 0 || sDantoc.length > 0
			|| sGioitinh.length > 0) {
		$('#NhanvienId').combogrid('grid').datagrid('options').url = data_url
				+ '/sManv/' + sManv + '/sHoten/' + sHoten + '/sChucvu/'
				+ sChucvu + '/sNoio/' + sNoio + '/sGioitinh/' + sGioitinh
				+ '/sNgaysinh/' + sNgaysinh + '/sDantoc/' + sDantoc;
	} else {
		$('#NhanvienId').combogrid('grid').datagrid('options').url = 'nhanvien/combogrid';
	}
	$('#NhanvienId').combogrid("grid").datagrid('reload');
}
// /////////////////////////////////////////////////////////////////

/**
 * Phadh tim kiem trong combogrid ma ngach
 */
function sear_combo_mangach(){
	var sTenmangach = $('#sTenmangach').val();
	var sMangach = $('#sMangach').val();
	if(sTenmangach.length > 0 || sMangach.length > 0){
		$('#Mangach').combogrid('grid').datagrid('options').url = 'mangach/sear/sTenmangach/'+sTenmangach+'/sMangach/'+sMangach;
	}else{
		$('#Mangach').combogrid('grid').datagrid('options').url = 'mangach/combogrid';
	}
	$('#Mangach').combogrid('grid').datagrid('reload');
}
function sear_combo_dantoc_nv() {
	try {
		
		var sdantoc =  $('#sdantoc').val();
		if(sdantoc.length > 0 ){
			$('#DantocId').combogrid('grid').datagrid('options').url =  'dantoc/combo' + '/sdantoc/'
			+ sdantoc;
		}else{
			$('#DantocId').combogrid('grid').datagrid('options').url = 'dantoc/combo';
		}
		$('#DantocId').combogrid('grid').datagrid('reload');
		
		
	} catch (e) {
		// alert(e);
	}
}