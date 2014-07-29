<?php
class Block_Binhluan extends Zend_View_Helper_Abstract{
	public function binhLuan($parentId = 0){
		$html = '';
		if($parentId !=0){
			$Binhluan = Websitefront_Model_Binhluan::getChildren($parentId);
			if(count($Binhluan)){
				$html = '<ul class="children">';
				foreach ($Binhluan as $value){
					$html .= '<li>';
					$html .= '<div>';
					//$html .= '<div class="comment-avatar"><img src="img/avatar.png" alt="MyPassion" /></div>';
					$html .= "<div class='commment-text-wrap'>";
					$html .= '<div class="comment-data">';
					$html .=' <p><a  href="#" class="url">'.$value['Email'].'</a> <br /> <span>'.$value['NgayTao'].'&nbsp;<a  id="a_'.$value['Id'].'" class="comment-reply-link">reply</a></span></p>';
					$html .='</div>';
					$html .= '<div class="comment-text">'.$value['NoiDung'].'</div>';
					$html .= ' </div>';
					$html .="<div class='error_reply' id='error_".$value['Id']."'></div>";
					$html .="<div class ='form_bl' id='div_".$value['Id']."'></div>";
					$html .='</div>';
					$Children = Websitefront_Model_Binhluan::getChildren($value['Id']);
					if(count ($Children))
						$html .= $this->binhLuan();
				}
				$html .= '</li></ul>';
				
			}
		}	
		return  $html;
	}
	
	
	
}