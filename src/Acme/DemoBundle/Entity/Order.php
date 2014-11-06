<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * This class represents a OrderItem item, of a Order type.
 * It is abstract because we never have a OrderItem entity, it's just an Order.
 * @ORM\Entity
 * @ORM\Table(name="orders")
 * @ORM\Entity
 */
class Order {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="ribollita", type="integer", nullable = false)
     */
    protected $ribollitaId;
    
    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="order")
     */
    protected $products;
    
    public function __construct(){
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function addProduct(Product $product){
        $product->setOrder($this);
        $this->products->add($product);
    }
    
    public function getProducts() {
        return $this->products;
    }
    
    public function setRibollitaId($id) {
        $this->ribollitaId = $id;
    }
    
    public function getRibollitaId(){
        return $this->ribollitaId;
    }

}
