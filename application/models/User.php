<?php
use Doctrine\Common\Collections\ArrayCollection;
// src/User.php
/**
 * @Entity @Table(name="users")
 */
class Default_Model_User
{

    /**
     * @OneToMany(targetEntity="Default_Model_Bug", mappedBy="reporter")
     * @var Bug[]
     **/
    protected $reportedBugs = null;

    /**
     * @OneToMany(targetEntity="Default_Model_Bug", mappedBy="engineer")
     * @var Bug[]
     **/
    protected $assignedBugs = null;

    
    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     */
    protected $id;
    /**
     * @Column(type="string")
     * @var string
     */
    protected $name;

    /**
     * @OneToMany(targetEntity="Default_Model_Address", mappedBy="user", cascade={"persist"})
     **/
    protected $addresss;


    public function __construct(){
        $this->_em = Zend_Registry::getInstance()->entitymanager;
        $this->reporterBugs = new ArrayCollection();
        $this->assignedBugs = new ArrayCollection();
        $this->addresss = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function addReportedBug($bug)
    {
        $this->reportedBugs[] = $bug;
    }

    public function assignedToBug($bug)
    {

        $this->assignedBugs[] = $bug;
    }

    public function setToAddress($address){
        $this->setToAddress[] = $address;
    }

    public function getById($id = 0){
        return $this->_em->find(__CLASS__, $id);
    }

    public function getAddress(){
        return $this->addresss->toArray();
    }

    public function addAdd(Default_Model_Address $address){
        if(!$this->addresss->contains($address)){
            $this->addresss->add($address);     
        }
        return $this;
    }
}