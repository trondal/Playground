<?php

namespace Acme\DemoBundle\Tests\PolyCollection;

use Acme\DemoBundle\Form\Type\MobileType;
use Acme\DemoBundle\Form\Type\NetType;
use Acme\DemoBundle\Form\Type\OrderType;
use Acme\DemoBundle\Form\Type\ProductType;
use Infinite\FormBundle\Form\Type\PolyCollectionType;
use Infinite\FormBundle\Tests\PolyCollection\Type\AbstractType;
use Infinite\FormBundle\Tests\PolyCollection\Type\FirstType;
use Infinite\FormBundle\Tests\PolyCollection\Type\FourthType;
use Infinite\FormBundle\Tests\PolyCollection\Type\SecondType;
use Symfony\Component\Form\AbstractExtension;
/**
 * Testing extension for the PolyCollection
 *
 * @author Tim Nagel <t.nagel@infinite.net.au>
 * */
class FormExtension extends AbstractExtension
{
    protected function loadTypes()
    {
        return array(
            new PolyCollectionType(),
            new AbstractType(),
            new FirstType(),
            new SecondType(),
            new FourthType(),
            new BobboType(),
            new MobileType,
            new NetType(),
            new OrderType(),
            new ProductType()
        );
    }
}