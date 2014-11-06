<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
abstract class NetLine extends Product {


    protected $net;
       
    public function __construct() {
    }
    
    public function getNet() {
        return $this->net;
    }
    
    public function setNet(Net $net){
        $this->net = $net;
    }
    
}
