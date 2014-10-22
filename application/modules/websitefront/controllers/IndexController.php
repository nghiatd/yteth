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
 		$em = Zend_Registry::getInstance()->entitymanager;
 		// $allProducts = $em->getRepository('Default_Model_Product')->findAll();
 		// foreach ($allProducts as $key => $value) {
 		// 	$ProductModel = new Default_Model_Product();
	  //  		$ProductModel->setName($value->getId().'-'.$value->getName());
	  //  		$em->persist($ProductModel);

 		// }
   		
   		// $em->flush();die;

       // $product = new Default_Model_User();

       // $product->setName('new user');
      
       // $em->persist($product);
       // $em->flush();
       // var_dump($product->getId());die;
       // die;

//        Doctrine\Common\Util\Debug::dump($em);die;

		
        // $User = new Default_Model_User();
        // $product = new Default_Model_Product();
        
        // $reporter = $User->getById(1);
        // $defaultEngineer = $User->getById(2);

       $address = $em->getRepository('Default_Model_Address')->find(2);
       var_dump($address->getUser()->getName());die;


$addressModel = new Default_Model_Address();
$user = $em->getRepository('Default_Model_User')->find(2);
var_dump($user->getName());die;
$addressModel->setAddress('new address');
$addressModel->setUser($user);

$em->persist($addressModel);
$em->flush();die;

$bug = $em->getRepository('Default_Model_Bug')->find(1);
var_dump($bug->getEngineer()->getName());die;

$bug = new Default_Model_Bug();

$bug->setDescription("Something does not work!");
$bug->setCreated(new DateTime("now"));
$bug->setStatus("OPEN");


		$allProducts = $em->getRepository('Default_Model_Product')->findAll();

		$reporter = $em->getRepository('Default_Model_User')->find(1);
		$engineer = $em->getRepository('Default_Model_User')->find(5);

 		foreach ($allProducts as $key => $value) {
 			// var_dump($value);die;
 			$product = $em->getRepository('Default_Model_Product')->find($value->getId());
 			// var_dump($product);die;
	   		$bug->assignToProduct($product);

 		}

 		$bug->setReporter($reporter);
 		$bug->setEngineer($engineer);

$em->persist($bug);
$em->flush();die;



       	// $allBugs = $em->getRepository('Default_Model_Bug')->findAll();
       	// foreach ($allBugs as $key => $value) {
       	// 	$User = $em->getRepository('Default_Model_Bug')->find($value->getId());
       	// 	$User->setDescription($value->getId().'-'.$value->getDescription());
       	// 	$em->persist($User);
       	// }
       	// $em->flush();die;
        // var_dump($reporter->getName())	;
        // var_dump($defaultEngineer->getName());die;





        
	}
}