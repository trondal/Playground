<?php

namespace Acme\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;

class MobileType extends AbstractType {
   
    public function buildForm(FormBuilderInterface $builder, array $options) {

        parent::buildForm($builder, $options);
        $builder->add('id', 'text')
                ->add('name', 'text', array(
                    'constraints' => new Length(3),
                ))
                ->add('number', 'text')
                ->add('_type', 'hidden', [
                'data' => $this->getName(),
                'mapped' => false
        ]);
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\\DemoBundle\\Entity\\Mobile',
            'model_class' => 'Acme\\DemoBundle\\Entity\\Mobile'
        ));
    }
    
    public function getParent() {
        return 'product_type';
    }
    
    public function getName() {
        return 'mobile_type';
    }

}