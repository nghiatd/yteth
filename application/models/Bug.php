<?php
use Doctrine\Common\Collections\ArrayCollection;
// src/Bug.php
/**
 * @Entity @Table(name="bugs")
 */
class Default_Model_Bug
{/**
     * @Id @Column(type="integer") @GeneratedValue
     **/
    protected $id;
    /**
     * @Column(type="string")
     **/
    protected $description;
    /**
     * @Column(type="datetime")
     **/
    protected $created;
    /**
     * @Column(type="string")
     **/
    protected $status;

    /**
     * @ManyToOne(targetEntity="Default_Model_User", inversedBy="assignedBugs")
     **/
    protected $engineer;

    /**
     * @ManyToOne(targetEntity="Default_Model_User", inversedBy="reportedBugs")
     **/
    protected $reporter;

    /**
     * @ManyToMany(targetEntity="Default_Model_Product")
     *  @JoinTable(name="default_model_bug_default_model_product")
     **/
    protected $products;


    public function __construct(){
        $this->products = new ArrayCollection();
    }

    public function setEngineer($engineer)
    {
        $engineer->assignedToBug($this);
        $this->engineer = $engineer;
    }

    public function setReporter($reporter)
    {
        $reporter->addReportedBug($this);
        $this->reporter = $reporter;
    }

    public function getEngineer()
    {
        return $this->engineer;
    }

    public function getReporter()
    {
        return $this->reporter;
    }
    public function assignToProduct($product)
    {
        $this->products[] = $product;
    }

    public function getProducts()
    {
        return $this->products;
    }
    
    

    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setCreated(DateTime $created)
    {
        $this->created = $created;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }
}