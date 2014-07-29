<?php
class Websitefront_Form_Binhluan extends Zend_Form{
	public function __construct( $option = array()){
		parent::__construct();
	
	}
	
	public function formBL($option = null){
		//$this->clearDecorators();
		$this->setName('Lienhe');
		//
		$labelTen = new Zend_Form_Element_Text('labelten');
		$labelTen->setLabel('Họ & Tên (*)')
		->setDecorators(array('ViewHelper', 'Label', new Zend_Form_Decorator_HtmlTag(array('tag'=>'div', 'class'=>'form'))));
		$ten = new Zend_Form_Element_Text('Ten');
		$ten->setOptions(array('class'=>'Ten'))
		->setDecorators(array('ViewHelper', 'Label', new Zend_Form_Decorator_HtmlTag(array('tag'=>'div', 'class'=>'input'))))
		->setRequired(true)
		->addValidator('NotEmpty', true)
		->getValidator('NotEmpty')->setMessage('Bạn không được để trống họ tên');
		//
		$labelemail = new Zend_Form_Element_Text('labelemail');
		$labelemail->setLabel('Email (*)')
		->setDecorators(array('ViewHelper', 'Label', new Zend_Form_Decorator_HtmlTag(array('tag'=>'div', 'class'=>'form'))));
		$email = new Zend_Form_Element_Text('Email');
		$email->setRequired(true)
		->setDecorators(array('ViewHelper', 'Label', new Zend_Form_Decorator_HtmlTag(array('tag'=>'div', 'class'=>'input'))))
		->addValidator('NotEmpty', true)
		->addValidator('EmailAddress')
		->getValidator('NotEmpty')->setMessage('Bạn không được để trống Email');
		$email->getValidator('EmailAddress')->setMessage('Email không hợp lệ');
		//
		$labelchude = new Zend_Form_Element_Text('labelchude');
		$labelchude->setLabel('Chủ đề (*)')
		
		->setDecorators(array('ViewHelper', 'Label', new Zend_Form_Decorator_HtmlTag(array('tag'=>'div', 'class'=>'form'))));
		$chude = new Zend_Form_Element_Text('ChuDe');
		$chude->setDecorators(array('ViewHelper', 'Label', new Zend_Form_Decorator_HtmlTag(array('tag'=>'div', 'class'=>'input'))))
		->setRequired(true)
		->addValidator('NotEmpty', true)
		->getValidator('NotEmpty')->setMessage('Bạn không được để trống chủ đề');
		
		//
		$TintucId = new Zend_Form_Element_Hidden('TintucId');
		$TintucId->setValue($option['TintucId']);
		$this->addElement($TintucId);
		//
		$labelnoidung = new Zend_Form_Element_Text('labelnoidung');
		$labelnoidung->setLabel('Nội dung (*)')
		->setDecorators(array('ViewHelper', 'Label', new Zend_Form_Decorator_HtmlTag(array('tag'=>'div', 'class'=>'form'))));
		$noidung = new Zend_Form_Element_Textarea('NoiDung');
		$noidung->setDecorators(array('ViewHelper', 'Label', new Zend_Form_Decorator_HtmlTag(array('tag'=>'div', 'class'=>'form'))))
		->setRequired(true)
		->addValidator('NotEmpty', true)
		->getValidator('NotEmpty')->setMessage('Bạn không được để trống nội dung');
		
		//
		$captcha = $this->createElement('captcha', 'captcha',
				array('required' => true,
						'captcha' => array('captcha' => 'Image',
								'font' => 'C:/Windows/Fonts/arial.ttf',
								'fontSize' => '24',
								'wordLen' => 5,
								'height' => '50',
								'width' => '150',
								'imgDir' => APPLICATION_PATH.'/../public/captcha',
								'imgUrl' => Zend_Controller_Front::getInstance()->getBaseUrl().'/public/captcha',
								'/captcha',
								'dotNoiseLevel' => 50,
								'message'=> array('badCaptcha'=>'Captcha không chính xác'),
								'lineNoiseLevel' => 5)))
								->setDecorators(array('ViewHelper', 'Label', new Zend_Form_Decorator_HtmlTag(array('tag'=>'div', 'class'=>'form'))));
		//$captcha->setErrorMessages(array('badCaptcha'=>'Captcha không chính xác', ''));
		$captcha->removeDecorator('viewhelper');
		
		
		
		//
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Gửi')
		->setDecorators(array('ViewHelper', 'Label', new Zend_Form_Decorator_HtmlTag(array('tag'=>'div', 'class'=>'form'))))
		->removeDecorator('label');
		
		$this->addElements(array($labelTen, $ten, $labelemail, $email, $labelchude, $chude, $labelnoidung, $noidung, $captcha,  $TintucId, $submit));
		// 		$this->addElement('hidden', 'TintucId', array('disableLoadDefaultDecorators'=>true));
		return $this;
	}
	
