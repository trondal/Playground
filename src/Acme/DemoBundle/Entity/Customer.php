<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="customer")
 * @ORM\Entity
 */
class Customer{

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

    public function __construct(){
    }

    public function getId() {
        return $this->id;
    }

    public function setName($name) {
        echo "Customer:setName\n";
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

}
