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
            ->setName('telio:restart')
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
        
        $mobile1 = new Mobile('Alice', 11111111);
        $mobile2 = new Mobile('Bob', 22222222);
        $mobile3 = new Mobile('Jones', 33333333);

        $net1 = new Net(11, 55555555);
        $net2 = new Net(22, 66666666);
        $net3 = new Net(33, 77777777);
        
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
