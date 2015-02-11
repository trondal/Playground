<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="groups")
 * @ORM\Entity
 */
class Group{

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
     * @ORM\ManyToMany(targetEntity="Item", mappedBy="groups")
     **/
    private $items;

    public function __construct(){
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function setName($name) {
        echo "Group:setName\n";
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

}
