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

    public function setName($string) {
        $this->name = $string;
        return true;
    }
    public function getName(){
        return 'fffffffffff32424234';
    }

    public function setAge($age){
        $this->age = $age;
        return true;
    }

    public function getAge(){
        return $this->age;
    }
}