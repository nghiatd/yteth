<?php
use Doctrine\Common\Collections\ArrayCollection;
// src/Product.php
/**
 * @Entity @Table(name="products")
 */
class Default_Model_Product
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     * @var int
     */
    protected $id;
    /**
     * @Column(type="string")
     * @var String
     */
    protected $name;


     /**
     * @ManyToMany(targetEntity="Default_Model_Bug", mappedBy="products")
     **/
    protected $bugs;
    
    public function __construct(){
        $this->bugs = new ArrayCollection();
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
}