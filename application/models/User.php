<?php
/**
* @Entity
* @Table(name="users")
*/
class Default_Model_User
{
    /**
    * @Id @Column(type="integer")
    * @GeneratedValue(strategy="AUTO")
    */
    private $id;

    /** @Column(type="string") */
    private $name;

    /** @Column(type="string") */
    private $age;

    /** @Column(type="string") */
    private $sex;

    public function __construct(){
        $this->_em = Zend_Registry::getInstance()->entitymanager;
    }
    public function setData($data = array()){
        if(count($data)){
            foreach($data as $key => $value){
                $this->$key = $value;
            }
            $this->_em->persist($this);
            $this->_em->flush();
        }
    }

    public function setName($string) {
        $this->name = $string;
        return true;
    }


    public function setAge($age){
        $this->age = $age;
        return true;
    }

    public function getAge(){
        return $this->age;
    }

    public function getName(){
        return $this->name;
    }

    public function getAll(){
        return $this->_em->getRepository(__CLASS__)->findAll();
    }

    public function getById($id = 0){
        return $this->_em->find(__CLASS__, $id);
    }

    public function getByCondition($condition = array()){
        return $this->_em->findBy(array('id' => array('1', '2', '3')));
    }
}