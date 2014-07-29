
var url;
var option;
var mahodan;
var tenchuho;
$(function() {
	$('#dg').datagrid({
		url:'hokhau/json',
		view : detailview,
		detailFormatter : function(index, row) {
			return '<div id="ddv-' + index + '" style="padding:5px 0"></div>';
		},
		onExpandRow : function(index, row) {
			$('#ddv-' + index).panel({
				border : false,
				cache : false,
				href : 'hokhau/detail/mahodan/' + row.Mahodan,
				onLoad : function() {
					$('#dg').datagrid('fixDetailRowHeight', index);
					//define_nhankhau();
					innitnhankhauinhokhau();
				}
			});
			$('#dg').datagrid('fixDetailRowHeight', index);
		}
	});
	reset_format_date('#Ngaydangkyhokhau');
});
function innitnhankhauinhokhau()
{
	$("#Hoten").validatebox({
		required : true
	});
	$("#QuanheId").combobox({
		url : '../default/quanhe/combo',
		valueField : 'Id',
		textField : 'Tenquanhe',
		required : true,
		editable : false,
		width : 152
	});
	$('#Nghenghiep').combobox('reload','nghenghiep/combo');
	$("#DangkhuyettatId").combobox({
		url : '../default/Dangkhuyettat/combo',
		valueField : 'Id',
		textField : 'Tendangkhuyettat',
		editable : true,
		width : 152
	});
	$("#MucdokhuyettatId").combobox({
		url : '../default/Mucdokhuyettat/combo',
		valueField : 'Id',
		textField : 'Tenmucdokhuyettat',
		required : false,
		editable : true,
		width : 152
	});	
	$("#DantocId").combogrid(
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
			toolbar : ('#Cbogrid-Dantoc-toolbar'),
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
	$("#TrinhdovanhoaId").combogrid({
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
		url : '../default/trinhdovanhoa/cbogridtrinhdovanhoa/sTentrinhdovanhoa/',
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
	$("#QuoctichId").combobox({
		url : '../default/quoctich/combo',
		valueField : 'Id',
		textField : 'Tenquoctich',
		required : true,
		editable : false,
		width : 152
	});
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
	reset_format_date('#NgaysinhNK');
	reset_format_date('#NgaycapNK');
}
function printDS() {
	var smahd = $('#sMahd').val();
	var sndk = $('#sNdk').datebox('getValue');
	var stch = $('#sTch').val();
	var sdc = $('#sDc').val();
	var std = $('#sTd').combobox('getValue');
	if (sndk.length > 0) {
		sndk = formatDate(sndk);
		sndk = convert_date(sndk);
	}
	if (smahd.length > 0 || sndk.length > 0 || stch.length > 0
			|| sdc.length > 0 || std.length > 0) {
		window.location.href = 'hokhau/exportdshk/sMahd/' + smahd + '/sNdk/'
				+ sndk + '/sTch/' + stch + '/sDc/' + sdc + '/sTd/' + std;

	} else {
		window.location.href = 'hokhau/exportdshk/sMahd/' + smahd + '/sNdk/'
				+ sndk + '/sTch/' + stch + '/sDc/' + sdc + '/sTd/' + std;
	}
}
function printHS() {
	var row = $('#dg').datagrid('getSelected');
	if (row) {
		window.location.href = "hokhau/exportxls/mahodan/" + row.Mahodan;
	} else {
		$.messager.show({
			title : 'Thông báo',
			msg : 'Không có bản ghi nào được chọn!',
			timeout : 5000,
			showType : 'slide'
		});
	}
}
function tenchuho_onChange() {
	if ($('#Hotench').length) {
		document.getElementById('Hotench').value = document
				.getElementById('Tenchuho').value;
	}
}
function printviewCT() {
	var row = $('#dg').datagrid('getSelected');
	if (row) {
		window.open("printview/printviewhosohokhau/mahodan/" + row.Mahodan);
	} else {
		$.messager.show({
			title : 'Thông báo',
			msg : 'Không có bản ghi nào được chọn!',
			timeout : 5000,
			showType : 'slide'
		});
	}
}
function printview() {
	var smahd = $('#sMahd').val();
	var sndk = $('#sNdk').datebox('getValue');
	var stch = $('#sTch').val();
	var sdc = $('#sDc').val();
	var std = $('#sTd').combobox('getValue');
	if (sndk.length > 0) {
		sndk = formatDate(sndk);
		sndk = convert_date(sndk);
	}
	if (smahd.length > 0 || sndk.length > 0 || stch.length > 0
			|| sdc.length > 0 || std.length > 0) {
		window.open('printview/printviewdshokhau/sMahd/' + smahd + '/sNdk/'
				+ sndk + '/sTch/' + stch + '/sDc/' + sdc + '/sTd/' + std);

	} else {
		window.open('printview/printviewdshokhau/sMahd/' + smahd + '/sNdk/'
				+ sndk + '/sTch/' + stch + '/sDc/' + sdc + '/sTd/' + std);
	}
}
function formatDatachkhau(val, row) {
	if (val > 0) {
		return '<input type="checkbox" id="DatachkhauNK" name="DatachkhauNK" checked disabled="disabled"/>';
	} else {
		return '<input type="checkbox" id="DatachkhauNK" name="DatachkhauNK" disabled="disabled"/>';
	}
}
function formatTinhtrang(val, row) {
	if (val == 1)
		return '<label style="color:green">Còn sống</label>';
	else if (val == 2)
		return '<label style="color:blue">Rời khỏi địa bàn</label>';
	else
		return '<label style="color:red">Đã chết</label>';
}
function formatXem(val, row) {
	return '<a href="#" class="easyui-linkbutton l-btn l-btn-plain" iconcls="icon-sum" plain="true" onclick="formview_details(\''
			+ val
			+ '\')" id="" style="font-weight:bold">Xem</a>';
}
function formview_details(id) {
	try {
		if (id != null) {
			$('#noidung_nhankhau').load('nhankhau/detail #dt_nhankhau', {
				id : id
			});
			$('#noidung_giaykhaisinh').load(
					'giaykhaisinh/detailfornhankhau #dt_nhankhau_giaykhaisinh',
					{
						nhankhauid : id
					});
			$('#noidung_giaykhaitu').load(
					'giaykhaitu/detailfornhankhau #dt_nhankhau_giaykhaitu', {
						nhankhauid : id
					});
			$('#dlg-nhankhau-chitiet').dialog('open').dialog('setTitle',
					'Thông tin nhân khẩu');
			$('#detail-etb').tabs('select', 'Nhân khẩu');
		} else {
			show_messager('Không có bản ghi nào được chọn!');
		}
	} catch (e) {
	}
}
function sear() {
	var smahd = $('#sMahd').val();
	var sndk = $('#sNdk').datebox('getValue');
	var stch = $('#sTch').val();
	var sdc = $('#sDc').val();
	var std = $('#sTd').combobox('getValue');
	if(sndk.length >0 ){
		sndk = sndk.replace(new RegExp("/","gm"),"$");
	}
	if (smahd.length > 0 || sndk.length > 0 || stch.length > 0
			|| sdc.length > 0 || std.length > 0) {
		$('#dg').datagrid('options').url = 'hokhau/sear/sMahd/' + smahd
				+ '/sNdk/' + sndk + '/sTch/' + stch + '/sDc/' + sdc + '/sTd/' + std;

	} else {
		$('#dg').datagrid('options').url = 'hokhau/json';
	}
	$('#dg').datagrid('reload');
}
function innitdatagird()
{
	// chủ hộ thomnd
	$('#dg-chuho').datagrid({
		title:'Thông tin chủ hộ',
        iconCls:'icon-edit',
        singleSelect:true,
        idField:'user',
        url:'json.php',
		   columns: [[	
				{field:'Quanhech',title:'Quan hệ',width:100,
				    formatter:function(value,row){
				        return row.Tenquanhe;
				    },
				    editor:{
				        type:'combobox',
				        options:{
				            valueField:'Quanhech',
				            textField:'Tenquanhe',
				            url:'quanhe/combointohokhau',
				            required:true,
				            editable:false
				        }
				}},
				{field:'Manhankhauch',title:'Mã nhân khẩu', width:150 ,editor:{type:'validatebox',options:{required:true}}}
				,{field:'Mabenhnhanch',width:150,title:'Mã bệnh nhân', editor:{type:'validatebox',options:{required:true}}}
				,{field:'Hotench',title:'Họ tên',width:150,editor:{type:'validatebox',options:{required:true}}}
				,{field:'Gioitinhch',title:'Nam', width:50, editor:{type:'checkbox',options:{on:'Nam',off:'Nữ'}}}
				,
				{field:'Ngaysinhch',title:'Ngày sinh',width:100,editor:{type:'datebox',options:{formatter : function(date) {
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
				},required:true
				}}},
				{field:'DantocIdch',title:'Dân tộc',width:100,
		                        formatter:function(value,row){
		                            return row.Tendantocch;
		                        },
		                        editor:{
		                            type:'combobox',
		                            options:{
		                                valueField:'DantocIdch',
		                                textField:'Tendantocch',
		                                url:'dantoc/combointohokhau',
		                                required:false,
		    				            editable:false
		                            }
                }}
				,
				{field:'QuoctichIdch',title:'Quốc tịch',width:100,
		                        formatter:function(value,row){
		                            return row.Tenquoctichch;
		                        },
		                        editor:{
		                            type:'combobox',
		                            options:{
		                                valueField:'QuoctichIdch',
		                                textField:'Tenquoctichch',
		                                url:'quoctich/comboch',
		                                required:false,
		    				            editable:false
		                            }
                }}
		        ,
             {field:'Cmndch',title:'CMND',width:100, editor:{type:'validatebox'}}
             ,
             {field:'Ngaycapch',title:'Ngày cấp',width:100, editor:{type:'datebox',options:{formatter : function(date) {
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
				
				
             }}},
             { field:'Noicapch',title:'Nơi cấp', width:100,editor:{type:'validatebox'}},
 			{field:'Dienthoaich',title:'Điện thoại',width:100, editor:{type:'validatebox'}},
 			{ field:'Emailch',width:100,title:'Email', editor:{type:'validatebox',options:{validType:'email'}}},
 			{field:'TrinhdovanhoaIdch',width:100,title:'Trình độ văn hóa',
                formatter:function(value,row){
                    return row.Tentrinhdovanhoa;
                },
                editor:{
                    type:'combobox',
                    options:{
                        valueField:'TrinhdovanhoaIdch',
                        textField:'Tentrinhdovanhoa',
                        url:'trinhdovanhoa/combointohokhau',
                        required:false,
			            editable:false
                    }}},
                   {field:'Nghenghiepch',width:100,title:'Nghề nghiệp',
                        formatter:function(value,row){
                            return row.Tennghenghiep;
                        },
                        editor:{
                            type:'combobox',
                            options:{
                                valueField:'Nghenghiepch',
                                textField:'Tennghenghiep',
                                url:'nghenghiep/combointohokhau',
                                required:false,
    				            editable:false
                            }
                        }},
            			{field:'DangkhuyettatIdch',width:100,title:'Dạng khuyết tật',
				                        formatter:function(value,row){
				                            return row.Tendangkhuyettat;
				                        },
				                        editor:{
				                            type:'combobox',
				                            options:{
				                                valueField:'DangkhuyettatIdch',
				                                textField:'Tendangkhuyettat',
				                                url:'dangkhuyettat/combointohokhau',
				                                required:false,
				    				            editable:false
				                            }
                        }},                    	
                       {field:'MucdokhuyettatIdch',width:100,title:'Mức khuyết tật',
				                        formatter:function(value,row){
				                            return row.Tenmucdokhuyettat;
				                        },
				                        editor:{
				                            type:'combobox',
				                            options:{
				                                valueField:'MucdokhuyettatIdch',
				                                textField:'Tenmucdokhuyettat',
				                                url:'mucdokhuyettat/combointohokhau',
				                                required:false,
				    				            editable:false
				                            }
                        }},
                        {field:'Id',hidden:true}
                    
		   ]]
		});	
	// nhankhau combo thomnd
	
	$('#dg-new').datagrid({
		title:'Thông tin nhân khẩu',
        iconCls:'icon-edit',
        singleSelect:true,
        idField:'user',
        url:'json.php',
		   columns: [[	
				{field:'Quanhe',title:'Quan hệ',width:100,
				    formatter:function(value,row){
				        return row.Tenquanhe;
				    },
				    editor:{
				        type:'combobox',
				        options:{
				            valueField:'Quanhe',
				            textField:'Tenquanhe',
				            url:'quanhe/combointonhankhau',
				            required:true,
				            editable:false
				        }
				}},
				{field:'Manhankhau',title:'Mã nhân khẩu', width:150 ,editor:{type:'validatebox',options:{required:true}}}
				,{field:'Mabenhnhan',width:150,title:'Mã bệnh nhân', editor:{type:'validatebox',options:{required:true}}}
				,{field:'Hoten',title:'Họ tên',width:150,editor:{type:'validatebox',options:{required:true}}}
				,{field:'Gioitinh',title:'Nam', width:50, editor:{type:'checkbox',options:{on:'Nam',off:'Nữ'}}}
				,
				{field:'Ngaysinh',title:'Ngày sinh',width:100,editor:{type:'datebox',options:{formatter : function(date) {
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
				},required:true
				}}},
				{field:'DantocIdnk',title:'Dân tộc',width:100,
		                        formatter:function(value,row){
		                            return row.Tendantocnk;
		                        },
		                        editor:{
		                            type:'combobox',
		                            options:{
		                                valueField:'DantocIdnk',
		                                textField:'Tendantocnk',
		                                url:'dantoc/combointonhankhau',
		                                required:false,
		    				            editable:false
		                            }
                }}
				,
				{field:'QuoctichIdnk',title:'Quốc tịch',width:100,
		                        formatter:function(value,row){
		                            return row.Tenquoctichnk;
		                        },
		                        editor:{
		                            type:'combobox',
		                            options:{
		                                valueField:'QuoctichIdnk',
		                                textField:'Tenquoctichnk',
		                                url:'quoctich/combonk',
		                                required:false,
		    				            editable:false
		                            }
                }}
		        ,
             {field:'Cmnd',title:'CMND',width:100, editor:{type:'validatebox'}}
             ,
             {field:'Ngaycap',title:'Ngày cấp',width:100, editor:{type:'datebox',options:{formatter : function(date) {
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
             }}},
             { field:'Noicap',title:'Nơi cấp', width:100,editor:{type:'validatebox'}},
 			{field:'Dienthoai',title:'Điện thoại',width:100, editor:{type:'validatebox'}},
 			{ field:'Email',width:100,title:'Email', editor:{type:'validatebox',options:{validType:'email'}}},
 			{field:'TrinhdovanhoaId',width:100,title:'Trình độ văn hóa',
                formatter:function(value,row){
                    return row.Tentrinhdovanhoa;
                },
                editor:{
                    type:'combobox',
                    options:{
                        valueField:'TrinhdovanhoaId',
                        textField:'Tentrinhdovanhoa',
                        url:'trinhdovanhoa/combointonhankhau',
                        required:false,
			            editable:false
                    }}},
                   {field:'Nghenghiep',width:100,title:'Nghề nghiệp',
                        formatter:function(value,row){
                            return row.Tennghenghiep;
                        },
                        editor:{
                            type:'combobox',
                            options:{
                                valueField:'Nghenghiep',
                                textField:'Tennghenghiep',
                                url:'nghenghiep/combointonhankhau',
                                required:false,
    				            editable:false
                            }
                        }},
            			{field:'DangkhuyettatId',width:100,title:'Dạng khuyết tật',
				                        formatter:function(value,row){
				                            return row.Tendangkhuyettat;
				                        },
				                        editor:{
				                            type:'combobox',
				                            options:{
				                                valueField:'DangkhuyettatId',
				                                textField:'Tendangkhuyettat',
				                                url:'dangkhuyettat/combointonhankhau',
				                                required:false,
				    				            editable:false
				                            }
                        }},                    	
                       {field:'MucdokhuyettatId',width:100,title:'Mức khuyết tật',
				                        formatter:function(value,row){
				                            return row.Tenmucdokhuyettat;
				                        },
				                        editor:{
				                            type:'combobox',
				                            options:{
				                                valueField:'MucdokhuyettatId',
				                                textField:'Tenmucdokhuyettat',
				                                url:'mucdokhuyettat/combointonhankhau',
				                                required:false,
				    				            editable:false
				                            }
                        }},
                        {field:'Idnk',hidden:true}
                    
		   ]]
		});
	
}
function add_new() {
	$('#dlg-new').dialog('open').dialog('setTitle', 'Thêm hộ khẩu');
	$('#fm-new').form('clear');
	$('#ThontoId').combobox('reload','thonto/combobyxaidhk');
	innitdatagird();
	$('#fm-new').form('load','hokhau/generaform');
	$('#dg-chuho').edatagrid({
		url: 'nhankhau/getinfochuho/mahodan/'
	});
	$('#dg-new').edatagrid({
	    url: 'nhankhau/getinfobymahodan/mahodan/'
	});
	
    $('#dg-chuho').edatagrid({
          onLoadSuccess: function(data){
        	 $('#dg-chuho').datagrid('appendRow',{});
        	  $('#dg-chuho').datagrid('beginEdit', 0);
          }
      });  
    var d = new Date();
    var n = 'HD'+ d.getTime().toString(); 
    $('#Mahodan').val(n);
   
    	
	 url = 'hokhau/add';
}
function edit_hokhau(){
	var row = $('#dg').datagrid('getSelected');
	$('#ThontoId').combobox('reload','thonto/combobyxaidhk');
	if(row){
		$('#fm-new').form('clear');
		innitdatagird();
		$('#dlg-new').dialog('open').dialog('setTitle','Sửa thông tin hộ khẩu');
		$('#fm-new').form('load', row);
		$('#dg-new').edatagrid({
		    url: 'nhankhau/getinfobymahodan/mahodan/'+row.Mahodan
		});
		$('#dg-chuho').edatagrid({
			url: 'nhankhau/getinfochuho/mahodan/'+row.Mahodan
		});

	  url = 'hokhau/update/id/' + row.Id;
	} else {
		show_messager('Không có bản ghi nào được chọn!');
	}
}
function save_new() {
	$('#dg-new').datagrid('acceptChanges');
	var items = $('#dg-new').datagrid('getRows');
	document.getElementById('new').value = JSON.stringify(items);
	$('#dg-chuho').datagrid('acceptChanges');
	var item = $('#dg-chuho').datagrid('getRows');
	document.getElementById('new-ch').value = JSON.stringify(item);
	$('#fm-new').form('submit', {
		url : url,
		onSubmit : function() {
			return $(this).form('validate');
		},
		success : function(result) {
			var result = eval('(' + result + ')');
			if (result.success) {
				$('#dlg-new').dialog('close');
				$('#dg').datagrid('reload');
				show_messager('Cập nhật dữ liệu thành công!');
			} else {
				$.messager.show({
					title : 'Error',
					msg : result.msg
				});
			}
		}
	});
}

function add_Nhankhau(_mahodan) {
	mahodan = _mahodan;
	$('#dlg-nhankhau').dialog('open').dialog('setTitle',
			'Thêm nhân khẩu {' + mahodan + '}');
	$('#fm-nhankhau').form('clear');
	$('#MahodanNK').combogrid('disable');
	$('#MahodanNK').combogrid('setValue', mahodan);
	$('#MahodanNK').combogrid('setText', mahodan);
    $('#QuoctichId').combobox('reload', 'quoctich/combo');
	var row = $('#MahodanNK').combogrid('grid').datagrid('getSelected');
	$('#DantocId').combogrid('setValue', row.DantocId);
	$('#DantocId').combogrid('setText', row.Dantoc);
	$('#QuoctichId').combobox('setValue', row.QuoctichId);
	document.getElementById("Gioitinh").checked = true;
	document.getElementById('td-nhankhau-QuanheId').innerHTML = '<input id="QuanheId" name="QuanheId" />';
	$('#QuanheId').combobox({
		url : 'quanhe/combo',
		valueField : 'Id',
		textField : 'Tenquanhe',
		required : true,
		editable : false,
		width : 152
	});
	$('#MucdokhuyettatId').combobox({
		required:false
	});
	url = 'nhankhau/add';
}
/*
function setkhuyettat(){
	var value = document.getElementById("Khuyettat").checked;
	if(value == true){
		document.getElementById("input-khuyettat").style.display = "block";
	}else{
		document.getElementById("input-khuyettat").style.display = "none";
		document.getElementById("label-mucdo").style.display = "none";
		document.getElementById("input-mucdo").style.display = "none";
		$('#MucdokhuyettatId').combobox({required:false});
	}
}
function setmucdo(_value){
	var value = _value;
	if(value != ''){
		document.getElementById("label-mucdo").style.display = "block";
		document.getElementById("input-mucdo").style.display = "block";
		$('#MucdokhuyettatId').combobox({
			required:true
		});
	}else{
		document.getElementById("label-mucdo").style.display = "none";
		document.getElementById("input-mucdo").style.display = "none";
		$('#MucdokhuyettatId').combobox({
			required:false
		});
	}
}
*/
function save_nhankhau() {
	$('#fm-nhankhau').form('submit', {
		url : url,
		onSubmit : function() {
			if ($(this).form('validate')) {
				if (!checkValue_nhankhau())
					return false;
				return true;
			} else
				return false;
		},
		success : function(result) {
			var result = eval('(' + result + ')');
			if (result.success) {
				$('#dlg-nhankhau').dialog('close');
				$('#dg-detail-' + mahodan).datagrid('reload');
				show_messager('Cập nhật dữ liệu thành công!');
			} else {
				$.messager.show({
					title : 'Error',
					msg : result.msg
				});
			}
		}
	});
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
	if ($('#Dienthoai_NK').val().length > 0) {
		if (!re.test($('#Dienthoai_NK').val())) {
			show_messager('Số điện thoại phải là chữ số có dạng: 11111111111...');
			return false;
		}
	}
	return true;
}
function del_nhankhau(_mahodan) {
	var row = new Array();
	row[0] = $('#dg-detail-' + _mahodan).datagrid('getSelected');
	if (row) {
		if (row[0]['Lachuho'] == '1') {
			show_messager('Không thể xóa nhân khẩu là chủ hộ dân!');
			return;
		}
		$.messager.confirm('Thông báo','Xóa Nhân khẩu sẽ xóa toàn bộ dữ liệu liên quan đến nhân khẩu này, Bạn có chắc chắn muốn xóa?',
			function(r) {
				if (r) {
					$.post('nhankhau/del',{items : row},function(result) {
						if (result.success) {
							$('#dg-detail-'+ _mahodan).datagrid('reload');
							show_messager('Xóa dữ liệu thành công!');
						} else {
							show_messager('Xóa dữ liệu không thành công!');
						}
					}, 'json');
				}
			});
	} else {
		show_messager('Không có bản ghi nào được chọn!');
	}
}
function edit_Nhankhau(_mahodan) {
	var row = $('#dg-detail-' + _mahodan).datagrid('getSelected');
	if (row) {
		mahodan = _mahodan;
		$('#DantocId').combogrid('setValue', row.Dantoc);
		$('#dlg-nhankhau').dialog('open').dialog('setTitle',
				'Sửa nhân khẩu {' + mahodan + '}');
		if (row.Quanhe == 'Chủ hộ') {
			document.getElementById('td-nhankhau-QuanheId').innerHTML = '<input id="QuanheId" name="QuanheId" type="hidden" value="0" /><input readonly style="width: 150px;" value="'
					+ row.Quanhe + '" />';
		} else {
			document.getElementById('td-nhankhau-QuanheId').innerHTML = '<input id="QuanheId" name="QuanheId" />';
			$('#QuanheId').combobox({
				url : 'quanhe/combo',
				valueField : 'Id',
				textField : 'Tenquanhe',
				required : true,
				editable : false,
				width : 152
			});
		}
		$('#fm-nhankhau').form('load', 'nhankhau/getobjbyid/id/' + row.Id);
		$('#MahodanNK').combogrid('disable');
		$('#MahodanNK').combogrid('setValue', mahodan);
		$('#MahodanNK').combogrid('setText', mahodan);
		url = 'nhankhau/update/id/' + row.Id;
	} else {
		show_messager('Không có bản ghi nào được chọn!');
	}
}
function del_hokhau() {
	var rows = $('#dg').datagrid('getChecked');
	numberrow = rows.length;
	if (numberrow > 0) {
		$.messager.confirm('Thông báo','Xóa Hộ khẩu sẽ xóa toàn bộ Nhân khẩu trong Hộ khẩu và thông tin liên quan, Bạn có chắc chắn muốn xóa '+ numberrow + ' phần tử?',function(r) {
			if (r) {
				$.post('hokhau/del',{items : rows},function(result) {
					if (result.success) {
						$('#dg').datagrid('reload');
						$('#dg').datagrid('uncheckAll');
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
function sear_combo_dantoc() {
	var sdantoc = $('#sdantoc').val();
	if (sdantoc.length >0) {
		$('#DantocIdhk').combogrid('grid').datagrid('options').url = 'dantoc/combo/sdantoc/'+ sdantoc;
	} else {
		$('#DantocIdhk').combogrid('grid').datagrid('options').url = 'dantoc/combo';
	}
	$('#DantocIdhk').combogrid("grid").datagrid('reload');
}

function sear_combo_dantoc_nk(){
	var sdantoc = $('#sdantocnk').val();
	if (sdantoc.length >0) {
		$('#DantocId').combogrid('grid').datagrid('options').url = 'dantoc/combo/sdantoc/'+ sdantoc;
	} else {
		$('#DantocId').combogrid('grid').datagrid('options').url = 'dantoc/combo';
	}
	$('#DantocId').combogrid("grid").datagrid('reload');
}