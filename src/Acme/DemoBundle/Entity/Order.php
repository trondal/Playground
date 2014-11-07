<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
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
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="ribollita", type="integer", nullable = false)
     * @Assert\Range(
     *      min = 1,
     *      max = 10,
     *      minMessage = "You must be at least {{ limit }}cm tall to enter",
     *      maxMessage = "You cannot be taller than {{ limit }}cm to enter"
     * )
     */
    private $ribollitaId;
    
    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="order", cascade={"persist"})
     */
    private $products;
    
    public function __construct(){
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function addProduct(Product $product){
        if (!$this->products->contains($product)){
            $product->setOrder($this);
            $this->products->add($product);
        }
    }
    
    public function removeProduct(Product $product){
        $this->products->removeElement($product);
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
