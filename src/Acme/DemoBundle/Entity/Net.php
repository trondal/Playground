<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="net")
 */
class Net extends Product {

    /**
     * @var integer
     *
     * @ORM\Column(name="org_id", type="integer", nullable = false)
     * @Assert\NotBlank
     * @Assert\Length(min = 2, max = 100)
     */
    private $orgId;
    
    /**
     * @var integer
     * @ORM\Column(name="number", type="integer", nullable=false)
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     * @Assert\Range(min=40000000,max=99999999)
     */
    private $number;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function setNumber($number) {
        $this->number = $number;
    }

    public function getNumber() {
        return $this->number;
    }
    
    public function setOrgId($id){
        $this->orgId = $id;
    }
    
    public function getOrgId(){
        return $this->orgId;
    }
    
}
