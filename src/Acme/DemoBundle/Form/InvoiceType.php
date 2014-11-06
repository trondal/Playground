<?php

namespace Acme\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InvoiceType extends BaseType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('customer', 'entity', array(/* ... */));
        $builder->add('address', 'entity', array(/* ... */));

        $builder->add('lines', 'infinite_form_polycollection', array(
            'types' => array(
                'invoice_line_type', // The first defined Type becomes the default
                'invoice_product_line_type',
            ),
            'allow_add' => true,
            'allow_delete' => true,
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array('data_class' => 'Infinite\\InvoiceBundle\\Entity\\Invoice'));
    }

    public function getName() {
        return 'invoice_type';
    }

}
