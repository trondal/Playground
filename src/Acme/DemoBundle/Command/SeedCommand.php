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
        //$mobileLine = new MobileLine();
        $mobile = new Mobile(97955731, 'Trond');
        //$mobileLine->setMobile($mobile);
        
        //$netLine = new NetLine();        
        $net = new Net(342342, 23423234);
        //$netLine->setNet($net);
        
        $order->addProduct($mobile);
        $order->addProduct($net);
        
        $om->persist($order);
        $om->persist($mobile);
        //$om->persist($mobileLine);
        $om->persist($net);
        //$om->persist($netLine);
        
        $om->flush();
        $output->write('<info>Seed done.</info>', true);
    }
}
