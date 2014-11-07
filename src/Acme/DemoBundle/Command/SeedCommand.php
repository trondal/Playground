<?php

namespace Acme\DemoBundle\Command;

use Acme\DemoBundle\Entity\MobileLine;
use Acme\DemoBundle\Entity\Net;
use Acme\DemoBundle\Entity\NetLine;
use Acme\DemoBundle\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Acme\DemoBundle\Entity\Mobile;

class SeedCommand extends ContainerAwareCommand {

    protected function configure(){
        $this
            ->setName('acme:restart')
            ->setDescription('Drops, creates and initializes database with seed data');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $kernel = $this->getContainer()->get('kernel');
        $application = new Application($kernel);
        $application->setAutoExit(false);
        // Drops the Schema
        $application->run(new ArrayInput(
                array('command' => 'doctrine:schema:drop',"--force" => true)
        ));
        // Creates the schema
        $application->run(new ArrayInput(
            array('command' => 'doctrine:schema:create')
        ));
        // Inserts seed data
        $om = $this->getContainer()->get('doctrine.orm.entity_manager');

        $order = new Order();
        $order->setRibollitaId(42);
        
        $mobile1 = new Mobile();
        $mobile1->setName('Alice');
        $mobile1->setNumber(11111111);
        
        $mobile2 = new Mobile();
        $mobile2->setName('Bob');
        $mobile2->setNumber(22222222);
        
        $mobile3 = new Mobile();
        $mobile3->setName('Jones');
        $mobile3->setNumber(33333333);
        
        $net1 = new Net();
        $net1->setNumber(44444444);
        $net1->setOrgId(11);
              
        $net2 = new Net();
        $net2->setOrgId(22);
        $net2->setNumber(666666666);
        
        $net3 = new Net();
        $net3->setOrgId(33);
        $net3->setNumber(77777777);
        
        $order->addProduct($mobile1);
        $order->addProduct($net1);
        $order->addProduct($net2);
        
        $om->persist($order);
        $om->persist($mobile1);
        $om->persist($net1);
        $om->persist($net2);
        $om->flush();
        
        $order->addProduct($mobile2);
        $order->addProduct($mobile3);
        $order->addProduct($net3);
        
        $om->persist($mobile2);
        $om->persist($mobile3);

        $om->persist($net3);
        
        $om->flush();
        $output->write('<info>Seed done.</info>', true);
    }
}
