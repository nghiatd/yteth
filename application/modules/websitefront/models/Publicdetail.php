<?php
  class   Websitefront_Model_Publicdetail extends  Zend_Db_Table_Abstract
{
	protected  static  $IdUser;
	protected static   $IdThongtincoquan;
	protected static  $_Namhoatdong;
	protected $NameTblAdmin = "tbladmin";
	protected static  $Dtap =null;
	protected static   $Tencoquan;
	
	public  static  function GetIdUser($IdUse)
	{
		self::$IdUser = $IdUse;
		
	}
	public  function __construct()
	{
		self::$Dtap = Zend_Registry::get("db");
	}
	public static  function ReturnTblAdminbyId()
	{
		if(self::$Dtap==null)
		{
			self::$Dtap = Zend_Registry::get("db");
		}
		$query=self::$Dtap->query("select Id,User, Email,FullName,Address,Phone,Fax,ThongtincoquanId,Kichhoat,Chucnang, 

				 (select if(count(tbltrunggian.Id)>0,'inline','none') from tbladmin as tbltrunggian where tbltrunggian.Id=tbl.Id and tbltrunggian.Chucnang like '%0%') as Hethong,
				 (select if(count(tbltrunggian.Id)>0,'inline','none') from tbladmin as tbltrunggian where tbltrunggian.Id=tbl.Id and tbltrunggian.Chucnang like '%1%') as Nhansu,
				 (select if(count(tbltrunggian.Id)>0,'inline','none') from tbladmin as tbltrunggian where tbltrunggian.Id=tbl.Id and tbltrunggian.Chucnang like '%2%') as Danso,
				 (select if(count(tbltrunggian.Id)>0,'inline','none') from tbladmin as tbltrunggian where tbltrunggian.Id=tbl.Id and tbltrunggian.Chucnang like '%3%') as Khambenh,
				(select if(count(tbltrunggian.Id)>0,'inline','none') from tbladmin as tbltrunggian where tbltrunggian.Id=tbl.Id and tbltrunggian.Chucnang like '%4%') as Muctieuquocgia,
				(select if(count(tbltrunggian.Id)>0,'inline','none') from tbladmin as tbltrunggian where tbltrunggian.Id=tbl.Id and tbltrunggian.Chucnang like '%5%') as Tiemchung,
				(select if(count(tbltrunggian.Id)>0,'inline','none') from tbladmin as tbltrunggian where tbltrunggian.Id=tbl.Id and tbltrunggian.Chucnang like '%6%') as Thuocvattu,
				(select if(count(tbltrunggian.Id)>0,'inline','none') from tbladmin as tbltrunggian where tbltrunggian.Id=tbl.Id and tbltrunggian.Chucnang like '%7%') as Thongkebaocao,
				(select if(count(tbltrunggian.Id)>0,'inline','none') from tbladmin as tbltrunggian where tbltrunggian.Id=tbl.Id and tbltrunggian.Chucnang like '%8%') as Website
				
				from tbladmin as tbl where Id=".self::$IdUser);
		$row =$query->fetchAll();
		self::$IdThongtincoquan=$row[0]['ThongtincoquanId'];
		
		return $row;
	}
	public static function ReturnTblThongtincoquanById()
	{
		if(self::$Dtap==null)
		{
			self::$Dtap = Zend_Registry::get("db");
		}
		$query=self::$Dtap->query("select Id,Matram,Tencoquan,Nguoidaidien,Dienthoai,PhanloaixaId,Diachi,Email,Website,CoquanId,Phuluc,Logo,Namhoatdong, Tenviettat, Bando from tblthongtincoquan where Id=".self::$IdThongtincoquan);
		$row = $query->fetchAll();
		if(count($row)>0)
		{	self::$Tencoquan = $row[0]['Tencoquan'];
			self::$_Namhoatdong=$row[0]['Namhoatdong'];
		}
		
		return $row;
	}
	public static  function ReturnTblDongia()
	{
		if(self::$Dtap==null)
		{
			self::$Dtap = Zend_Registry::get("db");
		}
		$query=self::$Dtap->query("select Id,Giatien, Tienthuthuat from  tbldm_dongia where ThongtincoquanId=".self::$IdThongtincoquan." and Namhoatdong =".self::$_Namhoatdong);
		$row = $query->fetchAll();
		return $row;
	}
	public static  function  ReturnTblTinhByTramId()
	{
		if(self::$Dtap==null)
		{
			self::$Dtap = Zend_Registry::get("db");
		}
		$query=self::$Dtap->query("select tbldm_tinh.Id as Id,Tentinh,tbldm_huyen.Tenhuyen as Tenhuyen,tbldm_xa.Tenxa as Tenxa from tbldm_tinh,tbldm_huyen,tbldm_xa where tbldm_huyen.TinhId=tbldm_tinh.Id and tbldm_xa.HuyenId=tbldm_huyen.Id and tbldm_xa.Id  in  (select CoquanId from tblthongtincoquan where tblthongtincoquan.Id=".self::$IdThongtincoquan. ")");
		$row = $query->fetchAll();
		return $row;
	}
	
	public static  function rowquoctich()
	{
		if(self::$Dtap==null)
		{
			self::$Dtap = Zend_Registry::get("db");
		}
		$query=self::$Dtap->query("select Id, Tenquoctich from tbldm_quoctich where Tenquoctich like '%Việt Nam%'");
		return  $query->fetchAll();
		
	}
	public static function rowdantoc()
	{
		if(self::$Dtap==null)
		{
			self::$Dtap = Zend_Registry::get("db");
		}
		$query=self::$Dtap->query("select Id, Tendantoc from tbldm_dantoc where Tendantoc like '%Kinh%'");
		return  $query->fetchAll();
	
	}
	public static function rowtongiao()
	{
		if(self::$Dtap==null)
		{
			self::$Dtap = Zend_Registry::get("db");
		}
		$query=self::$Dtap->query("select Id, Tentongiao from tbldm_tongiao where Tentongiao like '%Không%'");
		return  $query->fetchAll();
	
	}
	
	
	
	
	
	
	
}