	public function formReply($option = null){
		//$this->clearDecorators();
		$this->setName('binhluan_reply')->setOptions(array('id'=>'binhluan_reply'));
		
		//
		
		$labelTen = new Zend_Form_Element_Text('labelten_reply');
		$labelTen->setLabel('Họ & Tên (*)')
		->setDecorators(array('ViewHelper', 'Label', new Zend_Form_Decorator_HtmlTag(array('tag'=>'div', 'class'=>'form'))));
		$ten = new Zend_Form_Element_Text('Ten_reply');
		
		$ten->setOptions(array('class'=>'Ten'))
		->setDecorators(array('ViewHelper', 'Label', new Zend_Form_Decorator_HtmlTag(array('tag'=>'div', 'class'=>'input'))))
		->setRequired(true)
		->addValidator('NotEmpty', true)
		->getValidator('NotEmpty')->setMessage('Bạn không được để trống họ tên');
		//
		$labelemail = new Zend_Form_Element_Text('labelemail_reply');
		$labelemail->setLabel('Email (*)')
		->setDecorators(array('ViewHelper', 'Label', new Zend_Form_Decorator_HtmlTag(array('tag'=>'div', 'class'=>'form'))));
		$email = new Zend_Form_Element_Text('Email_reply');
		$email->setRequired(true)
		->setDecorators(array('ViewHelper', 'Label', new Zend_Form_Decorator_HtmlTag(array('tag'=>'div', 'class'=>'input'))))
		->addValidator('NotEmpty', true)
		->addValidator('EmailAddress')
		->getValidator('NotEmpty')->setMessage('Bạn không được để trống Email');
		$email->getValidator('EmailAddress')->setMessage('Email không hợp lệ');
		//
		$labelchude = new Zend_Form_Element_Text('labelchude_reply');
		$labelchude->setLabel('Chủ đề (*)')
	
		->setDecorators(array('ViewHelper', 'Label', new Zend_Form_Decorator_HtmlTag(array('tag'=>'div', 'class'=>'form'))));
		$chude = new Zend_Form_Element_Text('ChuDe_reply');
		$chude->setDecorators(array('ViewHelper', 'Label', new Zend_Form_Decorator_HtmlTag(array('tag'=>'div', 'class'=>'input'))))
		->setRequired(true)
		->addValidator('NotEmpty', true)
		->getValidator('NotEmpty')->setMessage('Bạn không được để trống chủ đề');
		//
		$ParentId = new Zend_form_element_hidden('ParentId_reply');
		$ParentId->setValue($option['ParentId']);
		$this->addElement($ParentId);
//

			
		//
// 		$TintucId = new Zend_Form_Element_Hidden('TintucId');
// 		$TintucId->setValue($option['TintucId']);
// 		$this->addElement($TintucId);
		//
		$labelnoidung = new Zend_Form_Element_Text('labelnoidung_reply');
		$labelnoidung->setLabel('Nội dung (*)')
		->setDecorators(array('ViewHelper', 'Label', new Zend_Form_Decorator_HtmlTag(array('tag'=>'div', 'class'=>'form'))));
		$noidung = new Zend_Form_Element_Textarea('NoiDung_reply');
		$noidung->setDecorators(array('ViewHelper', 'Label', new Zend_Form_Decorator_HtmlTag(array('tag'=>'div', 'class'=>'form'))))
		->setRequired(true)
		->addValidator('NotEmpty', true)
		->getValidator('NotEmpty')->setMessage('Bạn không được để trống nội dung');
	
		//
		$captcha = $this->createElement('captcha', 'captcha_reply',
				array('required' => true,
						'captcha' => array('captcha' => 'Image',
								'font' => 'C:/Windows/Fonts/arial.ttf',
								'fontSize' => '24',
								'wordLen' => 5,
								'height' => '50',
								'width' => '150',
								'imgDir' => APPLICATION_PATH.'/../public/captcha',
								'imgUrl' => Zend_Controller_Front::getInstance()->getBaseUrl().'/public/captcha',
								'/captcha',
								'dotNoiseLevel' => 50,
								'message'=> array('badCaptcha'=>'Captcha không chính xác'),
								'lineNoiseLevel' => 5)))
								->setDecorators(array('ViewHelper', 'Label', new Zend_Form_Decorator_HtmlTag(array('tag'=>'div', 'class'=>'form'))));
		//$captcha->setErrorMessages(array('badCaptcha'=>'Captcha không chính xác', ''));
		$captcha->removeDecorator('viewhelper');
	
	
	
		//
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Gửi')
		->setOptions(array('class'=>'submit_reply'))
		->setDecorators(array('ViewHelper', 'Label', new Zend_Form_Decorator_HtmlTag(array('tag'=>'div', 'class'=>'form'))))
		->removeDecorator('label');
	
		$this->addElements(array($labelTen, $ten, $labelemail, $email, $labelchude, $chude, $labelnoidung, $noidung, $captcha,   $submit));
		// 		$this->addElement('hidden', 'TintucId', array('disableLoadDefaultDecorators'=>true));
		return $this;
	}
}