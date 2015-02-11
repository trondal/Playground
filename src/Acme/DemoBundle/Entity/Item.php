<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 *
 * @ORM\Entity
 * @ORM\Table(name="item")
 */
class Item {

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="items")
     */
    private $order;

    /**
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     * @Assert\Length(min=2, max=100)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Group", inversedBy="items", cascade={"persist"})
     * @ORM\JoinTable(name="items_groups")
     */
    private $groups;

    public function __construct() {
        $this->groups = new ArrayCollection();
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setName($name) {
        echo "Item:setName\n";
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function getOrder() {
        return $this->order;
    }

    public function setOrder(Order $order) {
        $this->order = $order;
    }

    public function getGroups(){
        return $this->groups;
    }

    public function addGroup(Group $group){
        $this->groups->add($group);
    }

    public function removeGroup(Group $group) {
        $this->groups->removeElement($group);
    }

}
