<?php

namespace Acme\DemoBundle\Tests\PolyCollection;

use Acme\DemoBundle\Entity\Mobile;
use Acme\DemoBundle\Entity\Net;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Form\Tests\Extension\Core\Type\TypeTestCase;

class PolyCollectionTypeTest extends TypeTestCase {

    protected $em;
    protected $container;

    protected function setUp() {
        require_once realpath(dirname(__DIR__).'/../../../../app/AppKernel.php');
        $this->kernel = new \AppKernel('test', true);
        $this->kernel->boot();
 
        $this->container = $this->kernel->getContainer();
        $this->em = $this->container->get('doctrine')->getManager();
        
        parent::setUp();
    }

    public function testNew() {
        $order = $this->em->getRepository('Acme\DemoBundle\Entity\Order')->find(1);

        //$form = $this->container->get('acme.demo.order.type');
        //$form = $this->factory->create('order_type');
        $form = $this->factory->create('infinite_form_polycollection', null, array(
            'types' => array(
                'product_type',
                'mobile_type',
                'net_type'
            ),
            'allow_delete' => true
        ));
        
        $coll = new ArrayCollection(array(
            new Mobile('Trond', 11111111),
            new Net(54, 22222222)
        ));

        $form->setData($coll);

        $this->assertCount(2, $form);
        $this->assertEquals(22222222, $form[1]->getData()->getNumber());
            
        $this->assertInstanceOf('Acme\DemoBundle\Entity\Mobile', $form[0]->getData());
        $this->assertInstanceOf('Acme\DemoBundle\Entity\Net', $form[1]->getData());
        
        //$view = $form->createView();
        echo $this->container->get('templating')->renderResponse('AcmeDemoBundle:Demo:form.html.twig', array('form' => $form->createView()));
    }

    /* public function testNative() {
      $form = $this->factory->create('infinite_form_polycollection', null, array(
      'types' => array(
      'abstract_type',
      'first_type',
      'second_type',
      'bobbo_type',
      'mobile_type',
      'net_type'
      ),
      'allow_delete' => true
      ));
      $coll = new ArrayCollection(array(
      //new AbstractModel('Green'),
      new First('Red', 'Car'),
      new Second('Blue', true),
      new Bobbo('Alice', true),
      new Mobile('Trond', 97955731),
      new Net(54, 99999999)
      ));

      $form->setData($coll);

      $this->assertCount(5, $form);
      $this->assertEquals('Alice', $form[2]->getData()->getText2());
      $this->assertEquals(97955731, $form[3]->getData()->getNumber());
      $this->assertEquals(99999999, $form[4]->getData()->getNumber());
      } */

    protected function getExtensions() {
        return array(
            new FormExtension()
        );
    }

    protected static function getKernelClass() {
        require_once __DIR__ . '/app/AppKernel.php';

        return 'Symfony\Bundle\FrameworkBundle\Tests\Functional\app\AppKernel';
    }

    protected static function createKernel(array $options = array()) {
        $class = self::getKernelClass();

        if (!isset($options['test_case'])) {
            throw new \InvalidArgumentException('The option "test_case" must be set.');
        }

        return new $class(
                $options['test_case'], isset($options['root_config']) ? $options['root_config'] : 'config.yml', isset($options['environment']) ? $options['environment'] : 'frameworkbundletest' . strtolower($options['test_case']), isset($options['debug']) ? $options['debug'] : true
        );
    }

}

/*
new \Acme\DemoBundle\Entity\Mobile('Alice', 88888888),
            new \Acme\DemoBundle\Entity\Net(100, 44444444)*/