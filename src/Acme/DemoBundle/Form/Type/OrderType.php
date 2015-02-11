<?php

namespace Acme\DemoBundle\Form\Type;

use Acme\DemoBundle\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrderType extends AbstractType {

    private $order = null;

    public function __construct(Order $order) {
        $this->order = $order;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', 'text')
                ->add('customer', new CustomerType(), array('label' => 'Customer'))
                ->add('product', 'entity', array(
                    'class' => 'AcmeDemoBundle:Product',
                    'data' => array(
                        'name' => $this->order->getProduct()->getName(),
                        'type' => $this->order->getProduct()->getType())
                ))
                ->add('items', 'collection', array(
                    'type' => new ItemType(),
                    'allow_add' => true,
                    'by_reference' => false,
                    'prototype' => true,
                    'label' => ' '
                    )
                );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\\DemoBundle\Entity\Order',
            'csrf_protection'   => false,
            'label' => ' '
        ));
    }

    public function getName() {
        return 'order';
    }

}
