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

    public function __construct(){

        $this->reporterBugs = new ArrayCollection();
        $this->assignedBugs = new ArrayCollection();
    }
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
}