<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     * @Assert\Length(min=2, max=100)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Product")
     **/
    private $product;

    /**
     * @ORM\OneToOne(targetEntity="Customer", cascade={"persist"})
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity="Item", mappedBy="order", cascade={"persist"})
     */
    private $items;

    public function __construct() {
        //$this->products = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function setName($name) {
        echo "Order:setName\n";
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function getCustomer() {
        return $this->customer;
    }

    public function setCustomer(Customer $customer) {
        $this->customer = $customer;
    }

    public function addItem(Item $item) {
        //if (!$this->items->contains($item)) {
            $item->setOrder($this);
            $this->items->add($item);
        //}
    }

    public function removeItem(Item $item) {
        $this->items->removeElement($item);
    }

    public function getItems() {
        return $this->items;
    }

    public function setProduct(Product $product) {
        $this->product = $product;
    }

    public function getProduct() {
        return $this->product;
    }

}
