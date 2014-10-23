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
    //http://future500.nl/articles/2013/09/more-on-one-to-manymany-to-one-associations-in-doctrine-2/
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


// $user = $em->getRepository('Default_Model_User')->find(1);
// var_dump($user->getAddress());die;

    // $user = $em->getRepository('Default_Model_User')->find(2);
    $user = new Default_Model_User;
    $user->setName('autdn122');

    $addressModel = new Default_Model_Address;
    $addressModel->setAddress('address added automatically24311234');
    $addressModel->setUser($user);


    $addressModel1 = new Default_Model_Address;
    $addressModel1->setAddress('address added  1');
    $addressModel1->setUser($user);




    $user->addAdd($addressModel);
    $user->addAdd($addressModel1);
    $em->persist($user);
    $em->flush();

    foreach ($user->getAddress() as $key => $value) {
      var_dump($value->getAddress());
      # code...
    }
    var_dump($addressModel->getUser()->getId());

    var_dump($addressModel->getUser()->getName());die;
    
    // foreach ($user->getAdd() as $key => $value) {
    //   # code...
    //   var_dump($value->getAddress());
    //   var_dump(get_class($value));
    // }

    var_dump($address->getUser()->getName());die;
    $bug = $em->getRepository('Default_Model_Bug')->find(2);
    $product = $em->getRepository('Default_Model_Product')->find(3);

    // var_dump($product->getBugs());die;
    // var_dump($bug->getEngineer()->getAddress());die;
    foreach ($bug->getProducts() as $key => $value) {
      var_dump($value->getName());
      # code...
    }
die;


    $bug = new Default_Model_Bug;
    // var_dump(new DateTime('now'));die;
    $bug->setDescription('fatal error 123');
    $bug->setCreated(new DateTime('now'));
    $bug->setStatus('OPEN')  ;

    foreach ($em->getRepository('Default_Model_Product')->findAll() as $key => $value) {
      # code...
      $bug->assignToProduct($value);
    }
    $bug->setEngineer($em->getRepository('Default_Model_User')->find(1));
    $bug->setReporter($em->getRepository('Default_Model_User')->find(2));
    $em->persist($bug);
    $em->flush();die;

    $aModel = new Default_Model_Useradd;
    $aModel->setAddress('address added automatically user 1');
    $aModel->setUser($em->getRepository('Default_Model_User')->find(1));
    $em->persist($aModel);
    $em->flush();

       $address = $em->getRepository('Default_Model_Useradd')->find(3);
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