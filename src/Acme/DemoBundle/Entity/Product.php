<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * This class represents a OrderItem item, of a Order type.
 * It is abstract because we never have a OrderItem entity, it's just an Order.
 * @ORM\Entity
 * @ORM\Table(name="productitem")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"mobile_type" = "Mobile", "net_type" = "Net"})
 */
class Product {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="products")
     */
    protected $order;
  
    public function __construct() {
        
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getOrder(){
        return $this->order;
    }
    
    public function setOrder(Order $order){
        $this->order = $order;
    }


}
