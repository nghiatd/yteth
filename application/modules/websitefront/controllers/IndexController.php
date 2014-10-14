<?php

/*
 * Create By Daitk @var Id, User
 */
include_once APPLICATION_PATH . '//modules/default/controllers/PublicdetailController.php';
class Websitefront_IndexController extends PublicdetailController {
	
	public function initValue() {
		$cache = Zend_Registry::get('cache');
	}
	public function init() {
		$this->_helper->layout->setLayout ( 'websiteyte_layout' );
		$this->initValue ();
	}
	public function indexAction() {
        $User = new Default_Model_User();
        $data = array('name'=>'array123', 'age' => 'agee2342343e', 'sex' => 'sesssss');
        $all = $User->getAll();
//        $all = $User->getById(9);
        $all = $User->getByCondition(array());
        var_dump($all[0]->getName());die;

	}
}