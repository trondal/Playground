<?php

namespace Acme\DemoBundle\Controller;

// these import the "@Route" and "@Template" annotations


use Acme\DemoBundle\Entity\Mobile;
use Acme\DemoBundle\Entity\Net;
use Acme\DemoBundle\Form\ContactType;
use Acme\DemoBundle\Tests\PolyCollection\FormExtension;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class DemoController extends Controller
{
    /**
     * @Route("/", name="_demo")
     * @Template()
     */
    public function indexAction() {
        $order = $this->getDoctrine()->getRepository('AcmeDemoBundle:Order')->find(1);
        // force loading of items;
        //$items = $order->getProducts();
        
        $factory = Forms::createFormFactoryBuilder()
            ->addExtensions($this->getExtensions())
            ->getFormFactory();
        $form =  $factory->create('infinite_form_polycollection', null, array(
            'types' => array(
                'product_type',
                'mobile_type',
                'net_type'
            ),
            'allow_delete' => true
        ));
        /*$coll = new ArrayCollection(array(
            new Mobile('Trond', 11111111),
            new Net(54, 22222222)
        ));*/

        $form->setData($order->getProducts());

        //$form = $this->createForm(new OrderType(), $order);
        //$form->setData(new \Acme\DemoBundle\Entity\Mobile('Alice', 'JOnes'));
        
        return $this->render(
            'AcmeDemoBundle:Demo:form.html.twig', array('form' => $form->createView())
        );
    }
    
    protected function getExtensions() {
        return array(
            new FormExtension()
        );
    }

    /**
     * @Route("/hello/{name}", name="_demo_hello")
     * @Template()
     */
    public function helloAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Route("/contact", name="_demo_contact")
     * @Template()
     */
    public function contactAction(Request $request)
    {
        $form = $this->createForm(new ContactType());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $mailer = $this->get('mailer');

            // .. setup a message and send it
            // http://symfony.com/doc/current/cookbook/email.html

            $request->getSession()->getFlashBag()->set('notice', 'Message sent!');

            return new RedirectResponse($this->generateUrl('_demo'));
        }

        return array('form' => $form->createView());
    }
}
