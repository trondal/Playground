<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="mobile")
 */
class Mobile extends Product {
 
    /**
     * @var integer
     *
     * @ORM\Column(name="name", type="string", length=100, nullable = false)
     * @Assert\NotBlank
     * @Assert\Length(min = 2, max = 100)
     */
    protected $name;
    
    
    /**
     * @var integer
     * @ORM\Column(name="number", type="integer", nullable=false)
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     * @Assert\Range(min=40000000,max=99999999)
     */
    protected $number;
    
    public function __construct($name, $number) {
        parent::__construct();
        $this->name = $name;
        $this->number = $number;
    }
    
    public function getDescription() {
        return $this->description;
    }
    
    public function setNumber($number) {
        $this->number = $number;
    }

    public function getNumber() {
        return $this->number;
    }
    
    public function setName($name){
        $this->name = $name;
    }
    
    public function getName(){
        return $this->name;
    }
    public function getType(){
        return 'mobile_type';
    }
}
