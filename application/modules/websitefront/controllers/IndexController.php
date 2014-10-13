<?php

/*
 * Create By Daitk @var Id, User
 */
include_once APPLICATION_PATH . '//modules/default/controllers/PublicdetailController.php';
class Websitefront_IndexController extends PublicdetailController {
	
	public function initValue() {
		$cache = Zend_Registry::get('cache');

		$this->_em = Zend_Registry::getInstance()->entitymanager;


	}
	public function init() {
		$this->_helper->layout->setLayout ( 'websiteyte_layout' );
		$this->initValue ();
	}
	public function indexAction() {
        $User = new Default_Model_User();
        $User->setName('new 123us1231231');
        $User->setAge(425);
        $this->_em->persist($User);
//        $this->_em->flush();

        $all = $this->_em->getRepository('Default_Model_User')->findAll();
        foreach($all as $value){
            var_dump($value->getAge());
        }
        die;
	}
}
?>