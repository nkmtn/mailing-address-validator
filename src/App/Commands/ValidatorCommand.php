<?php

namespace Console\App\Commands;

use nkmtn\RussianPostBundle\ApiClient\RussianPostClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ValidatorCommand extends Command 
{
    protected function configure()
    {
        $this->setName('validator')
        ->setDescription('validate mail address')
        ->setHelp('This command prints the current address');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new RussianPostClient('53fb9daa-7f06-481f-aad6-c6a7a58ec0bb');
        $address = $client->validate('респ. Карелия, г. Петрозаводск, ул. Мичуринская, 36');
	    $output->writeln($address->getCountry());
        $output->writeln($address->getDistrictType());
        $output->writeln($address->getDistrictName());
        $output->writeln($address->getLocalityType());
        $output->writeln($address->getLocalityName());
        $output->writeln($address->getStreetType());
        $output->writeln($address->getStreetName());
	
	    return 0;
    }
}

