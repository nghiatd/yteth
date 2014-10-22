<?php
use Doctrine\Common\Collections\ArrayCollection;
// src/Address.php
/**
 * @Entity @Table(name="address")
 */
class Default_Model_Address
{

    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="Default_Model_User", inversedBy="setToAddress")
     **/
    protected $user;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $address;

    public function getId()
    {
        return $this->id;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function setUser($User){
    	$User->setToAddress($this);
    	$this->user = $User;
    }

    public function getUser(){
    	return $this->user;
    }

    public function getById($id = 0){
        return $this->_em->find(__CLASS__, $id);
    }
}