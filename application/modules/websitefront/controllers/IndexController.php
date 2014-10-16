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
//        $User = new Default_Model_User();
//        $data = array('name'=>'array123', 'age' => 'agee2342343e', 'sex' => 'sesssss');
////        $User->setData($data);
////        $all = $User->getAll();
////        $all = $User->getById(9);
//        $all = $User->getByCondition(array());
//        var_dump($all);die;

//        $product = new Default_Model_Product();
//        $product->setName('set from 123');
//        $em = Zend_Registry::getInstance()->entitymanager;
//        $em->persist($product);
//
//        $user = new Default_Model_User();
//        $user->setName('tdn');
//        $em->persist($user);
//
//        $em->flush();
//        Doctrine\Common\Util\Debug::dump($em);die;

        $User = new Default_Model_User();
        $product = new Default_Model_Product();
        $reporter = $User->getById($id = 1);
        $defaultEngineer = $User->getById(2);

        $product = $product->getById(1);

        
	}
}