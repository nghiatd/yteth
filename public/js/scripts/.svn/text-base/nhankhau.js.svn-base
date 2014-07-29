var url;
var option;
var mahodan;








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




/*
 * Lê văn kiên
 */
function add_tinh() {
	$('#dlg_tinh').dialog('open').dialog('setTitle', 'Thêm tỉnh thành phố');
	$('#fm_tinh').form('clear');
}
function save_tinh() {
	$('#fm_tinh').form('submit', {
		url : 'tinh/add',
		onSubmit : function() {
			return $(this).form('validate');
		},
		success : function(result) {
			var result = eval('(' + result + ')');
			if (result.success) {
				$('#dlg_tinh').dialog('close');
				$('#tinh').combobox('reload');
				$('#fm_tinh').form('close');
				$('#dlg_tt').dialog('reload');
				$('#fm_tt').form('reload');
				$('#dlg_huyen').dialog('reload');
				$('#fm_huyen').form('reload');
			} else {
				show_messager(result.msg);
			}
		}
	});
}
function add_huyen() {
	$('#dlg_huyen').dialog('open').dialog('setTitle', 'Thêm huyện');
	$('#fm_huyen').form('clear');
}

function save_huyen() {
	$('#fm_huyen').form('submit', {
		url : 'huyen/add',
		onSubmit : function() {
			return $(this).form('validate');
		},
		success : function(result) {
			var result = eval('(' + result + ')');
			if (result.success) {
				$('#dlg_huyen').dialog('close');
				$('#huyen').combobox('reload');
				$('#XaId').combobox('reload');
				$('#fm_huyen').form('close');
			} else {
				show_messager(result.msg);
			}
		}
	});
}

function add_xa() {
	$('#dlg_xa').dialog('open').dialog('setTitle', 'Thêm xã');
	$('#fm_xa').form('clear');
}
function save_xa() {
	$('#fm_xa').form('submit', {
		url : 'xa/add',
		onSubmit : function() {
			return $(this).form('validate');
		},
		success : function(result) {
			var result = eval('(' + result + ')');
			if (result.success) {
				$('#dlg_xa').dialog('close');
				$('#XaId').combobox('reload');
				$('#fm_xa').form('close');
			} else {
				show_messager(result.msg);
			}
		}
	});
}

function add_trinhdovanhoa() {
	$('#dlg_trinhdovanhoa').dialog('open').dialog('setTitle',
			'Thêm trình độ văn hóa');
	$('#fm_trinhdovanhoa').form('clear');
}
function save_trinhdovanhoa() {
	$('#fm_trinhdovanhoa').form('submit', {
		url : 'trinhdovanhoa/add',
		onSubmit : function() {
			return $(this).form('validate');
		},
		success : function(result) {
			var result = eval('(' + result + ')');
			if (result.success) {
				$('#dlg_trinhdovanhoa').dialog('close');
				$('#TrinhdovanhoaId').combobox('reload');
				$('#fm_trinhdovanhoa').form('close');
				show_messager('Cập nhật dữ liệu thành công!');
			} else {
				show_messager(result.msg);
			}
		}
	});
}

function add_dantoc() {
	$('#dlg_dantoc').dialog('open').dialog('setTitle', 'Thêm dân tộc');
	$('#fm_dantoc').form('clear');
}
function save_dantoc() {
	$('#fm_dantoc').form('submit', {
		url : 'dantoc/add',
		onSubmit : function() {
			return $(this).form('validate');
		},
		success : function(result) {
			var result = eval('(' + result + ')');
			if (result.success) {
				$('#dlg_dantoc').dialog('close');
				$('#DantocId').combobox('reload');
				$('#fm_dantoc').form('close');
			} else {
				show_messager(result.msg);
			}
		}
	});
}

function add_quoctich() {
	$('#dlg_quoctich').dialog('open').dialog('setTitle', 'Thêm quốc tịch');
	$('#fm_quoctich').form('clear');
}

function save_quoctich() {
	$('#fm_quoctich').form('submit', {
		url : 'quoctich/add',
		onSubmit : function() {
			return $(this).form('validate');
		},
		success : function(result) {
			var result = eval('(' + result + ')');
			if (result.success) {
				$('#dlg_quoctich').dialog('close');
				$('#QuoctichId').combobox('reload');
				$('#fm_quoctich').form('close');
				show_messager('Cập nhật dữ liệu thành công!');
			} else {
				show_messager(result.msg);
			}
		}
	});
}

function add_tt() {
	$('#dlg_tt').dialog('open').dialog('setTitle', 'Thêm thôn tổ');
	$('#fm_tt').form('clear');
}

function save_tt() {
	$('#fm_tt').form('submit', {
		url : 'thonto/add',
		onSubmit : function() {
			return $(this).form('validate');
		},
		success : function(result) {
			var result = eval('(' + result + ')');
			if (result.success) {
				$('#dlg_tt').dialog('close');
				$('#ThontoId').combobox('reload');
			} else {
				show_messager(result.msg);
			}
		}
	});
}

// ////////////////////////////////Phadh view bao cao nhan
// khau//////////////////////////////////////////////

// ///////////////////////////////////////////////////////////////////////////////////////////////////////////
