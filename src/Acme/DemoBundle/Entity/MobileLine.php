<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
abstract class MobileLine extends Product {

    /**
     * @ORM\OneToOne(targetEntity="Mobile")
     */
    protected $mobile;
       
    public function __construct() {
    }
    
    public function getMobile() {
        return $this->mobile;
    }
    
    public function setMobile(Mobile $mobile){
        $this->mobile = $mobile;
    }
    
}
