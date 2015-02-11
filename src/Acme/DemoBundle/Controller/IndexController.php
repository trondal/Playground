<?php

namespace Acme\DemoBundle\Controller;

use Acme\DemoBundle\Entity\Order;
use Acme\DemoBundle\Form\Type\OrderType;
use Acme\DemoBundle\Service\FormSerializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller {

    /**
     * @Route("/new")
     */
    public function newAction(Request $request){
        // create a task and give it some dummy data for this example
        $order = new Order();
        $order->setName('Write a blog post');
        $om = $this->getDoctrine()->getManager();
        $om->persist($order);
        $om->flush();
        $form = $this->createForm(new OrderType(), $order);
        
        return $this->render('AcmeDemoBundle:Index:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/edit/{id}")
     */
    public function editAction($id, Request $request) {
        $om = $this->getDoctrine()->getManager();
        $order = $om->getRepository('AcmeDemoBundle:Order')->find($id);
        $form = $this->createForm(new OrderType($order), $order);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $om->persist($order);
                $om->flush();
            }
        }
        return $this->render(
            'AcmeDemoBundle:Index:edit.html.twig', array('form' => $form->createView())
        );
    }

    /**
     * @Route("/json/{id}")
     * @Method({"GET"})
     */
    public function getjsonAction($id, Request $request) {
        $om = $this->getDoctrine()->getManager();
        $order = $om->getRepository('AcmeDemoBundle:Order')->find($id);
        $form = $this->createForm(new OrderType($order), $order);

        $service = new FormSerializer();
        $data = $service->extractClientData($form);
        return new JsonResponse(array('order' => $data));
    }

    /**
     * @Route("/json/{id}")
     * @Method({"GET"})
     */
    public function postjsonAction($id, Request $request) {
        return new JsonResponse(array('order' => 'ok'));
    }

}
